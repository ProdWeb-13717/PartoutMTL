<section id="oeuvreIndi">
	<ul>
<?php
	//Affichage du titre de l'oeuvre
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
		//Affichage du ou des auteurs de l'oeuvre
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
	//Affichage des éléments restants du de l'oeuvre (ils sont présents)
	foreach($data[0] as $cle => $valeur)
	{	
		switch($cle)
		{
			case "dateFinProduction":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Date fin de production : ".$valeur."</li>";
				}
				break;
				
			case "dateAccession":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Date d'accession : ".$valeur."</li>";
				}
				break;
				
			case "nomCollection":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Nom de collection : ".$valeur."</li>";
				}
				break;
				
			case "nomCollection":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Nom de collection : ".$valeur."</li>";
				}
				break;
			
			case "modeAcquisition":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Mode d'acquisition : ".$valeur."</li>";
				}
				break;
				
			case "materiaux":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Materiaux : ".$valeur."</li>";
				}
				break;
			
			case "technique":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Technique : ".$valeur."</li>";
				}
				break;

			case "dimensions":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Dimensions : ".$valeur."</li>";
				}
				break;
				
			case "parc":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Parc : ".$valeur."</li>";
				}
				break;
				
			case "batiment":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Batiment : ".$valeur."</li>";
				}
				break;
				
			case "adresseCivique":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Adresse civique : ".$valeur."</li>";
				}
				break;
				
			case "latitude":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Latitude : ".$valeur."</li>";
				}
				break;
				
			case "longitude":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Longitude : ".$valeur."</li>";
				}
				break;
			
			case "description":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Description : ".$valeur."</li>";
				}
				break;
				
			case "numeroAccession":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Numero d'accession : ".$valeur."</li>";
				}
				break;
				
			case "nomArrondissement":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Arrondissement : ".$valeur."</li>";
				}
				break;
				
			case "nomCategorie":
				if($valeur != null && $valeur != "")
				{
					echo "<li>Categorie : ".$valeur."</li>";
				}
				break;
				
		}
	}
?>
	</ul>
</section>