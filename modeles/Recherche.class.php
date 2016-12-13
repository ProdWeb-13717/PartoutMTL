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


class Recherche extends TemplateBase 
{
	
    protected function getTable()
	{
		return "Oeuvres";
	}
	
    
	protected function getPrimaryKey()
	{
		return "";
	}
	
    
	public function rechercheOeuvres($valeur, $cle = null)
	{
		try
		{	
			if($cle == null)
			{
				//$cle = $this->getPrimaryKey();
				$cle = "titre";
			}
			$stmt = $this->connexion->prepare("select * from ".$this->getTable()." where `".$cle."` LIKE '".$valeur."%' "); //temp_artistes
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}

	public function rechercheOeuvresParAuteur($valeur) //simple
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, prenomArtiste, nomArtiste, collectif
											   FROM Oeuvres
											   LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											   JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											   WHERE Oeuvres.titre LIKE '".$valeur."%'
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function rechercheOeuvresParPhotos($valeur) //simple
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, Oeuvres.titre, Oeuvres.dateFinProduction, Photos.urlPhoto
											   FROM Oeuvres
											   LEFT JOIN Photos ON Oeuvres.idOeuvre = Photos.idOeuvre
											   WHERE Oeuvres.titre LIKE '".$valeur."%'
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	
	public function rechercheOeuvresAvanceParAuteur($valeur,$cleRecherche) //avance
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, prenomArtiste, nomArtiste, collectif
											   FROM Oeuvres
											   LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											   JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											   WHERE Oeuvres.".$cleRecherche." LIKE '".$valeur."%'
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function rechercheOeuvresAvanceParPhotos($valeur,$cleRecherche) //avance
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Oeuvres.idOeuvre, Oeuvres.titre, Oeuvres.dateFinProduction, Photos.urlPhoto
											   FROM Oeuvres
											   LEFT JOIN Photos ON Oeuvres.idOeuvre = Photos.idOeuvre
											   WHERE Oeuvres.".$cleRecherche." LIKE '".$valeur."%'
											   ORDER BY Oeuvres.idOeuvre");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	

	public function rechercheArtisteTout($valeur) 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT idArtiste, prenomArtiste, nomArtiste, collectif FROM Artistes
												where nomArtiste LIKE '".$valeur."%' OR prenomArtiste LIKE '".$valeur."%'
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function rechercheAvanceArtisteTout($valeur,$cleRecherche) 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT idArtiste, prenomArtiste, nomArtiste, collectif FROM Artistes
												where ".$cleRecherche." LIKE '".$valeur."%' 
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	
	public function rechercheAvanceArtistesOeuvres($valeur) //avanceeeeeeeeeeeeeeee Oeuvres par son artiste
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Artistes.nomArtiste,Artistes.collectif,Artistes.idArtiste,Artistes.prenomArtiste, Oeuvres.idOeuvre, Oeuvres.titre, Oeuvres.dateFinProduction, Photos.urlPhoto, Photos.idPhoto 
												FROM Photos RIGHT JOIN Oeuvres ON Oeuvres.idOeuvre = Photos.idOeuvre 
												LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
												JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
												WHERE Artistes.nomArtiste LIKE '".$valeur."%' OR Artistes.prenomArtiste  LIKE '".$valeur."%'
 
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	
	public function rechercheAvanceArtistesOeuvresArrondissements($valeur) //avance Oeuvres par Arrondissements
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Artistes.nomArtiste ,Artistes.prenomArtiste, Artistes.idArtiste, Artistes.collectif, Oeuvres.titre, Oeuvres.idOeuvre, Oeuvres.dateFinProduction, Arrondissements.nomArrondissement, Oeuvres.idArrondissement, Photos.urlPhoto, Photos.idPhoto 
											FROM Photos RIGHT JOIN Oeuvres ON Oeuvres.idOeuvre = Photos.idOeuvre 
											LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											JOIN Arrondissements on Arrondissements.idArrondissement= Oeuvres.idArrondissement 
											WHERE Arrondissements.nomArrondissement LIKE '".$valeur."%' 
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function rechercheAvanceArtistesOeuvresCategories($valeur) //avance Oeuvres par Categories
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT Artistes.nomArtiste ,Artistes.prenomArtiste, Artistes.idArtiste, Artistes.collectif, Oeuvres.titre, Oeuvres.idOeuvre, Oeuvres.dateFinProduction, Categories.nomCategorie, Oeuvres.idCategorie, Photos.urlPhoto, Photos.idPhoto 
											FROM Photos RIGHT JOIN Oeuvres ON Oeuvres.idOeuvre = Photos.idOeuvre 
											LEFT JOIN ArtistesOeuvres ON Oeuvres.idOeuvre = ArtistesOeuvres.idOeuvre
											JOIN Artistes ON ArtistesOeuvres.idArtiste = Artistes.idArtiste
											JOIN Categories on Categories.idCategorie= Oeuvres.idCategorie 
											WHERE Categories.nomCategorie LIKE '".$valeur."%'
												");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return false;
		}
	}
	
}
?>
