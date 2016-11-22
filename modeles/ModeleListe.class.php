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
class ModeleListe extends TemplateBase
{
		
	/**
	 * @access public
	 * @return Array
	 */
	 
	protected function getPrimaryKey()
	{
		return ""; //Je ne sert à rien dans cette classe
	} 
		
	protected  function getTable()
	{
		return "";  // Je ne sert à rien dans cette classe
	}
	 
	public function getArtisteTout() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT idArtiste, prenomArtiste, nomArtiste, collectif FROM Artistes");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	public function getOeuvresParAuteur() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre AS noOeuvre,Artistes.prenomArtiste AS prenom, Artistes.nomArtiste AS nom, Artistes.collectif AS collectif
											   FROM Oeuvres
											   LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											   JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											   ORDER BY noOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	public function getOeuvresParPhotos() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre AS noOeuvre, titre, dateFinProduction, urlPhoto
											   FROM Oeuvres
											   LEFT JOIN Photos ON Oeuvres.idOeuvre = Photos.idOeuvre
											   ORDER BY noOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
}




?>