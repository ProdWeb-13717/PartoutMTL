<section id="oeuvreIndi">
	<ul>
<?php
	foreach($data[0] as $cle => $valeur)
	{	
		if($cle == "titre")
		{
			echo "<li>Titre : ".$valeur;
			foreach($data[0] as $cle => $valeur)
			{
				if($cle == "titreVariante" && $valeur != "")
				{
					echo "(".$valeur.")";
					break;
				}
			}
			echo "</li>";
		}
	}
	?>
	<li>Auteur(s):
		<ul>
	<?php
		foreach($data as $auteur)
		{
			?>
			<li>
			<?php 
				if($auteur["prenomArtiste"] != "")
				{
					echo $auteur["prenomArtiste"];
					
					if($auteur["nomArtiste"] != "")
					{
						echo" ".$auteur["nomArtiste"];
					}
				}
				else
				{
					if($auteur["nomArtiste"] != "")
					{
						echo $auteur["nomArtiste"];
					}
				}
				
				if($auteur["collectif"] != "")
				{
					if($auteur["prenomArtiste"] == "" && $auteur["nomArtiste"] == "")
					{	
						echo $auteur["collectif"]." (collectif)";
					}
				}
			?>
			</li>
			<?php
		}
	?>
		</ul>
	</li>
	<?php
	foreach($data[0] as $cle => $valeur)
	{	
		if(($cle != "titre" && $cle != "prenomArtiste" && $cle != "nomArtiste" && $cle != "idArtiste" && $cle != "idOeuvre" && $cle != "titreVariante" && $cle != "collectif") && ($valeur != null ||$valeur != ""))
		{
			echo "<li>".$cle." : ".$valeur."</li>";
		}
	}
?>
	</ul>
</section>