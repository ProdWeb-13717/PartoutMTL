<?php

	$nomBD = 'PartoutMTL'; 
	$connexion = connectDB($nomBD);
	
	function ExecuteRequete($requete)
	{
		global $connexion;
		$resultat = mysqli_query($connexion, $requete);
		return $resultat;
	}

	function connectDB($nomBD)
	{	
	
		$link = mysqli_connect("107.180.109.70:3306", "partout", "equipeDeCourse5");
		if(!$link) 
		{
			die("Erreur de connexion : " . mysqli_connect_error());			
		}
		
		$selected = mysqli_select_db($link, $nomBD);
		if(!$selected)
		{
			die("Erreur de creation de BD : " . mysqli_connect_error());
		}
		
		//if()
		return $link;
	}


	// --- vérification de l'existance des inputs de base
	function inputVerif()
	{
		return ExecuteRequete("SELECT COUNT(idOeuvre) AS id FROM Oeuvres");
	}

	$verif = inputVerif();
	$test = mysqli_fetch_assoc($verif);
	if($test)
	{
		print_r($test);
	}
	

	
?>