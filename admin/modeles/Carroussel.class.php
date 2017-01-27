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
class Carroussel extends TemplateBase 
{
	 
	protected function getPrimaryKey()
	{
		return "idCaroussel"; 
	} 
	
	
	public function getTable()
	{
		return "Carroussel";
	}
	
		
	///////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////      INSERT     //////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////
	
	
	public function ajouterImageCarroussel($titre,$idPhoto,$idOeuvre)
	{
		try
		{	
			$urlPhoto = "photo_" . $idPhoto . ".jpg";
			$urlLien = "index.php?requete=afficheOeuvre&idOeuvre=1271" . $idOeuvre;
			$stmt = $this->connexion->prepare("INSERT INTO Carroussel (titre,urlPhoto, urlLien) VALUES (:titre, :urlPhoto, :urlLien)");
			$stmt->execute(array(
			
				"titre"				=>$titre,
				"urlPhoto"			=>$urlPhoto,
				"urlLien"			=>$urlLien
			
			));
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	public function obtenirTousImages()
	{
		try
		{	
			$stmt = $this->connexion->prepare("SELECT * FROM Photos");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		catch(Exception $exc)
		{
			return array();
		}
	}
	

	
}

?>