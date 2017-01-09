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
class Artistes extends TemplateBase 
{
	protected function getPrimaryKey()
	{
		return "idArtiste";
	} 
	 
	public function getTable()
	{
		return "Artistes";
	}
	
	public function obtenirArtiste($nom,$prenom,$collectif)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("SELECT * FROM " . $this->getTable() . " WHERE nomArtiste = :nom AND prenomArtiste = :prenom AND collectif = :collectif");
			$stmt->execute(
			array(
			
				":nom"          => $nom, 
				":prenom"   	=> $prenom,
				":collectif" 	=> $collectif

			));
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
    
    //public function obtenirArtisteDuneOeuvre
    
	
	public function insererArtiste($nom,$prenom,$collectif)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ". $this->getTable() ." (nomArtiste,prenomArtiste,collectif) VALUES(:nom, :prenom, :collectif)");
			$stmt->execute(
			array(
				":nom"          => $nom, 
				":prenom"   	=> $prenom,
				":collectif" 	=> $collectif
			));
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
}

?>