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
    
    ////////////////////////////////      TABLE       /////////////////////////////////////////
    
    public function obtenirArrondissements()                                    // récupère toute la table Arrondissements
    {
        $stmt = $this->connexion->prepare("SELECT * FROM Arrondissements ORDER BY nomArrondissement ASC");
        $stmt->execute();
        return $stmt->fetchAll();                                               // retourne tous les arrondissements
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
                photoSoumission,
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
                :photoSoumission,
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
                ":photoSoumission"              => $photoSoumission,
                ":courrielSoumission"           => $courrielSoumission
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