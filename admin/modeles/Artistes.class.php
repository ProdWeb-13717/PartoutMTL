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
class Artistes extends TemplateBase {
	
    
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
		return "Artistes";
	}
	
	public function obtenirArtiste($nom,$prenom,$collectif)
	{		
		try
		{	
			
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where nomArtiste = :nom and prenomArtiste = :prenom and collectif = :collectif");
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function insererArtiste($nom,$prenom,$collectif,$nointerne)
	{		
		try
		{	
			//$connexion = $this->connexionBD();
			$stmt = $this->connexion->prepare("insert into ". $this->getTable() ." (noInterne,nomArtiste,prenomArtiste,collectif) values(:noInterne, :nom, :prenom, :collectif)");
			$stmt->bindParam(":noInterne", $nointerne);
			$stmt->bindParam(":nom", $nom);
			$stmt->bindParam(":prenom", $prenom);
			$stmt->bindParam(":collectif", $collectif);
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