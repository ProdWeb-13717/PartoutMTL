<?php

/**
 * Fichier de lancement du MVC, Il appel le fichier de configuration.php et le fichier d'initialisation des GET/POST initialisation.php 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
	 /***************************************************/
    /** Fichier de configuration, contient l'autoloader **/
    /***************************************************/
	require_once("./configuration.php");
	// Allo le monde
   /***************************************************/
    /** Initialisation des variables **/
    /***************************************************/
	require_once("./initialisation.php");
   
   /***************************************************/
    /** Démarrage du controleur **/
    /***************************************************/
	// Ajout d'un commentaire ici
	$oCtl = new Controleur();
	$oCtl->gerer();
	// Ajout d'un commentaire ici

	// je suis un test git pour commit !!
?>
