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
    ////////////////////////////////      SELECT      /////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////

    
    public function verifierCourrielUsager($param)                                                          // vérifie si un courriel est déjà présent dans la table CourrielsUsagers
	{		
		try
		{
            $stmt = $this->connexion->prepare("SELECT *
                                               FROM CourrielsUsagers 
                                               WHERE courrielUsager = :courrielUsager");                    // est-ce qu'il y a concordance ?
												 
            //référence : http://php.net/manual/en/function.extract.php
            extract($param);                                                                                // convertit le paramètre en tableau de variables
            $stmt->execute(array(":courrielUsager" => $courrielSoumission));                                // récupère la variable courrielSoumission
			
            $data = $stmt->fetch();
            return $data['idCourrielUsager'];                                                               // retourne l'id du courriel s'il existe, sinon null
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
    
    public function insererSoumission($param)                                                               // insère les entrées d'une soumission dans la table Soumissions
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
            
            extract($param);                                                                                // convertit le paramètre en tableau de variables
            $stmt->execute(                                                                                 // récupère les variables 
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
    
    
    public function insererPhotoSoumission($photo, $idSoumission = null)                                    // insère le nouveau nom de la photo dans la table Soumissions
    {   
        try
        {   
            if($idSoumission == null)                                                                       // toujours null, demande l'id de la soumission
			{
                $idSoumission = $this->obtenirDernier("idSoumission", "Soumissions");                       // récupère l'id de la soumission, forcément le dernier
			}
            
            $stmt = $this->connexion->prepare("UPDATE Soumissions 
                                               SET photoSoumission = :photo
                                               WHERE idSoumission = $idSoumission");                        // écrit le nouveau nom de la photo
            
            $stmt->execute(array(":photo" => $photo));                                                      // avec le nom placé en paramètre
        
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
    public function insererCourrielUsager($param)                                                           // insère un nouveau courriel dans la table CourrielsUsagers
    {   
        try
        {   
            $stmt = $this->connexion->prepare("INSERT INTO CourrielsUsagers (courrielUsager) 
                                               VALUES (:courrielUsager)");
            
            extract($param);                                                                                // convertit le paramètre en tableau de variables
            
            $stmt->execute(array(":courrielUsager" => $courrielSoumission));                                // récupère la variable courrielSoumission
        
            return 1;		     
        }	
        catch(Exception $exc)
        {
            return 0;
        }   
    }
    
}

?>