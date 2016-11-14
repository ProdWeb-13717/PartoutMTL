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

class SoumissionAdmin extends TemplateBase {
			
	/**
	 * @access public
	 * @return Array
	 */
    
    protected function getTable()
    {
        return "Oeuvres";
    }
    
    protected function getPrimaryKey()
    {
        return "idOeuvre";
    }
    
    
    //public function insererSoumission($categorie, $nomArtiste, $prenomArtiste, $collectif, $arrondissement, $urlPhoto, $description)
    
    public function insererSoumissionOeuvre($titre, $titreVariante, $dateFinProduction, $collection, $modeAcquisition, $dateAcquisition, $materiaux, $technique, $dimensions, $parc, $batiment, $adresseCivique, $latitude, $longitude, $description)
    {
        try
			{
				$stmt = $this->connexion->prepare("INSERT into Oeuvres (titre, 
                                                                        titreVariante, 
                                                                        dateFinProduction, 
                                                                        collection, 
                                                                        modeAcquisition,
                                                                        dateAcquisition, 
                                                                        materiaux, 
                                                                        technique, 
                                                                        dimensions, 
                                                                        parc, 
                                                                        batiment, 
                                                                        adresseCivique, 
                                                                        latitude, 
                                                                        longitude, 
                                                                        description) 
                                                               VALUES (:titre, 
                                                                       :titreVariante,
                                                                       :dateFinProduction,
                                                                       :collection,
                                                                       :modeAcquisition
                                                                       :dateAcquisition,
                                                                       :materiaux,
                                                                       :technique,
                                                                       :dimensions,
                                                                       :parc,
                                                                       :batiment,
                                                                       :adresseCivique,
                                                                       :latitude,
                                                                       :longitude,
                                                                       :description)");
				
                $stmt->execute(array(":titre"         => $titre, 
                                     ":titreVariante" => $titreVariante
                                    
                                    
                                    
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