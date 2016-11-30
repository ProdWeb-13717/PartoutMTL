<?php
set_time_limit(300);
/**
 * Class Controleur
 * Gère les requêtes a la Base de donnees
 * 
 * @author Guillaume Harvey
 * @version 1.0
 * 
 */



abstract class TemplateBase
{
	protected $connexion;
	
	abstract protected function getPrimaryKey(); //exemple pour Oeuvres = getPrimaryKey(){ return "idOeuvre"}
	
	abstract protected function getTable(); //exemple pour Oeuvres = getTable(){ return "Oeuvres"}
	
	public function __construct()
	{
		
		
		try
		{

			$this->connexion = new PDO("mysql:dbname=PartoutMTL;host=107.180.109.70:3306", "partout", "equipeDeCourse5", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

		}
		catch(Exception $exc)
		{
			die("Connexion à la base de données impossible.");
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
	
	public function obtenirTous($table = null, $cle = null)
	{
		if($table = null)
		{
			$table = getTable();
		}
		try
		{	
			$stmt = $this->connexion->prepare("SELECT * FROM " . $table . " ORDER BY " . $cle);
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