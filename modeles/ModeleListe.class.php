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
	
	//Fonction qui va chercher les info des artistes pour construction d'une liste
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
	
	//Fonction qui va chercher les infos de toutes les oeuvres ainsi que les artistes rattachés à chaque oeuvre.
	public function getOeuvresParAuteur() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, prenomArtiste, nomArtiste, collectif
											   FROM Oeuvres
											   LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											   JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	//Fonction qui va chercher les infos de toutes les id des oeuvres selon l'id d'un artiste.
	public function getOeuvresParAuteurId($idArtiste) 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT ArtistesOeuvres.idOeuvre
											   FROM ArtistesOeuvres
											   WHERE ArtistesOeuvres.idArtiste = ".$idArtiste."
											   ORDER BY ArtistesOeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_COLUMN);
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	//Fonction qui va chercher les photos de toutes les oeuvres
	public function getOeuvresParPhotos() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, titre, dateFinProduction, urlPhoto
											   FROM Oeuvres
											   LEFT JOIN Photos ON Oeuvres.idOeuvre = Photos.idOeuvre
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	//Fonction qui va chercher les information d'une oeuvre correspondant à un ID précis
	public function getOeuvresParID($id) 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT *
											   FROM Oeuvres
											   LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											   JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											   JOIN Arrondissements ON Arrondissements.idArrondissement = Oeuvres.idArrondissement
											   JOIN Categories ON Categories.idCategorie = Oeuvres.idCategorie
											   WHERE Oeuvres.idOeuvre = :id");
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	//Fonction qui va chercher les information d'une oeuvre correspondant à un ID précis
	public function getPhotoParIDOeuvre($id) 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT *
											   FROM Photos
											   WHERE Photos.idOeuvre = :id");
			$stmt->bindParam(":id", $id);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
}




?>