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
class Donnesremote {
	
    
	function __construct ()
	{
		
	}
	
	function __destruct ()
	{
		
	}
	
		
	/**
	 * @access public
	 * @return Array
	 */
	public function getpublicJSON() 
	{
		
		$donnesPublic = file_get_contents("http://donnees.ville.montreal.qc.ca/dataset/2980db3a-9eb4-4c0e-b7c6-a6584cb769c9/resource/18705524-c8a6-49a0-bca7-92f493e6d329/download/oeuvresdonneesouvertes.json");
		$donnesJson = json_decode($donnesPublic);
		return $donnesJson;
	}
}




?>