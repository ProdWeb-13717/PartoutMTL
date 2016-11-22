<?php
/**
 * Class Modele
 * Mod�le de classe mod�le. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du d�partement de TIM
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
			die("Connexion � la base de donn�es impossible.");
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
				$connexion = new PDO("mysql:dbname=partoutMTL;host=localhost", "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//derniere attribut necessaire pour garder les donnees en UTF-8 
				return $connexion;
			
			}
			catch(Exception $exc)
			{
				die("Connexion � la base de donn�es impossible.");
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