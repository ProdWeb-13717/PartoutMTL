<?php

/**
 * Controleur AJAX. Ce fichier est la porte d'entrée des requêtes AJAX (XHR)
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-03-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */

	require_once("./configuration.php");
	
	
	// Mettre ici le code de gestion de la requête AJAX
	public function gerer()
		{
			
			switch ($_GET['requete']) {
				
                
                break;
                
				default:
					//$this->accueil(); // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
					break;
			}
		}

?>