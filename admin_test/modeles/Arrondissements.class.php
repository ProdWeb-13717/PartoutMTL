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
class Arrondissements extends TemplateBase {
	
    
	/*function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}*/
	
		
	/**
	 * @access public
	 * @return Array
	 */
	 
	protected function getPrimaryKey()
	{
		return "Je ne sert à rien dans cette classe";
	}  
	 
	public function getTable()
	{
		return "Arrondissements";
	}
	
	public function obtenirArrondissement($arrondissement)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where nomArrondissement = :arrondissement");
			$stmt->bindParam(":arrondissement", $arrondissement);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function insererArrondissement($arrondissement)
	{		
		try
		{	
			//$connexion = $this->connexionBD();
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (nomArrondissement) values(:arrondissement)");
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
