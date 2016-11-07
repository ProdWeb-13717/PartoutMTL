<?php
	
	abstract class TemplateBase
	{
		protected $connexion;
		
		protected function getPrimaryKey()
		{
			return "id";			
		}
		
		abstract protected function getTable();
		
		public function __construct()
		{
			try
			{
				$this->connexion = new PDO("mysql:dbname=partoutmtl;host=localhost", "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			}
			catch(Exception $exc)
			{
				die("Connexion à la base de données impossible.");
			}
		}
		
		/*public function connexionBD() 
		{
			
			try
				{
					$connexion = new PDO("mysql:dbname=partoutMTL;host=localhost", "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//derniere attribut necessaire pour garder les donnees en UTF-8 
					return $connexion;
				
				}
				catch(Exception $exc)
				{
					die("Connexion à la base de données impossible.");
				}
		}*/
		
		
	
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
				$stmt = $this->connexion->prepare("delete from choix where idJoueurChoix = :valeur");
				$stmt->bindParam(":valeur", $valeur);
				$stmt->execute();
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
		
		public function compteRanges(){
			
			try
			{	
			
				$stmt = $this->connexion->prepare("SELECT COUNT(*) AS quantite FROM " . $this->getTable());
				$stmt->execute();
				return $stmt->fetch();
			}
			catch(Exception $exc)
			{
				return false;
			}
			
		}
		
		
		public function modifierStats($id, $buts, $pass)
		{
			try
			{
				$stmt = $this->connexion->prepare("update joueurs set nombreButs= :buts,nombrePass= :pass where idJoueur =:id");
				$stmt->execute(array(":buts" => $buts, ":pass" => $pass, ":id" => $id ));
				return 1;
			}
			catch(Exception $exc)
			{
				return 0;
			}
		}
	
	
	}
?>