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
class Arrondissements extends TemplateBase 
{
	protected function getPrimaryKey()
	{
		return "idArrondissement";
	}  
	 
	public function getTable()
	{
		return "Arrondissements";
	}
	
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      SELECT      /////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
     
	public function obtenirArrondissement($arrondissement)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("SELECT * FROM " . $this->getTable() . " WHERE nomArrondissement = :arrondissement");
			$stmt->bindParam(":arrondissement", $arrondissement);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
   
    
    ///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
    
	public function insererArrondissement($arrondissement)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ". $this->getTable() ." (nomArrondissement) VALUES(:arrondissement)");
			$stmt->bindParam(":arrondissement", $arrondissement);
			$stmt->execute();
			
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
}

?>
