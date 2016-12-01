<?php
/**
 * Class Controleur
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2013-12-10
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */

class Controleur 
{
	public function gerer()
	{
		//$this->afficheVue("head");
		
        switch ($_GET['requete']) 
        {
			case 'accueil':
				$this->accueil();                                                          // option quand get requete est accueil
				break;
				
				
			case 'formAutentificationAdmin':
				$this->afficheVue("head");
				$this->afficheVue("enteteAdmin");
				$this->afficheVue('FormAutentificationAdmin');
				break;
				
				
			case 'AutentificationAdmin':
				$admin = new Admin();
				//$_GET['requete'] = "accueil";
				$resultat = $admin->verificationAutentificationAdmin();
				if($resultat)
				{
					unset($_POST['usager']);
					unset($_POST['pass']);
				}
				if($resultat == false)
				{
					$this->afficheVue("head");
					$this->afficheVue("enteteAdmin");
					$this->afficheVue('FormAutentificationAdmin');
				}
				else
				{
					$this->accueil();
				}
				break;
				
				
			case 'deconnectionAdmin':
				session_unset();
				$this->accueil();  	
				break;
				
				
			case 'importation':
				$this->afficheVue("head");
				$this->afficheVue("enteteAdmin");
				$this->importation();                                                      
				break;
				
				
			case 'importationok':
				$this->afficheVue("head");
				$this->afficheVue("enteteAdmin");
				$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
				$this->traiterDonnees($publicJson);//parce qu'on envoi des donnees il n'est pas neccessaire de retourner quelque chose
				$this->importationok();                                                    
				break;
				
				
            case 'soumission':                                                          // page formulaire de soumission administrateur
				
				$this->afficherEnteteAdmin();
				$this->afficherFormSoumission();             
                break;
				
            case "insereSoumission":                                                    // à l'envoi du formulaire
                
                /*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
                $tableauContenu = json_decode (file_get_contents('php://input'), true); // decode la string JSON
                extract($tableauContenu);                                               // convertit le JSON en variables
                
                /*-- INSERT TABLE Oeuvres -------------------------------------------------*/
                $modeleSoumisionAdmin = new modeleSoumission();
                $valide = $modeleSoumisionAdmin->insererSoumissionOeuvre($tableauContenu);                                       
                if(!$valide)
				{                                                           // si non réussi
                    $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                    break;
                }
            
                /*-- INSERT TABLE Photos ---------------------------------------------------*/
                $modeleSoumisionAdmin = new modeleSoumission();
                $valide = $modeleSoumisionAdmin->insererUrlPhoto($tableauContenu);
                if(!$valide)
				{                                                           // si non réussi
                    $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                    break;
                }
                
                /*-- INSERT TABLE Artistes -------------------------------------------------*/
                $modeleSoumisionAdmin = new modeleSoumission();
                $existe = $modeleSoumisionAdmin->verifierArtiste($tableauContenu);      // vérifie si l'artiste existe dans la db
                if($existe == NULL){                                                    // s'il n'existe pas
                    $modele = new modeleSoumission();
                    $valide = $modele->insererSoumissionArtiste($tableauContenu);
                    if(!$valide)
					{                                                       // si non réussi
                        $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                        break;
                    }
                }
                
                /*-- INSERT TABLE ArtistesOeuvres ------------------------------------------*/
                $modeleSoumisionAdmin = new modeleSoumission();
                $valide = $modeleSoumisionAdmin->insererSoumissionArtisteOeuvres($existe);
                if(!$valide)
				{                                                             // si non réussi
                    $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                    break;
                }
                
                $vue = "afficheSoumission";
                $this->afficheVue($vue, $tableauContenu);    
                break;
				
            default:
				$this->accueil();
				break;   
        }
	}
    
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////     MÉTHODES DU CONTROLEUR     ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
		
    
    protected function afficheVue($nomVue, $data = null)                                    // affiche la vue 
    {
        $cheminVue = "vues/" . $nomVue . ".php";       
        if(file_exists($cheminVue))
        {
            include($cheminVue); 
        }
        else
		{
            die("Erreur 404! La vue n'existe pas.");				
        }
    }
	
