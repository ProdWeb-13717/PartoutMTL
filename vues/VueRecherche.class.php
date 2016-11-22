<?php
/**
 * Class Vue
 * Modèle de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */


class VueRecherche {

	
	public function afficheRechercheOeuvreTitre() ///********************** function pour afficher la resultat de rechercher les oeuvres par titre
	{
		//En construction ...
		echo "<p> En construction ... </p>";
	}
	
	
	public function resultatDataRecherche($data) ///********************** function pour afficher la resultat de rechercher 
	{
		
		//echo json_encode($data);
		//print_r($data);
		
		//print_r(array_values($data));
		//echo "<br><br><br><br>";
		//echo count($data[0]);
		if(!$data){
			
			echo "<p> Aucun résultat pour le mot/lettre recherché </p>";
		}
		else{
		?>
		<section class="liste">
			<section class="liste">
			<h1>Liste des oeuvres</h1>
		<?php
					foreach($data as $oeuvre)
					{
						
						
						
		?>
						<div class="elemListe">
							<ul>
								<li><span class="catElemListe">ID : </span><?php echo $oeuvre["idOeuvre"]?></li>
								<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
								<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>

							</ul>
						</div>
		<?php
						
					}
		?>
		</section>
		<?php
		}
		
	}
	
	
	public function rechercheResultat($data) ///********************** function pour afficher la resultat de rechercher les oeuvres par titre
	{
		
		print_r($data);
		
	}
	
}
?>