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
abstract class Modelebase {
	
    protected $connexion;
	
	
	abstract protected function getTable();
	
	
	
	/*public function __construct()
	{
		try
		{
			$this->connexion = new PDO("mysql:dbname=partoutMTL;host=localhost", "root", "");
		}
		catch(Exception $exc)
		{
			die("Connexion à la base de données impossible.");
		}
	}*/
	
	function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}
	
		
	/**
	 * @access public
	 * @return Array
	 */
	public function connexionBD() 
	{
		
		try
			{
				$connexion = new PDO("mysql:dbname=partoutMTL;host=localhost", "root", "");
				return $connexion;
			
			}
			catch(Exception $exc)
			{
				die("Connexion à la base de données impossible.");
			}
	}
	
	public function compteRanges(){
			
			try
			{	
				$connexion = $this->connexionBD();
				$stmt = $connexion->prepare("SELECT COUNT(*) AS quantite FROM " . $this->getTable());
				$stmt->execute();
				return $stmt->fetch();
			}
			catch(Exception $exc)
			{
				return false;
			}
			
		}
	
	
}




?>