    private function accueil()
    {
		if(!isset($_SESSION['authentifie']))
		{
			$this->afficheVue("head");
			$this->afficheVue("enteteAdmin");
			$vue = 'FormAutentificationAdmin';
			$this->afficheVue($vue);
		}
		else
		{
			$this->afficherEnteteAdmin();
		}
    }
	
	public function phpAlert($message)
    {
		// source : http://stackoverflow.com/questions/13837375/how-to-show-an-alert-box-in-php
        echo '<script type="text/javascript">window.alert("' . $message . '")</script>';
    }	

	protected function afficherEnteteAdmin()
	{
        $this->afficheVue("head");
		$this->afficheVue("enteteAdmin");
        $this->afficheVue("menuAdmin");
        $this->afficheVue("boutonDeconnectionAdmin");
	}
	
	private function afficherFormSoumission()
	{
		$vue = "soumissionOeuvre1";                                             // input : titre et titre variante
		$this->afficheVue($vue);
        
        $vue = "soumissionArtiste";                                             // input : prénom, nom, collectif artiste
		$this->afficheVue($vue);
        
        $modeleSoumisionAdmin = new modeleSoumission();                         // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirCategories();                     // récupère la table Categories
        $vue = "soumissionCategorie";                                           // select : catégories
        $this->afficheVue($vue, $data);
        
        $vue = "soumissionOeuvre2";                                             // input : fin production, accession, matériaux, 
		$this->afficheVue($vue);                                                //         technique, dimension
        
        $modeleSoumisionAdmin = new modeleSoumission();                         // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirArrondissements();                // récupère la table Arrondissements
        $vue = "soumissionArrondissement";                                      // select : arrondissements
        $this->afficheVue($vue, $data);
        
        $vue = "soumissionOeuvre3";                                             // inputs : parc, batiment, adresse, latitude, 
		$this->afficheVue($vue);                                                //          longitude
        
        $vue = "boutonSoumission";                                              // bouton soumission
        $this->afficheVue($vue);               
	}
	
	private function importation()
	{
		$oVue = new Vueimportation();
		$this->afficheVue("menuAdmin");
		$oVue->afficheformImportation();
		$oVue->affichePied();
	}	

	private function importationok()
	{
		$oVue = new Vueimportation();
		$this->afficheVue("menuAdmin");
		$oVue->afficheImportationok();
		$oVue->affichePied();
	}
	
	private function obtenirJSON()
	{
		$oRemote = new Donnesremote();
		return $oRemote->getpublicJSON();
	}
	
	private function traiterDonnees($jsonSite)
	{
		$nomOeuvres = count($jsonSite);//numero des oeuvres dans le Json
		//echo $nomOeuvres;
		/******** Obtenir la derniere liste des artistes de la BD*************/
		$tabArtistes = $this->obtenirTabArtistes();
		/******** Obtenir la derniere liste des arrondissements de la BD*************/
		$tabArrondissements = $this->obtenirTabArrondissements();
		/******** Obtenir la derniere liste des categories de la BD*************/
		$tabCategories = $this->obtenirTabCategories();
		/******** Obtenir la derniere liste des oeuvres de la BD*************/
		$tabOeuvres = $this->obtenirTabOeuvres();
		
		
		//***traitement des artistes***
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les oeuvres
		{
			foreach($jsonSite[$i]->Artistes as $artiste)
			{
				if($artiste->Nom == null)// verification des donnees null
				{
					$artiste->Nom = "";
				}
				if($artiste->Prenom == null)
				{
					$artiste->Prenom = "";
				}
				if($artiste->NomCollectif == null)
				{
					$artiste->NomCollectif = "";
				}
				
				$ilExiste = $this->verifierArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif,$tabArtistes);//je dois faire ça me contre mon array, pa contre la BD
				if(!$ilExiste)
				{
					$artActuelle = $artiste->Nom ." ".$artiste->Prenom ." ".$artiste->NomCollectif;
					array_push($tabArtistes,$artActuelle);
					$this->inclureArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
				}
			}
			
		}
		
		//fin traitement des artistes
		
