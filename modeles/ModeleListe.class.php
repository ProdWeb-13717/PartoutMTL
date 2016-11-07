<?php
/**
 * Class Modele
 * Modèle de classe modèle. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */
class ModeleListe extends TemplateBase{
	
    
	/*public function __construct ()
	{
			try
			{
				$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5");
			}
			catch(Exception $exc)
			{
				die("Connexion à la base de données impossible.");
			}
	}*/
	
	function __destruct ()
	{
		
	}
	
		
	/**
	 * @access public
	 * @return Array
	 */
	public function getArtisteTout() 
	{
			try
			{
				$stmt = $this->connexion->prepare("SELECT idArtiste, prenomArtiste, nomArtiste FROM Artistes");
				return $stmt->fetchAll();
			}	
			catch(Exception $exc)
			{
				return 0;
			}
		$aDonnees = array('');
		
		return $aDonnees;
	}
	
	public function getOeuvresTout() 
	{/*INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID;*/
			try
			{
				$stmt = $this->connexion->prepare(
				"SELECT Oeuvres.idOeuvre AS oeuvreNo, titre, dateFinProduction, Photos.urlPhoto AS lienPhoto, Artistes.idArtiste AS artisteNo, prenomArtiste, nomArtiste
				FROM Oeuvres INNER JOIN Photos
				ON Photos.idOeuvre = Oeuvres.idOeuvre
				INNER JOIN Artiste-Oeuvre
				ON Artiste-Oeuvre.idOeuvre = Oeuvres.idOeuvre
				INNER JOIN Artistes
				ON Artiste-Oeuvre.idArtiste = Artistes.idArtiste");
				return $stmt->fetchAll();
			}	
			catch(Exception $exc)
			{
				return 0;
			}
		$aDonnees = array('');
		
		return $aDonnees;
	}
}




?>