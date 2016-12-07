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
class ModeleListe extends TemplateBase
{
	//Fonction qui va chercher les info des artistes pour construction d'une liste
	public function getPhotoCarroussel() 
	{
		try
		{
			$stmt = $this->connexion->prepare("SELECT urlPhoto FROM Carroussel");
			$stmt->execute();
			return $stmt->fetchAll();
		}	
		catch(Exception $exc)
		{
			return 0;
		}
	}
}
?>