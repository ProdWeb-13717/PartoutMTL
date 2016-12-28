<?php
    $nbrePage = 1;          // compte le nombre total de pages
    $nbreMaxElement = 20;   //nombre maximum de résultats par pages
    $elemCourant = 1;       //Rang d'un élément dans un pages
    $elemTotal = 0;         //Nombre total de résultats dans la liste
	
	//Construction d'un tableau associatif qu'on pourra mettre en ordre alaphbétique malgré les collectifs
	
	$inconnu="<span class='inconnu'>(non-applicable)</span>";
    $toutArtiste=[];
	
    foreach($data as $artiste)
	{
		$nom = "";
		
		if($artiste["prenomArtiste"] != null)
		{
			
			if($artiste["nomArtiste"] != null)
			{
				$nom = $nom.$artiste["nomArtiste"]." ";
			}
			
			$nom = $nom.$artiste["prenomArtiste"];
			
			//le nom de l'artiste devient la clé principale de chaque artiste (servira a les mettre en ordre alphabétique avec un ksort à la fin)
			
			$toutArtiste[$nom]["nom"] = $artiste["nomArtiste"];
			
			$toutArtiste[$nom]["prenom"] = $artiste["prenomArtiste"];
			
			$toutArtiste[$nom]["id"] = $artiste["idArtiste"];
			
			if($artiste["collectif"] != null)
			{			
				$toutArtiste[$nom]["collectif"] = $artiste["collectif"];
			}
		
			$toutArtiste[$nom]["type"] = "p";
		}
		
		else if($artiste["nomArtiste"] != null)
		{
			$nom = $nom.$artiste["nomArtiste"];
			
			$toutArtiste[$nom]["nom"] = $artiste["nomArtiste"];
			$toutArtiste[$nom]["id"] = $artiste["idArtiste"];
			
			if($artiste["collectif"] != null)
			{			
				$toutArtiste[$nom]["collectif"] = $artiste["collectif"];
			}
			
			$toutArtiste[$nom]["type"] = "p";
		}

		else if($artiste["collectif"] != null)
		{			
			$nom = $nom.$artiste["collectif"];
			
			$toutArtiste[$nom]["collectif"] = $artiste["collectif"];
			$toutArtiste[$nom]["id"] = $artiste["idArtiste"];
			$toutArtiste[$nom]["type"] = "c";
		}
	}
	
	ksort($toutArtiste);
	//print_r($toutArtiste);
?>

<section id="liste">
	<h1 id="artistes">Liste des artistes</h1> <!-- id pour recherche -->
    <span class="pageBalise" id="1">
    <?php
		if(count($toutArtiste) <= 20)
		{
			//echo "Résultat 1 à ".count($toutArtiste); // J'ai modifié cette partie pour suprimer l'erreur qu'on a eu pour la résultat 0
			
			if($toutArtiste)
			{
				echo "Résultats 1 à ". count($toutArtiste);
			}
			else
			{
				echo "Résultat 0 à 0";
			}
		}
		else
		{
			echo "Résultats 1 à 20";
		}
	?>
	</span>
    <div class="pageListe" id="page1">
	<?php
	
	$inconnu="<span class='inconnu'>(non-applicable)</span>";
    
    foreach($toutArtiste as $key => $artiste)
	{
		?>

		<div class="elemListe">
			<a>
				<input type="hidden" class="idArtiste" value="<?php echo $artiste["id"]?>">
				<ul>
				<?php
					if($artiste["type"] == "p")
					{
						if(array_key_exists ( "nom" , $artiste) && $artiste["nom"] != "")
						{
							?>
								<li><span class="catElemListe">Nom : </span><?php echo $artiste["nom"];?></li>
							<?php
						}
						
						if(array_key_exists ( "prenom" , $artiste) && $artiste["prenom"] != "")
						{
							?>
								<li><span class="catElemListe">Prénom : </span><?php echo $artiste["prenom"];?></li>
							<?php
						}
						
						
						if(array_key_exists ( "collectif" , $artiste))
						{
							?>
								<li><span class="catElemListe">Collectif : </span><?php echo $artiste["collectif"];?></li>
							<?php
						}
					}
					
					else if($artiste["type"] == "c")
					{
						?>
							<li><span class="catElemListe">Collectif : </span><?php echo $key;?></li>
						<?php
					}
					?>
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
	?>
    </div>
</section>