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

class modeleSoumissionUsager extends TemplateBase 
{    

    protected function getPrimaryKey()
	{
		return "";
	} 
	
	public function getTable()
	{
		return "Arrondissements";
	}
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function insererSoumission($param)                                   // insère les entrées d'une soumission dans la table Soumissions
    {   
        try
        {   
            $stmt = $this->connexion->prepare("INSERT INTO Soumissions 
			(
				titreSoumission,
                prenomArtisteSoumission,
                nomArtisteSoumission,
                collectifSoumission,
                idArrondissementSoumission,
                parcSoumission,
                adresseCiviqueSoumission,
                descriptionSoumission,
                courrielSoumission
            ) 
            VALUES 
			(
				:titreSoumission,
                :prenomArtisteSoumission,
                :nomArtisteSoumission,
                :collectifSoumission,
                :idArrondissementSoumission,
                :parcSoumission,
                :adresseCiviqueSoumission,
                :descriptionSoumission,
                :courrielSoumission         
            )");
            
            extract($param);                                                    // extrait le tableau de variables en paramètre
            
            $stmt->execute(
			array(
				":titreSoumission"              => $titreSoumission,
                ":prenomArtisteSoumission"      => $prenomArtisteSoumission,
                ":nomArtisteSoumission"         => $nomArtisteSoumission,
                ":collectifSoumission"          => $collectifSoumission,
                ":idArrondissementSoumission"   => $idArrondissementSoumission,
                ":parcSoumission"               => $parcSoumission,
                ":adresseCiviqueSoumission"     => $adresseCiviqueSoumission,
                ":descriptionSoumission"        => $descriptionSoumission,
                ":courrielSoumission"           => $courrielSoumission
            ));
        
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    
    public function insererPhotoSoumission($photo, $idSoumission = null)        // insère l'entrée photoSoumission dans la table Soumissions
    {   
        try
        {   
            if($idSoumission == null)                                           // toujours null, demande l'id de la soumission
			{
                $idSoumission = $this->obtenirDernier("idSoumission", "Soumissions");   // récupère l'id de la soumission
			}
            
            $stmt = $this->connexion->prepare("UPDATE Soumissions 
                                               SET photoSoumission = :photo
                                               WHERE idSoumission = $idSoumission");
            
            $stmt->execute(array(":photo" => $photo));
        
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }  
}

?>