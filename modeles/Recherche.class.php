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
class Recherche extends TemplateBase {
	
    
	protected function getTable()
	{
		return "Oeuvres";
	}
	
	protected function getPrimaryKey()
	{
		return "";
	}
	
	public function rechercheOeuvres($valeur, $cle = null)
	{
		try
		{	
			if($cle == null)
			{
				//$cle = $this->getPrimaryKey();
				$cle = "titre";
			}
			$stmt = $this->connexion->prepare("select * from ".$this->getTable()." where `".$cle."` LIKE '".$valeur."%' "); //temp_artistes
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
}
