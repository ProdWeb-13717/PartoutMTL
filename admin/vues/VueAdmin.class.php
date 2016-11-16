<?php
/**
 * Class VueAdmin
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */


class VueAdmin {

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
		<title>Mon simple MVC</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width">
		
		<link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
		
		<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script src="./js/plugins.js"></script>
		<script src="./js/main.js"></script>
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
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
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
	 public function afficheFormAutentificationAdmin()
	 {
		 ?>
		 <h1> afficheFormAutentificationAdmin </h1>
		 <br>

		 <form method="GET">
			<input type='hidden' name='requete' value="autentificationAdmin"/>
			nom d'utilisateur : <input type='text' id='usagerAdmin' name='usagerAdmin'/>
			<br>
			mot de passe : <input type='text' id='passAdmin' name='passAdmin'/>
			<br><br>
			<input type='submit' value='soumettre'>
		 </form>

		 <br>
		 <?php
	 }
	 
	 public function afficherAcceuilAdmin()
	 {
		 ?>
		 <h1>afficherAcceuilAdmin</h1>
		 
		 <?php
	 }
	
}
?>