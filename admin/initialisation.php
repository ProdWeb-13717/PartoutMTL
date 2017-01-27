<?php

/**
 * Fichier d'initialisation des variables GET et POST.
 * @author Jonathan Martel
 * @version 1.1
 * @update 2016-01-22
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
 
 /**
 * Faire l'assignation des variables ici avec les isset() ou !empty()
 */
  
	session_start();
	if(empty($_SESSION['MotDePasseDefault']))
	{
		$_SESSION['MotDePasseDefault'] = md5('1234');
	}
  
	if(empty($_GET['requete']))
	{
		$_GET['requete'] = '';
	}


	if(empty($_GET['usagerAdmin']))
	{
		$_GET['usagerAdmin'] = '';
	}
	
	if(empty($_SESSION["niveauAdmin"]))
	{
		$_SESSION["niveauAdmin"] = '';
	}

	if(empty($_GET['passAdmin']))
	{
		$_GET['passAdmin'] = '';
	}

	if(empty($_SESSION['idAdmin']))
	{
		$_SESSION['idAdmin'] = '';
	}

    if(empty($_SESSION['idSoumissionUsager']))
	{
		$_SESSION['idSoumissionUsager'] = '';
	}

    if(empty($_SESSION['idOeuvre']))
	{
		$_SESSION['idOeuvre'] = '';
	}
	
	if(empty($_SESSION['ongletActif']))
	{
		$_SESSION['ongletActif'] = 'gestion';
	}



?>