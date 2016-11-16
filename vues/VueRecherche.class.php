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
		?>
		<!--img id="imgload" src="images/ajax-loader.gif"-->
		<form>
			<h4>La recherche d'oeuvre par son titre:
			<input id='rechercheOeuvre' placeholder="Titre d'oeuvre" name="rechercheOeuvre" type='text'/></h4>
			<div id="boiteRecherche"></div>
		</form>
		<div>
			<a href="index.php?requete=txtRecherche&valRecherche=p">test la resultat l</a>
		</div>
	<?php
	}
	
	
	public function resltatDataRecherche($data) ///********************** function pour afficher la resultat de rechercher les oeuvres par titre
	{
		
		echo json_encode($data);
		
	}
	
}
?>