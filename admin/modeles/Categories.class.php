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
class Categories extends TemplateBase {
	
    
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
	 
	public function getTable()
	{
		return "Categories";
	}
	
	public function obtenirCategorie($categorie)
	{		
		try
		{	
		
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where nomCategorie = :categorie");
			$stmt->bindParam(":categorie", $categorie);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function insererCategorie($categorie)
	{		
		try
		{	
			//$connexion = $this->connexionBD();
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (nomCategorie) values(:categorie)");
			$stmt->bindParam(":categorie", $categorie);
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