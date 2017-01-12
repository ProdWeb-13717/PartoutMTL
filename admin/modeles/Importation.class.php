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
class Importation extends TemplateBase 
{
	protected function getPrimaryKey()
	{
		return "idMiseAJour";
	} 
	 
	public function getTable()
	{
		return "MiseAJours";
	}
	
	public function traiterDonnees($jsonSite,$action)
	{
		
		$nomOeuvres = count($jsonSite);//numero des oeuvres dans le Json
		
		/////////////////////////////////////////////////////
		///////////////traitement des artistes///////////////
		/////////////////////////////////////////////////////
		
		$tabArtistes = $this->obtenirTabArtistes(); // Obtenir la derniere liste des artistes de la BD
		
		//arrays pour garder les nouveaux artistes a inclure dans la BD
		$tableauNom = array();
		$tableauPrenom = array();
		$tableauCollectif = array();
		/////////////////////////////////////
		
		
		$novArtistes = 0;// compter la quantité des nouveaux artistes
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les oeuvres
		{
			foreach($jsonSite[$i]->Artistes as $artiste)
			{
				$ilExiste = $this->verifierArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif,$tabArtistes);//je dois faire ça me contre mon array, pa contre la BD
				if(!$ilExiste)
				{
					$artActuelle = $artiste->Nom ." ".$artiste->Prenom ." ".$artiste->NomCollectif;
					array_push($tabArtistes,$artActuelle);//on insere dans tabArtistes pour eviter des doublons
					array_push($tableauNom,$artiste->Nom);
					array_push($tableauPrenom,$artiste->Prenom);
					array_push($tableauCollectif,$artiste->NomCollectif);
					$novArtistes++;
				}
			}
			
		}
		if($action == "importationBD")
		{
			for($i=0;$i<$novArtistes;$i++)
			{
				$this->inclureArtiste($tableauNom[$i],$tableauPrenom[$i],$tableauCollectif[$i]);
				
			}
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des arrondissements////////
		/////////////////////////////////////////////////////
		
		$tabArrondissements = $this->obtenirTabArrondissements();//Obtenir la derniere liste des arrondissements de la BD
		
		//array pour garder les nouveaux arrondissements à inclure dans la BD
		$tableauNomarrondissement = array();
		///////////////////////
		
		$novArrondissements = 0;// compter la quantité des nouveaux arrondissements
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les arrondissement
		{
			$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement,$tabArrondissements);
			if(!$ilExiste)
			{
				array_push($tabArrondissements,$jsonSite[$i]->Arrondissement);
				array_push($tableauNomarrondissement,$jsonSite[$i]->Arrondissement);
				$novArrondissements++;	
			}
		}
		if($action == "importationBD")
		{
			for($i=0;$i<$novArrondissements;$i++)
			{
				$this->inclureArrondissement($tableauNomarrondissement[$i]);
			}
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des categories/////////////
		/////////////////////////////////////////////////////
		
		$tabCategories = $this->obtenirTabCategories();//Obtenir la derniere liste des categories de la BD
		
		//array pour garder les nouveaux categories à inclure dans la BD
		$tableauNomcategorie = array();
		///////////////////////
		
		$novCategories = 0;
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les categories
		{
			$ilExiste = $this->verifierCategorie($jsonSite[$i]->SousCategorieObjet,$tabCategories);
			if(!$ilExiste)
			{
				array_push($tabCategories,$jsonSite[$i]->SousCategorieObjet);
				array_push($tableauNomcategorie,$jsonSite[$i]->SousCategorieObjet);
				$novCategories++;	
			}
		}
		if($action == "importationBD")
		{
			for($i=0;$i<$novCategories;$i++)
			{
				$this->inclureCategorie($tableauNomcategorie[$i]);
			}
		}
		
		
		/////////////////////////////////////////////////////
		///////////////traitement des oeuvres////////////////
		/////////////////////////////////////////////////////

		//Obtenir la derniere liste des oeuvres de la BD
		$tabOeuvres = $this->obtenirTabOeuvres();
		
		//Obtenir la derniere liste des arrondissements dans la BD
		$oArrondissementsListe = new Arrondissements();
		$listeArrondissements = $oArrondissementsListe->obtenirTous("Arrondissements","idArrondissement");//contienne le resultat du tableau avec les arrondissement
		
		//Obtenir la derniere liste des categories dans la BD
		$oCategoriesListe = new Categories();
		$listeCategories = $oCategoriesListe->obtenirTous("Categories","idCategorie");//contienne le resultat du tableau avec les categories
		
		$novOeuvres = 0;
		
		for($i=0;$i<$nomOeuvres;$i++)
		{
			$ilExiste = $this->verifierOeuvre($jsonSite[$i]->Titre,$jsonSite[$i]->TitreVariante,$jsonSite[$i]->NoInterne,$tabOeuvres);//verification par NoInterne d'oeuvre
			if(!$ilExiste)
			{
				switch($action)
				{
					case "importationBD":
					
						$novOeuvres++;
						$this->inclureOeuvre($jsonSite[$i],$listeArrondissements,$listeCategories);
						break;
					
					case "verification":
						
						$novOeuvres++;
						break;
				}
			}
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des Oeuvres-Artistes///////
		/////////////////////////////////////////////////////
		
		/******** Obtenir la derniere liste des Oeuvres dans la BD*************/
		$oOeuvresListe = new Oeuvres();
		$listeOeuvres = $oOeuvresListe->obtenirTous("Oeuvres","idOeuvre");//contienne le resultat du tableau avec les oeuvres
		$nomOeuvresBD = count($listeOeuvres);
		/******** Obtenir la derniere liste des artistes dans la BD*************/
		$oArtistesListe = new Artistes();
		$listeArtistes = $oArtistesListe->obtenirTous("Artistes","idArtiste");
		$nomOArtistes = count($listeArtistes);
		
		if($action == "importationBD")
		{
			for($i=0;$i<$nomOeuvres;$i++)
			{
				$this->insererArtisteOeuvre($jsonSite[$i],$listeOeuvres,$nomOeuvresBD,$listeArtistes,$nomOArtistes);
			}
		}
		
		$dataUpdate = 
			[
				'Artistes' => $novArtistes,
				'Arrondissements'  => $novArrondissements, 
				'Categories'  => $novCategories, 
				'Oeuvres'  => $novOeuvres,
				'OeuvresTotal' => $nomOeuvresBD
			];
		return $dataUpdate;
		
	}
	
	//***** functions par rapport à des traitement des artistes
	private function obtenirTabArtistes()
	{	
		//obtienne tous les artistes dans la BD dans un tableau avec le format nom prenom collectif pour faciliter la comparaison
		$oArtistesListe = new Artistes();
		$listeArtistes = $oArtistesListe->obtenirTous("Artistes","idArtiste");//contienne le resultat du tableau avec les artistes
		$nomArtistes = count($listeArtistes);
		$tableau = array();
		for($i=0;$i<$nomArtistes;$i++)
		{
			$artiste = $listeArtistes[$i]["nomArtiste"]." ".$listeArtistes[$i]["prenomArtiste"]." ".$listeArtistes[$i]["collectif"];
			array_push($tableau,$artiste);
		}
		return $tableau;
	}
	
	private function verifierArtiste($nom,$prenom,$collectif,$mesArtistes)
	{
		$nomArtistes = count($mesArtistes);
		
		if($nomArtistes == 0)
		{
			return false;
		}
		else
		{
			for($i=0;$i<$nomArtistes;$i++)// cherche si l'artiste est dans la liste des artistes deja existant dans la BD
			{
				$artActuelle = $nom." ".$prenom." ".$collectif;
				if($artActuelle == $mesArtistes[$i])
				{
					return true;
				}
			}
			return false;
		}
	}
	
	private function inclureArtiste($nom,$prenom,$collectif)
	{
		$oArtistes = new Artistes();
		$data = $oArtistes->insererArtiste($nom,$prenom,$collectif);
	}
	
	//***** functions par rapport à des traitement des arrondissements
	
	private function obtenirTabArrondissements()
	{
		$oArrondissementsListe = new Arrondissements();
		$listeArrondissements = $oArrondissementsListe->obtenirTous("Arrondissements","idArrondissement");//contienne le resultat du tableau avec les artistes
		$nomArrondissements = count($listeArrondissements);
		$tableau = array();
		for($i=0;$i<$nomArrondissements;$i++)
		{
			$arrondissement = $listeArrondissements[$i]["nomArrondissement"];
			array_push($tableau,$arrondissement);
		}
		return $tableau;
	}
	
	private function verifierArrondissement($arrondissement,$mesArrondissements)
	{
		$nomArrondissements = count($mesArrondissements);
		
		if($nomArrondissements == 0)
		{
			return false;
		}
		else
		{
			for($i=0;$i<$nomArrondissements;$i++)
			{
				if($arrondissement == $mesArrondissements[$i])
				{
					return true;
				}
			}
			return false;
		}
	}
	
	private function inclureArrondissement($arrondissement)
	{
		$oArrondissements = new Arrondissements();
		$data = $oArrondissements->insererArrondissement($arrondissement);
	}
	
	//***** functions par rapport à des traitement des categories
	
	private function obtenirTabCategories()
	{
		$oCategoriesListe = new Categories();
		$listeCategories = $oCategoriesListe->obtenirTous("Categories","idCategorie");//contienne le resultat du tableau avec les categories
		$nomCategories = count($listeCategories);
		$tableau = array();
		for($i=0;$i<$nomCategories;$i++)
		{
			$categorie = $listeCategories[$i]["nomCategorie"];
			array_push($tableau,$categorie);
		}
		return $tableau;
	}	
	
	
	private function verifierCategorie($categorie,$mesCategories)
	{
		$nomCategories = count($mesCategories);
		
		if($nomCategories == 0)
		{
			return false;
		}
		else
		{
			for($i=0;$i<$nomCategories;$i++)
			{
				if($categorie == $mesCategories[$i])
				{
					return true;
				}
			}
			return false;
		}
	}
	
	private function inclureCategorie($categorie)
	{
		$oCategorie = new Categories();
		$data = $oCategorie->insererCategorie($categorie);
	}
	
	//***** functions par rapport à des traitement des oeuvres
	
	private function obtenirTabOeuvres()
	{
		$oOeuvresListe = new Oeuvres();
		$listeOeuvres = $oOeuvresListe->obtenirTous("Oeuvres","idOeuvre");//contienne le resultat du tableau avec les categories
		$nomOeuvres = count($listeOeuvres);
		$tableau = array();
		for($i=0;$i<$nomOeuvres;$i++)
		{
			if($listeOeuvres[$i]["noInterne"]==null)
			{
				$Oeuvre = $listeOeuvres[$i]["titre"] ." ". $listeOeuvres[$i]["titreVariante"];
			}
			else
			{
				$Oeuvre = $listeOeuvres[$i]["noInterne"];
			}	
			array_push($tableau,$Oeuvre);
		}
		return $tableau;
	}
	
	
	private function verifierOeuvre($titre,$titreVariante,$noInterne,$mesOeuvres)
	{
		
		$nomOeuvres = count($mesOeuvres);
		
		if($nomOeuvres == 0)
		{
			return false;
		}
		else
		{
			for($i=0;$i<$nomOeuvres;$i++)
			{
				if($noInterne == $mesOeuvres[$i])
				{
					return true;
				}
			}
			for($i=0;$i<$nomOeuvres;$i++)
			{
				if($titre." ".$titreVariante == $mesOeuvres[$i])
				{
					return true;
				}
			}
			return false;
		}
	}
	
	private function inclureOeuvre($oeuvre,$arrondissements,$categories)
	{
		$oOeuvres = new Oeuvres();
		$data = $oOeuvres->traiterOeuvre($oeuvre,$arrondissements,$categories);
	}
	
	//***** functions par rapport à des traitement des oeuvresArtistes
	
	private function insererArtisteOeuvre($oeuvre,$listeOeuvres,$qOeuvres,$listeArtistes,$qArtistes)
	{
		$oOeuvres = new Oeuvres();
		$data = $oOeuvres->inclureArtistesOeuvres($oeuvre,$listeOeuvres,$qOeuvres,$listeArtistes,$qArtistes);
	}
}

?>