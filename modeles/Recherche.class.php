<?php
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
