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
		
	/**
	 * @access public
	 * @return Array
	 */
	 
	protected function getPrimaryKey()
	{
		return "Je ne sert à rien dans cette classe";
	} 
		
	protected  function getTable()
	{
		return "Je ne sert à rien dans cette classe";
	}
	 
	public function getArtisteTout() 
	{
			try
			{
				//$stmt = $this->connexion->prepare("SELECT Artistes.idArtiste AS noArtiste, prenomArtiste, nomArtiste, COUNT(ArtistesOeuvres.idArtiste) AS NbreOeuvres FROM Artistes JOIN ArtistesOeuvres ON Artistes.idArtiste = ArtistesOeuvres.idArtiste GROUP BY noArtiste");
				$stmt = $this->connexion->prepare("SELECT idArtiste, prenomArtiste, nomArtiste FROM Artistes");
				$stmt->execute();
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
				$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre AS noOeuvre, titre, dateFinProduction FROM Oeuvres");
				/*"SELECT Oeuvres.idOeuvre AS oeuvreNo, titre, dateFinProduction, Photos.urlPhoto AS lienPhoto, Artistes.idArtiste AS artisteNo, prenomArtiste, nomArtiste
				FROM Oeuvres 
				OUTER JOIN Photos
				ON Photos.idOeuvre = Oeuvres.idOeuvre
				OUTER JOIN ArtistesOeuvres
				ON ArtistesOeuvres.idOeuvre = Oeuvres.idOeuvre
				OUTER JOIN Artistes
				ON ArtistesOeuvres.idArtiste = Artistes.idArtiste");*/
				$stmt->execute();
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