<?php

/**
 * Class Controleur
 * G�re les requ�tes a la Base de donnees
 * 
 * @author Guillaume Harvey
 * @version 1.0
 * 
 */
 
 
 
	abstract class TemplateBase
	{
		protected $connexion;
		
		abstract protected getPrimaryKey(); //exemple pour Oeuvres = getPrimaryKey(){ return "idOeuvre"}
		
		abstract protected function getTable(); //exemple pour Oeuvres = getTable(){ return "Oeuvres"}
		
		public function __construct()
		{
			try
			{
				$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5");
			}
			catch(Exception $exc)
			{
				die("Connexion � la base de donn�es impossible.");
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
		
	
	
	}
?>