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
    
    public function insererUrlPhoto($urlPhoto, $idOeuvre = null)                // insère l'entrée dans la table Photos
    {
        try
        {
            if($idOeuvre == null)                                               // demande l'id de la dernière oeuvre en soumission
			{               
                $idOeuvre = $this->obtenirDernier("idOeuvre", "Oeuvres");       // récupère l'id de l'oeuvre en soumission
            } 
            
            $stmt = $this->connexion->prepare("INSERT INTO Photos (urlPhoto, idOeuvre) 
                                                           VALUES (:urlPhoto, :idOeuvre)");
            
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
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      UPDATE     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function modifierOeuvre($param)
    {
        try
        {  
            $stmt = $this->connexion->prepare("UPDATE Oeuvres
                                               SET titre =              :titre,
                                                   titreVariante =      :titreVariante,
                                                   dateFinProduction =  :dateFinProduction,
                                                   dateAccession =      :dateAccession,
                                                   nomCollection =      :nomCollection,
                                                   modeAcquisition =    :modeAcquisition,
                                                   materiaux =          :materiaux,
                                                   technique =          :technique,
                                                   dimensions =         :dimensions,
                                                   parc =               :parc,
                                                   batiment =           :batiment,
                                                   adresseCivique =     :adresseCivique,
                                                   latitude =           :latitude,
                                                   longitude =          :longitude,
                                                   description =        :description,
                                                   idCategorie =        :idCategorie,
                                                   idArrondissement =   :idArrondissement
                                               WHERE idOeuvre = :idOeuvre");
            extract($param);                                                    // extrait le tableau de variables en paramètre
            $stmt->execute(
			array(
				":idOeuvre"          => $idOeuvre,
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
    
    
    public function modifierArtiste($param, $idArtiste)
    {
        try
        {  
            $stmt = $this->connexion->prepare("UPDATE Artistes
                                               SET prenomArtiste =  :prenomArtiste,
                                                   nomArtiste =     :nomArtiste,
                                                   collectif =      :collectif
                                               WHERE idArtiste = $idArtiste");
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

    public function modifierOeuvreArtiste($idOeuvre, $idArtiste)
    {
        try
        {  
            $stmt = $this->connexion->prepare("UPDATE ArtistesOeuvres
                                               SET idArtiste = :idArtiste
                                               WHERE idOeuvre = $idOeuvre");
            $stmt->execute(array(":idArtiste" => $idArtiste));
        
            return 1;
        }
        catch(Exception $exc)
        {
            return 0;
        }
    }
    
}

?>