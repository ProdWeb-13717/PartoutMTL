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


class Vue {

	/**
	 * Produit l'entête html
	 * @access public
	 * @return void
	 */
	public function afficheEntete() {
		?>
		<!DOCTYPE html>

<html lang="fr">
	<head>
		<title>Partout</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		
		<link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
        
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		
		<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="./js/plugins.js"></script>
		<script src="./js/main.js"></script>
		<script src="./js/rechercheAJAX.js"></script>
	</head>

			<body>
		<?php
	}
	
	/**
	 * Contenu de la page d'accueil
	 * @access public
	 * @return void
	 */
	public function afficheAccueil() {
		
		?>
		<body id="pageAcceuil">
			<div id="acceuil">
				<header id="headerAcceuil">
				
				<div id="logo">P<span id="blanch">ART</span>OUT<br/></div>

				<div id="menuAcceuil">
					<ul>
						<!--Chaque li est un lien dans la barre menu-->
						<li><a href="index.php?requete=rechercheOeuvreTitre">RECHERCHE AVANCÉ</a></li>
						<li><a href="index.php?requete=listeArtistes">ARTISTES</a></li>
						<li><a href="index.php?requete=listeOeuvres">OEUVRES</a></li>
						<li><a href="#">SOUMISSION</a></li>
					</ul>     
				</div>
			 
				</header>
				<form class="rechercheAcceuil">
						<select id="categorieRecherche"  name="categorieRecherche">
							<option value="" >séléctionner catégorie</option>
							<option value="Artistes">Par l'artiste</option>
							<option value="Oeuvres">Par l'oeuvre</option>
						</select>
						<select name="souscategorieRecherche" id="souscategorieRecherche"  disabled>
							<option value="">séléctionner sou-catégorie</option>
							<option value="titre" >titre</option>
						</select>
						
						<input id='motRecherche' placeholder="Titre d'oeuvre" name="rechercheOeuvre" type='text'  />
						
						<input type="button" id="btnRecherche" value="Rechercher"/>
						<!--div id="boiteRecherche"></div-->
					</form>
				<div id="contentAcceuil">
				<a href="index.php?requete=importation">Allez ver l'importation de donnés</a>
				<!--Lien vers teste  des listes-->
				<a href="index.php?requete=listeArtistes">Afficher liste d'artistes</a>
				<a href="index.php?requete=listeOeuvres">Afficher liste d'oeuvres</a>
				
				</div>
			</div>
			
		
		</body>
		<?php
		
	}
	
	
	/**
	 * Produit le html du pied de page
	 * @access public
	 * @return void
	 */
	public function affichePied()
	{
		?>
			<div id="footer">
					Certains droits réservés @ Jonathan Martel (2013)<br>
					Sous licence Creative Commons (BY-NC 3.0)
				</div>
			</div>	
		</body>
		</html>
		<?php
	}
	
	/**
	 * Produit le html pour le formulaire avec le bouton d'importation
	 * @access public
	 * @return void
	 */
	
	public function afficheformImportation()
	{
		?>
		<form id="formImport" method="GET">
		Cliquez sur le bouton pour importer le donnés<br>
		<input type="hidden" name="requete" value="importationok"/>
		<input type="submit" name="Importer" value="Importer"/><br/><br/>
		</form>
	<?php
	}
	
	public function afficheImportationok()
	{
		?>
		<div>
		Les donnés ont eté importé correctement<br>
		<a href="index.php?requete=importation">Allez ver l'importation de donnés</a>
		</div>
	<?php
	}    
	
}
?>