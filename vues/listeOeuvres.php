<!--Variables pour se retrouver dans le dénombrement des résultats de la variable $data-->
<?php
$precendent = 0;        // permettra de savoir l'ID de l'oeuvre traité précédemment
$nbrePage = 1;          // compte le nombre total de pages
$nbreMaxElement = 20;   //nombre maximum de résultats par pages
$elemCourant = 1;       //Rang d'un élément dans un pages
$elemTotal = 0;         //Nombre total de résultats dans la liste
?>

<!--Construire la liste en divisant les résultats en page de 20 résultats-->
<section id="liste">
	<h1 id="oeuvres" >Liste des oeuvres</h1> <!-- id pour recherche -->
	<span class="pageBalise" id="1">
	<?php
		if(count($data[0]) <= 20)
		{
			echo "Résultats 1 à ".count($data[0]);
		}
		else
		{
			echo "Résultats 1 à 20";
		}
	?>
	</span>
	<div class="pageListe" id="page1">
	<?php
	foreach($data[0] as $oeuvre)
	{	
		if($oeuvre["idOeuvre"] != $precendent)
		{
			$precendent = $oeuvre["idOeuvre"];
			?>		
			
			<div class="elemListe">
				<a href="./index.php?requete=afficheOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">
					<img src="
						<?php 
						if($oeuvre["urlPhoto"] != null)
						{
							echo $oeuvre["urlPhoto"];
						}
						else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
						{
							echo "http://galaxy.mobity.net/uploads/148/logo/1399898656.png";
						}
						?>
					">
					<ul>
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
					</ul>
				</a>
			</div>
			<?php
			
			$elemTotal++;
			$elemCourant++;
			if($elemCourant > $nbreMaxElement)
			{
				$nbrePage++;
				$elemCourant = 1;
				?>
					</div>
					<span class="pageBalise" id="<?php echo $nbrePage;?>">
					<?php
						echo"Résultats ".($elemTotal+1)." à ".($elemTotal+$nbreMaxElement);
					?>
					</span>
					<div class="pageListe pageCache" id="<?php echo "page".$nbrePage;?>">
				<?php	
			}
		}
	}
	?>
</section>