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
//test commentaire pour le git : a«jfiwdgfiywGFGGgfhcgaHFHAgf//

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
            
            <!-- CSS --------------------> 
            <link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
            <link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
            <link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
            
            <!-- Google font ------------>         
            <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
            
            <!-- Javascript -------------> 
            <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
            <script src="./js/plugins.js"></script>
<<<<<<< HEAD
            <script src="./js/soumissionAdmin.js"></script>
            
            <!-- JQUERY -----------------> 
            <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script-->
=======
            <script src="./js/main.js"></script>
            
            <!-- JQUERY -----------------> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
>>>>>>> origin
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
			<div>
			<a href="index.php?requete=importation">Allez ver l'importation de donnés</a>
			</div>
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
<<<<<<< HEAD
	}   
=======
	}
    
    public function afficheSoumissionAdmin()
    {
    ?>
        <div id="SoumissionAdmin">
            <h1>Ajouter une oeuvre</h1>

            <form id="formAjoutOeuvre" name="formAjoutOeuvreAdmin" method="POST" action="index.php?requete=insereSoumission">
                <label for="titreOeuvreAjoutAdmin">Titre : </label>
                <input type="text" name="titreOeuvreAjout" id="titreOeuvreAjoutAdmin"/><br/>
                
                <label for="titreVarianteOeuvreAjoutAdmin">Titre variante : </label>
                <input type="text" name="titreVarianteOeuvreAjout" id="titreVarianteOeuvreAjoutAdmin"/><br/>
                
                <label for="categorieOeuvreAjoutAdmin">Catégorie : </label>
                <input type="text" name="categorieOeuvreAjout" id="categorieOeuvreAjoutAdmin"/><br/>
                
                <label for="nomArtisteOeuvreAjoutAdmin">Nom de l'artiste : </label>
                <input type="text" name="nomArtisteOeuvreAjout" id="nomArtisteOeuvreAjoutAdmin"/><br/>
                
                <label for="prenomArtisteOeuvreAjoutAdmin">Prénom de l'artiste : </label>
                <input type="text" name="prenomArtisteOeuvreAjout" id="prenomArtisteOeuvreAjoutAdmin"/><br/>
                
                <label for="collectifOeuvreAjoutAdmin">Collectif : </label>
                <input type="text" name="collectifOeuvreAjout" id="collectifOeuvreAjoutAdmin"/><br/>
                
                <label for="dateFinProductionOeuvreAjoutAdmin">Date fin de production : </label>
                <input type="text" name="dateFinProductionOeuvreAjout" id="dateFinProductionOeuvreAjoutAdmin"/><br/>
                
                <label for="collectionOeuvreAjoutAdmin">Collection de l'oeuvre : </label>
                <input type="text" name="collectionOeuvreAjout" id="collectionOeuvreAjoutAdmin"/><br/>
                
                <label for="modeAcquisitionOeuvreAjoutAdmin">Mode d'acquisition : </label>
                <input type="text" name="modeAcquisitionOeuvreAjout" id="modeAcquisitionOeuvreAjoutAdmin"/><br/>
                
                <label for="dateAcquisitionOeuvreAjoutAdmin">Date d'acquisition : </label>
                <input type="text" name="dateAcquisitionOeuvreAjout" id="dateAcquisitionOeuvreAjoutAdmin"/><br/>
                
                <label for="materiauxOeuvreAjoutAdmin">Matériaux : </label>
                <input type="text" name="materiauxOeuvreAjout" id="materiauxOeuvreAjoutAdmin"/><br/>
                
                <label for="techniqueOeuvreAjoutAdmin">Technique : </label>
                <input type="text" name="techniqueOeuvreAjout" id="techniqueOeuvreAjoutAdmin"/><br/>
                
                <label for="dimensionsOeuvreAjoutAdmin">Dimensions : </label>
                <input type="text" name="dimensionsOeuvreAjout" id="dimensionsOeuvreAjoutAdmin"/><br/>
                
                <label for="parcOeuvreAjoutAdmin">Parc : </label>
                <input type="text" name="parcOeuvreAjout" id="parcOeuvreAjoutAdmin"/><br/>
                
                <label for="batimentOeuvreAjoutAdmin">Bâtiment : </label>
                <input type="text" name="batimentOeuvreAjout" id="batimentOeuvreAjoutAdmin"/><br/>
                
                <label for="adresseCiviqueOeuvreAjoutAdmin">Adresse civique : </label>
                <input type="text" name="adresseCiviqueOeuvreAjout" id="adresseCiviqueOeuvreAjoutAdmin"/><br/>
                
                <label for="arrondissementOeuvreAjoutAdmin">Arrondissement : </label>
                <input type="text" name="arrondissementOeuvreAjout" id="arrondissementOeuvreAjoutAdmin"/><br/>
                
                <label for="latitudeOeuvreAjoutAdmin">Latitude : </label>
                <input type="text" name="latitudeOeuvreAjout" id="latitudeOeuvreAjoutAdmin"/><br/>
                
                <label for="longitudeOeuvreAjoutAdmin">Longitude : </label>
                <input type="text" name="longitudeOeuvreAjout" id="longitudeOeuvreAjoutAdmin"/><br/>
                
                <label for="urlPhotoOeuvreAjoutAdmin">URL photo : </label>
                <input type="text" name="urlPhotoOeuvreAjout" id="urlPhotoOeuvreAjoutAdmin"/><br/>
                
                <label for="descriptionOeuvreAjoutAdmin">Description : </label>
                <input type="text" name="descriptionOeuvreAjout" id="descriptionOeuvreAjoutAdmin"/><br/><br/>
                
                
                
                <!--input type="hidden" name="requete" id="requete" value="soumissionOeuvre"/-->
                <!--input type="button" id="inscription" value="Soumission" name="Inscription" onclick='insereSoumission()'/-->
                <input type="submit" id="boutonSoumission" value="Soumission" name="Inscription"/>
                <span id="msgErreurSoumision"></span>

            </form>
        </div>
	<?php
	}
    
    public function soumissionReussie()
    {
    ?>
        <p>Soumission réussie</p>
    
	<?php
	}
    
    public function soumissionEchec()
    {
    ?>
        <p>Échec de la soumission</p>
    
	<?php
	}
    
>>>>>>> origin
}
?>