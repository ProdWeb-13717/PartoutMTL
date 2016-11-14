<?php
<<<<<<< HEAD
=======

/**
 * Class Controleur
 * Gère les requêtes a la Base de donnees
 * 
 * @author Guillaume Harvey
 * @version 1.0
 * 
 */
 
 
 
>>>>>>> upstream/master
	abstract class TemplateBase
	{
		protected $connexion;
		
<<<<<<< HEAD
		protected function getPrimaryKey()
		{
			return "id";			
		}
		
		abstract protected function getTable();
=======
		abstract protected getPrimaryKey(); //exemple pour Oeuvres = getPrimaryKey(){ return "idOeuvre"}
		
		abstract protected function getTable(); //exemple pour Oeuvres = getTable(){ return "Oeuvres"}
>>>>>>> upstream/master
		
		public function __construct()
		{
			try
			{
<<<<<<< HEAD
<<<<<<< HEAD
				$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
=======
				//$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5");
>>>>>>> origin
			}
			catch(Exception $exc)
			{
				die("Connexion Ã  la base de donnÃ©es impossible.");
=======
				$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5");
			}
			catch(Exception $exc)
			{
				die("Connexion à la base de données impossible.");
>>>>>>> upstream/master
			}
		}
	
		public function obtenir($valeur, $cle = null)
		{
			try
			{	
				if($cle == null)
				{
					$cle = $this->getPrimaryKey();
				}
<<<<<<< HEAD
=======
				
>>>>>>> upstream/master
				$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where " . $cle . " = :valeur");
				$stmt->bindParam(":valeur", $valeur);
				$stmt->execute();
				return $stmt->fetch();
			}
			catch(Exception $exc)
			{
				return false;
			}
		}
		
		public function obtenirTous()
		{
			try
			{	
				$stmt = $this->connexion->prepare("select * from " . $this->getTable());
				$stmt->execute();
				return $stmt->fetchAll();
			}
			catch(Exception $exc)
			{
				return false;
			}
		}
		
		
		public function supprimer($valeur, $cle = null)
		{
			try
			{
				if($cle == null)
				{
					$cle = $this->getPrimaryKey();
				}
				$stmt = $this->connexion->prepare("delete from " . $this->getTable() . " where " . $cle . " = :valeur");
				$stmt->bindParam(":valeur", $valeur);
				$stmt->execute();
				return true;
			}
			catch(Exception $exc)
			{
				return false;
			}
		}
<<<<<<< HEAD
        
        
        
=======
>>>>>>> upstream/master
		
	
	
	}
?>