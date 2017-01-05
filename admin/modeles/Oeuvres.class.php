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
class Oeuvres extends TemplateBase 
{
	 
	protected function getPrimaryKey()
	{
		return "idOeuvre"; 
	} 
	
	
	public function getTable()
	{
		return "Oeuvres";
	}
	
	public function obtenirOeuvre($noInterne)
	{		
		try
		{	
			$stmt = $this->connexion->prepare("select * from " . $this->getTable() . " where noInterne = :noInterne");
			$stmt->bindParam(":noInterne", $noInterne);
			$stmt->execute();
			return $stmt->fetch();
		}
		catch(Exception $exc)
		{
			return false;
		}
	}
	
	public function traiterOeuvre($oeuvre,$arrondissements,$categories)
	{		
		//Effacer les spaces des valeurs numeriques pour eviter des conflits
		$oeuvre->CoordonneeLatitude = trim($oeuvre->CoordonneeLatitude);
		$oeuvre->CoordonneeLongitude = trim($oeuvre->CoordonneeLongitude);
		
		
		//Conversion de les donnes en date time
		
		$expDate = "/-?([0-9]{10,13})/";//Expression reguliere pour obtenir le timestamp
		if($oeuvre->DateFinProduction != null)
		{
			preg_match($expDate, $oeuvre->DateFinProduction, $resultat);
			$oeuvre->DateFinProduction = date("Y-m-d", $resultat[0]/1000);
		}
		if($oeuvre->DateAccession != null)
		{
			preg_match($expDate, $oeuvre->DateAccession, $resultat);
			$oeuvre->DateAccession = date("Y-m-d", $resultat[0]/1000);	
		}
		
		//Obtenir l'id de la categorie de l'oeuvre
		
		$noCategories = count($categories);
		for($i=0;$i<$noCategories;$i++)
		{
			if($oeuvre->SousCategorieObjet == $categories[$i]["nomCategorie"])
			{
				$idCat = $categories[$i]["idCategorie"];
				break;
			}
			
		}
		
		//Obtenir l'id d'arrondissement de l'oeuvre
		
		$noArrondissements = count($arrondissements);
		for($i=0;$i<$noArrondissements;$i++)
		{
			if($oeuvre->Arrondissement == $arrondissements[$i]["nomArrondissement"])
			{
				$idArron = $arrondissements[$i]["idArrondissement"];
				break;
			}
			
		}
		
		$insertion = $this->insererOeuvre
		(
			$oeuvre->Titre,
			$oeuvre->TitreVariante,
			$oeuvre->DateFinProduction,
			$oeuvre->DateAccession,
			$oeuvre->NomCollection,
			$oeuvre->ModeAcquisition,
			$oeuvre->Materiaux,
			$oeuvre->Technique,
			$oeuvre->DimensionsGenerales,
			$oeuvre->Parc,
			$oeuvre->Batiment,
			$oeuvre->AdresseCivique,
			$oeuvre->CoordonneeLatitude,
			$oeuvre->CoordonneeLongitude,
			$oeuvre->NumeroAccession,
			$oeuvre->NoInterne,
			$idCat,
			$idArron
		);
	}
	
	public function insererOeuvre
	(
		$titre,
		$titrevar,
		$dateFin,
		$dateAcc,
		$nomCol,
		$modeAcq,
		$material,
		$tech,
		$dimension,
		$parc,
		$batiment,
		$addCiv,
		$lat,
		$longu,
		$numAcc,
		$numInt,
		$idCat,
		$idArron
	)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ". $this->getTable() ."
			(
				titre,
				titreVariante,
				dateFinProduction,
				dateAccession,
				nomCollection,
				modeAcquisition,
				materiaux,
				technique,
				dimensions,
				parc,
				batiment,
				adresseCivique,
				latitude,
				longitude,
				numeroAccession,
				noInterne,
				idCategorie,
				idArrondissement
			) 
			VALUES
			(
				:titre,
				:titreVariante,
				:dateFinProduction,
				:dateAccession,
				:nomCollection,
				:modeAcquisition,
				:materiaux,
				:technique,
				:dimensions,
				:parc,
				:batiment,
				:adresseCivique,
				:latitude,
				:longitude,
				:numeroAccession,
				:noInterne,
				:idCategorie,
				:idArrondissement
			)");
			
			$stmt->execute(
			array(
				
				":titre"				=> $titre,
				":titreVariante"		=> $titrevar,
				":dateFinProduction"	=> $dateFin,
				":dateAccession"		=> $dateAcc,
				":nomCollection"		=> $nomCol,
				":modeAcquisition"		=> $modeAcq,
				":materiaux"			=> $material,
				":technique"			=> $tech,
				":dimensions"			=> $dimension,
				":parc"				 	=> $parc,
				":batiment"			 	=> $batiment,
				":adresseCivique"		=> $addCiv,
				":latitude"			 	=> $lat,
				":longitude"			=> $longu,
				":numeroAccession"		=> $numAcc,
				":noInterne"			=> $numInt,
				":idCategorie"			=> $idCat,
				":idArrondissement"		=> $idArron
				
			));
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}
	
	/*public function completerOeuvre($numInt,$idCat,$idArron)
	{
		try
		{	
			$stmt = $this->connexion->prepare("UPDATE ". $this->getTable() ." SET idCategorie = :idCat, idArrondissement= :idArron WHERE noInterne = :numInt");
			$stmt->execute(array(
			
				"idCat"					=>$idCat,
				"idArron"				=>$idArron,
				"numInt"				=>$numInt
			
			));
			return 1;
		}
		catch(Exception $exc)
		{
			return 0;
		}
	}*/
	
	public function inclureArtistesOeuvres($oeuvreJson,$listeOeuvres,$qOeuvres,$listeArtistes,$qArtistes)
	{

		for($i=0;$i<$qOeuvres;$i++)
		{
			if($listeOeuvres[$i]["noInterne"]==$oeuvreJson->NoInterne)
			{
				
				$idOeuvre = $listeOeuvres[$i]["idOeuvre"];
			}
			
		}
		foreach($oeuvreJson->Artistes as $artiste)
		{
			for($i=0;$i<$qArtistes;$i++)
			{
				$artActuelle = $artiste->Nom ." ".$artiste->Prenom ." ".$artiste->NomCollectif;
				$artActuelleBD = $listeArtistes[$i]["nomArtiste"] ." ".$listeArtistes[$i]["prenomArtiste"] ." ".$listeArtistes[$i]["collectif"];
				if($artActuelle == $artActuelleBD)
				{
					$idArtiste = $listeArtistes[$i]["idArtiste"];
					$this->insererArtistesOeuvres($idArtiste,$idOeuvre);
					break;
				}
			
			}
		}
		
	}
	
	public function insererArtistesOeuvres($idArt,$idOeuvre)
	{
		try
		{	
			$stmt = $this->connexion->prepare("INSERT INTO ArtistesOeuvres (idArtiste,idOeuvre) VALUES (:idArt, :idOeuvre)");
			$stmt->execute(array(
			
				"idArt"				=>$idArt,
				"idOeuvre"			=>$idOeuvre
			
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