<?php
/**
 * Class FormulaireOeuvre
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

class modeleSoumission extends TemplateBase 
{    

    protected function getPrimaryKey()
	{
		return "";
	} 
	
	public function getTable()
	{
		return "";
	}
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      SELECT      /////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////       ID       ////////////////////////////////////////////

    
    public function obtenirArrondissementOeuvre($idOeuvre)                      // récupère l'id de l'arrondissement de l'oeuvre en paramètre
    {
        $stmt = $this->connexion->prepare("SELECT idArrondissement 
                                           FROM Oeuvres
                                           WHERE idOeuvre = $idOeuvre");
										   
        $stmt->execute();
        $data = $stmt->fetch();
        return $data['idArrondissement'];                                       // retourne l'id de l'arrondissement de cet oeuvre
    }
    
    public function obtenirNomArrondissement($idArrondissement)                 // récupère le nom de la catégorie demandée en paramètre
    {
        $stmt = $this->connexion->prepare("SELECT nomArrondissement 
                                           FROM Arrondissements
                                           WHERE idArrondissement = $idArrondissement");
										   
        $stmt->execute();
        $data = $stmt->fetch();
        return $data['nomArrondissement'];                                      // retourne le nom de cette catégorie
    }

    public function obtenirCategorieOeuvre($idOeuvre)                           // récupère l'id de la catégorie de l'oeuvre en paramètre
    {
        $stmt = $this->connexion->prepare("SELECT idCategorie 
                                           FROM Oeuvres
                                           WHERE idOeuvre = $idOeuvre");
										   
        $stmt->execute();
        $data = $stmt->fetch();
        return $data['idCategorie'];                                            // retourne l'id de la catégorie de cet oeuvre
    }
    
    public function obtenirNomCategorie($idCategorie)                           // récupère le nom de la catégorie demandée en paramètre
    {
        $stmt = $this->connexion->prepare("SELECT nomCategorie 
                                           FROM Categories
                                           WHERE idCategorie = $idCategorie");
										   
        $stmt->execute();
        $data = $stmt->fetch();
        return $data['nomCategorie'];                                           // retourne le nom de cette catégorie
    }
    
    public function verifierArtiste($param)                                     // récupère l'id d'un artiste s'il est présent dans la table
	{		
		try
		{
            $stmt = $this->connexion->prepare("SELECT *
                                               FROM Artistes 
                                               WHERE prenomArtiste = :prenomArtiste 
                                                 AND nomArtiste    = :nomArtiste 
                                                 AND collectif     = :collectif"); // est-ce qu'il y a concordance ?
												 
            //référence : http://php.net/manual/en/function.extract.php
            extract($param);                                                    // extrait le tableau de variables en paramètre
            $stmt->execute(
			array(
				":prenomArtiste" => $prenomArtiste,
                ":nomArtiste"    => $nomArtiste,
                ":collectif"     => $collectif)
			);
			
            $data = $stmt->fetch();
            return $data['idArtiste'];                                          // retourne l'id de l'artiste s'il existe, sinon null
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
    
    /////////////////////////////////   SOUMISSION   ////////////////////////////////////////////
    /*
    public function obtenirDerniereSoumission()                                 // récupère toutes les entrées de la dernière soumission???
    {
		// function pas fini (test)
        try
		{
            $idDernierOeuvre = $this->obtenirDernierIdOeuvre();
            $idArrondissement = $this->obtenirArrondissementOeuvre($idDernierOeuvre);
            $idCategorie = $this->obtenirCategorieOeuvre($idDernierOeuvre);
            
            $stmt = $this->connexion->prepare("SELECT titre, titreVariante, nomArrondissement, nomCategorie
                                               FROM Oeuvres
                                               JOIN Arrondissements ON Oeuvres.idArrondissement
                                               JOIN Categories ON Oeuvres.idCategorie
                                               WHERE idOeuvre = $idDernierOeuvre
                                               AND Arrondissements.idArrondissement = $idArrondissement
                                               AND Categories.idCategorie = $idCategorie");
											   
            $stmt->execute();
            return $stmt->fetchAll();
        }
		catch(Exception $exc)
		{
			return 0;
		}
    }*/
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    public function insererSoumissionOeuvre($param)                             // insère les entrées d'une soumission dans la table Oeuvres
    {
        try
        {   
            $stmt = $this->connexion->prepare("INSERT INTO Oeuvres 
			(
				titre, 
                titreVariante,
                dateFinProduction,
                dateAccession,
                nomCollection,
                modeAcquisition,
                materiaux,
                technique,
                dimensions,
                parc,
                batiment,
                adresseCivique,
                latitude,
                longitude,
                description,
                idCategorie,
                idArrondissement
            ) 
            VALUES 
			(
				:titre, 
                :titreVariante,
                :dateFinProduction,
                :dateAccession,
                :nomCollection,
                :modeAcquisition,
                :materiaux,
                :technique,
                :dimensions,
                :parc,
                :batiment,
                :adresseCivique,
                :latitude,
                :longitude,
                :description,
                :idCategorie,
                :idArrondissement
            )");
            
            extract($param);                                                    // extrait le tableau de variables en paramètre
            $stmt->execute(
			array(
				":titre"             => $titre, 
				":titreVariante"     => $titreVariante,
				":dateFinProduction" => $dateFinProduction,
				":dateAccession"     => $dateAccession,
				":nomCollection"     => $nomCollection,
				":modeAcquisition"   => $modeAcquisition,
				":materiaux"         => $materiaux,
				":technique"         => $technique,
				":dimensions"        => $dimensions,
				":parc"              => $parc,
				":batiment"          => $batiment,
				":adresseCivique"    => $adresseCivique,
				":latitude"          => $latitude,
				":longitude"         => $longitude,
				":description"       => $description,
				":idCategorie"       => $idCategorie,
				":idArrondissement"  => $idArrondissement
            ));
			
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function insererUrlPhoto($param, $idOeuvre = null)                   // insère l'entrée dans la table Photos
    {
        try
        {
            if($idOeuvre == null)                                               // toujours null, demande l'id de l'oeuvre en soumission
			{
                $idOeuvre = $this->obtenirDernier("idOeuvre", "Oeuvres");       // récupère l'id de l'oeuvre en soumission
			} 
            
            $stmt = $this->connexion->prepare("INSERT INTO Photos (urlPhoto, idOeuvre) 
                                                           VALUES (:urlPhoto, :idOeuvre)");
            
            extract($param);                                                    // extrait le tableau de variables en paramètre
            $stmt->execute(
			array(
				":urlPhoto" => $urlPhoto,
                ":idOeuvre" => $idOeuvre
			));
            
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }

    public function insererSoumissionArtiste($param)                            // insère les entrées dans la table Artiste, appelé si l'artiste n'existe pas
    {
        try
        {
            $stmt = $this->connexion->prepare("INSERT INTO Artistes 
			(
				prenomArtiste,
                nomArtiste,
                collectif
			)
            VALUE 
			(
				:prenomArtiste,
                :nomArtiste, 
                :collectif
			)");
			
            extract($param);                                                    // extrait le tableau de variables en paramètre
            $stmt->execute(
			array(
				":prenomArtiste" => $prenomArtiste,
				":nomArtiste"    => $nomArtiste,
				":collectif"     => $collectif
			));
			
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function insererSoumissionArtisteOeuvres($idArtiste = null, $idOeuvre = null)    // table lien N:M artiste / oeuvre 
    {
        try
        {
            if($idArtiste == null)                                              // si l'artiste n'existe pas dans la table
			{
				$idArtiste = $this->obtenirDernier("idArtiste", "Artistes");    // récupère l'id du dernier artiste soumis
                
			}
            
            if($idOeuvre == null)                                               // toujours null, demande l'id de l'oeuvre en soumission
			{
				$idOeuvre = $this->obtenirDernier("idOeuvre", "Oeuvres");       // récupère l'id de l'oeuvre en soumission
			}
            
            $stmt = $this->connexion->prepare("INSERT INTO ArtistesOeuvres  
			(
				idArtiste, 
				idOeuvre
			) 
            VALUES 
			(
				:idArtiste, 
				:idOeuvre
			)");
            
            $stmt->execute(
			array(
				":idArtiste" => $idArtiste,
				":idOeuvre"  => $idOeuvre
			));
            
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
}

?>