		//*** traitement des arrondissements
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les arrondissement
		{
			$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement,$tabArrondissements);
			if(!$ilExiste)
			{
				array_push($tabArrondissements,$jsonSite[$i]->Arrondissement);
				$this->inclureArrondissement($jsonSite[$i]->Arrondissement);
			}
		}
		//fin traitement des arrondissements
		
		
		//***traitement des categories***
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les categories
		{
			$ilExiste = $this->verifierCategorie($jsonSite[$i]->SousCategorieObjet,$tabCategories);
			if(!$ilExiste)
			{
				array_push($tabCategories,$jsonSite[$i]->SousCategorieObjet);
				$this->inclureCategorie($jsonSite[$i]->SousCategorieObjet);
			}
		}
		//fin traitement des categories
		
		//*** traitement des oeuvres ***//
		
		/******** Obtenir la derniere liste des artistes dans la BD*************/
		//$tabArtistes = $this->obtenirTabArtistes();
		$oArtistesListe = new Artistes();
		$listeArtistes = $oArtistesListe->obtenirTous();
		
		/******** Obtenir la derniere liste des arrondissements dans la BD*************/
		//$tabArrondissements = $this->obtenirTabArrondissements();
		$oArrondissementsListe = new Arrondissements();
		$listeArrondissements = $oArrondissementsListe->obtenirTous();//contienne le resultat du tableau avec les arrondissement
		
		/******** Obtenir la derniere liste des categories dans la BD*************/
		//$tabCategories = $this->obtenirTabCategories();
		$oCategoriesListe = new Categories();
		$listeCategories = $oCategoriesListe->obtenirTous();//contienne le resultat du tableau avec les categories
		
		
		
		//premiere for des oeuvres
		//$j=0;
		/*for($i=0;$i<200;$i++)// for pour parcourir tout les oeuvres
		{
			//echo $j;
			//echo " <br>";
			$ilExiste = $this->verifierOeuvre($jsonSite[$i]->NoInterne,$tabOeuvres);//verification par NoInterne d'oeuvre
			if(!$ilExiste)
			{
				echo "no existe pas ".$jsonSite[$i]->NoInterne;
				echo "<br>";
				array_push($tabOeuvres,$jsonSite[$i]->NoInterne);
				$this->inclureOeuvre($jsonSite[$i],$listeArtistes,$listeArrondissements,$listeCategories);
			}
			//$j++;
			print_r($tabOeuvres);
			echo "<br>";
		}*/
		
		//deuxieme for des oeuvres
		for($i=200;$i<299;$i++)
		{
			$ilExiste = $this->verifierOeuvre($jsonSite[$i]->NoInterne,$tabOeuvres);//verification par NoInterne d'oeuvre
			if(!$ilExiste)
			{
				echo "no existe pas ".$jsonSite[$i]->NoInterne;
				echo "<br>";
				array_push($tabOeuvres,$jsonSite[$i]->NoInterne);
				$this->inclureOeuvre($jsonSite[$i],$listeArtistes,$listeArrondissements,$listeCategories);
			}
		}
		//print_r($tabOeuvres);
		//fin traitement des oeuvres
		
		
	}
	//***** functions par rapport à des traitement des artistes
	private function obtenirTabArtistes()
	{	
		$oArtistesListe = new Artistes();
		$listeArtistes = $oArtistesListe->obtenirTous();//contienne le resultat du tableau avec les artistes
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
			for($i=0;$i<$nomArtistes;$i++)
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
		$listeArrondissements = $oArrondissementsListe->obtenirTous();//contienne le resultat du tableau avec les artistes
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
		$listeCategories = $oCategoriesListe->obtenirTous();//contienne le resultat du tableau avec les categories
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
		$listeOeuvres = $oOeuvresListe->obtenirTous();//contienne le resultat du tableau avec les categories
		$nomOeuvres = count($listeOeuvres);
		$tableau = array();
		for($i=0;$i<$nomOeuvres;$i++)
		{
			$Oeuvre = $listeOeuvres[$i]["noInterne"];
			array_push($tableau,$Oeuvre);
		}
		return $tableau;
	}
	
	
	private function verifierOeuvre($noInterne,$mesOeuvres)
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
			return false;
		}
	}
	
	private function inclureOeuvre($oeuvre,$artistes,$arrondissements,$categories)
	{
		$oOeuvres = new Oeuvres();
		$data = $oOeuvres->traiterOeuvre($oeuvre,$artistes,$arrondissements,$categories);
	}

}
?>















