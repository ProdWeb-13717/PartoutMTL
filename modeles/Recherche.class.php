<?php
class Recherche extends TemplateBase {
	
    
	 
	public function getTable()
	{
		return "Oeuvres";
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
