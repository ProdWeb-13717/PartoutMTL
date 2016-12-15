<?php
date_default_timezone_set('America/Toronto');//Obtenir l'heure avec la zone Toronto (functionne pour Montréal aussi) pour ce script

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
class MiseaJour extends TemplateBase 
{
	protected function getPrimaryKey()
	{
		return "idMiseAJour";
	} 
	 
	public function getTable()
	{
		return "MiseAJours";
	}
	
	public function enregistrement($donnes)
	{	
		$momentImportation =  date("Y-m-d H:i");// obtienne le moment de l'importation de donnés pour la gerder dans la table des historiques
		
		$this->insererMisAJour($momentImportation,$donnes["Oeuvres"],$_SESSION['authentifie']);
		/*echo $_SESSION['authentifie'];
		echo "<br>";
		echo $donnes["Artistes"];
		echo "<br>";
		echo $donnes["Oeuvres"];
		echo "<br>";*/
		
	}
	
	public function insererMisAJour($date,$nOeuvres,$usager)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO". $this->getTable() ." (dateMiseAJour,nbOeuvres,nomUsagerAdmin) VALUES (:date, :oeuvres, :usager)");
			$stmt->execute(array(
			
				"date"				=>$date,
				"oeuvres"			=>$nOeuvres,
				"usager"			=>$usager
			
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