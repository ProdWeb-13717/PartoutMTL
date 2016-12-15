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
/*
$nbrePage = 1;          // compte le nombre total de pages
$nbreMaxElement = 20;   //nombre maximum de résultats par pages
$elemCourant = 1;       //Rang d'un élément dans un pages
$elemTotal = 0;         //Nombre total de résultats dans la liste
*/
?>

<!--Construire la liste en divisant les résultats en page de 20 résultats-->
<section id="liste">
	<h1 id="oeuvres" >Liste des oeuvres</h1> <!-- id pour recherche -->

	<div class="pageListe">
		<?php
		foreach($data[0] as $oeuvre)
		{	
			if($oeuvre["idOeuvre"] != $precendent)
			{
				$precendent = $oeuvre["idOeuvre"];
				?>		
				<div class="elemListe">
					<div class="photoOeuvre">
						<?php 
						if($oeuvre["urlPhoto"] != null)
						{	?>
							<img src=" <?php echo $oeuvre["urlPhoto"]; ?>"/>
							<?php
						}
						else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
						{	
						
							?>
							<img src="../images/image_default_oeuvre_4.jpg" alt="image default" height="150">
							<?php
						}
						?>
					</div>
					
					<div class="informationOeuvre">
						<ul>
							<li><span class="catElemListe">ID : </span><?php echo $oeuvre["idOeuvre"]?></li>
							<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
							<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>
							<li><span class="catElemListe">Auteur(s):</span>
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
														echo $artiste["prenomArtiste"];
														
														if($artiste["nomArtiste"] != "")
														{
															echo " ".$artiste["nomArtiste"];
														}
													}
													
													if($artiste["collectif"] != "" && ($artiste["prenomArtiste"] == "" && $artiste["nomArtiste"] == ""))
													{
														echo $artiste["collectif"]." (collectif)";
													}
												?>
											</li>
										<?php
										}
									}
									?>
								</ul>
							</li>
							<a href="./index.php?requete=supprimeOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">SUPPRIMER</a>
						</ul>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</section>