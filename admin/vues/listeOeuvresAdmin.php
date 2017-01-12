<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!--Variables pour se retrouver dans le dénombrement des résultats de la variable $data-->
<?php
    $precendent = 0;        // permettra de savoir l'ID de l'oeuvre traité précédemment
?>

<div class="listeOeuvresAdmin marginDivPrincipale adminTitre">
    <h1 id="oeuvres" >GESTION DES OEUVRES</h1> <!-- id pour recherche -->
    
        <article class="liens flex-row-left liensGestionOeuvres">
            <a href="index.php?requete=soumission">AJOUT D'OEUVRE</a>
            <a href="index.php?requete=soumissionsDesUsagers">VOIR LES SOUMISSIONS</a>
            <a href="index.php?requete=gestionCategorie">GESTION DES CATÉGORIES</a>
        </article>
    
    <h1 id="oeuvres" >LISTE DES OEUVRES</h1> <!-- id pour recherche -->
    <section class="flex-column-left">
		<?php
		foreach($data[0] as $oeuvre)
		{	
			if($oeuvre["idOeuvre"] != $precendent)
			{
				$precendent = $oeuvre["idOeuvre"];
				?>
                <section class="elemListe flex-row-left espaceHaut10">
					<article class="photoOeuvre">
						<?php 
						if($oeuvre["urlPhoto"] != null)
						{	?>
							<img src=" <?php echo $oeuvre["urlPhoto"]; ?>"/>
							<?php
						}
						else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
						{	
							?>
							<img src="../images/image_default_oeuvre_4.jpg" alt="image default" height="80">
							<?php
						}
						?>
					</article>
					
					<article class="informationOeuvre">
						<ul>
                            <li><span class="catElemListe">Oeuvre # :   </span><span class="typoValeurAdmin"><?php echo $oeuvre["idOeuvre"]?>  </span></li>
                            <li><span class="catElemListe">Titre :      </span><span class="typoValeurAdmin"><?php echo $oeuvre["titre"]?>     </span></li>
							<li><span class="catElemListe">Auteur(s) :  </span>
								<ul class="listeAuteur">
									<?php
									foreach($data[1] as $artiste)
									{	
										if($artiste["idOeuvre"] == $precendent)
										{
										?>
											<li>
												<?php
													if($artiste["prenomArtiste"] != "")
													{
														echo "<span class='typoValeurAdmin'>" . $artiste["prenomArtiste"] . "</span>";
														
														if($artiste["nomArtiste"] != "")
														{
															echo "<span class='typoValeurAdmin'> " . $artiste["nomArtiste"] . "</span>";
														}
													}
													if($artiste["collectif"] != "" && ($artiste["prenomArtiste"] == "" && $artiste["nomArtiste"] == ""))
													{
														echo "<span class='typoValeurAdmin'>" . $artiste["collectif"] . " (collectif)</span>";
													}
												?>
											</li>
										<?php
										}
									}
									?>
								</ul>
                            </span></li>
                        </ul>
					</article>
                    
                    <article  class="liens espaceHaut10">
                        <a href="./index.php?requete=modifieOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">MODIFIER</a>
                        <a href="./index.php?requete=supprimeOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">SUPPRIMER</a>
                    </article>
                </section>
				<?php
			}
		}
		?>
    </section>
</div>