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
		if(isset($_SESSION['authentifie']))
		{
			switch ($_GET['requete']) 
			{	
				case 'deconnectionAdmin':
					session_unset();
					$this->accueil();  	
					break;
					
					
				case 'importation':
					$_SESSION['ongletActif'] = 'importation';
					$this->afficherEnteteAdmin();
					$this->afficheImportation();                                                      
					break;
					
					
				case 'importationok':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
					$novData = $this->traiterDonnees($publicJson,"importationBD");//traiter donnes avec l'action importation
					$this-> enregistrerImportation($novData);
					$this->afficheImportationOK();                                                   
					break;
				
					
				case 'verification':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
					$novData = $this->traiterDonnees($publicJson,"verification");//traiter donnes avec l'action verification
					$this->afficheVerification($novData);
					break;
				
					
				case 'gestion':
					$_SESSION['ongletActif'] = 'gestion';
					$this->afficherEnteteAdmin();
					$this->afficherPageGestion();
					break;
					
					
				case 'soumission':                                                          // page formulaire d'ajout administrateur
					$_SESSION['ongletActif'] = 'ajoutOeuvre';
					$this->afficherEnteteAdmin();
					$this->afficherFormSoumissionAdmin();             
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
						{                                                                   // si non réussi
							$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
							break;
						}
					}
					
					/*-- INSERT TABLE ArtistesOeuvres ------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();
					$valide = $modeleSoumisionAdmin->insererSoumissionArtisteOeuvres($existe);
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
					
					$vue = "afficheSoumission";
					$this->afficheVue($vue, $tableauContenu);    
					break;
				
				
				case 'ajoutCategorie':
					$tableauContenu = json_decode (file_get_contents('php://input'), true); // decode la string JSON
					extract($tableauContenu);                                               // convertit le JSON en variables
					
					/*-- INSERT TABLE Categories -----------------------------------------------*/
					$modeleCategorieAdmin = new Categories();
					$valide = $modeleCategorieAdmin->insererCategorie($tableauContenu);                                       
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande d'ajout d'une catégorie.");
						break;
					}
					break;
				
					
				case 'supprimerCategorie':
					$tableauContenu = json_decode (file_get_contents('php://input'), true); // decode la string JSON
					extract($tableauContenu);                                               // convertit le JSON en variables
					$categorieASupprimer = $tableauContenu['categorie'];
					
					/*-- DELETE TABLE Categories ----------------------------------------------*/
					$modeleCategorieAdmin = new Categories();
					$valide = $modeleCategorieAdmin->supprimer($categorieASupprimer);                                       
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
					break;
				
					
				case 'soumissionsDesUsagers':                                               // page affichage des soumissions des usagers
					$_SESSION['ongletActif'] = 'soumission';
					$this->afficherEnteteAdmin();
					$this->afficherSoumissionsDesUsagers();             
					break;
					
					
				case 'supprimeSoumissionUsager':
					$soumissionASupprimer = ($_GET['idSoumissionUsager']);
					
					/*-- DELETE TABLE Soumissions ---------------------------------------------*/
					$modeleCategorieAdmin = new modeleSoumission();
					$valide = $modeleCategorieAdmin->supprimer($soumissionASupprimer, "idSoumission", "Soumissions");
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
					$_SESSION['ongletActif'] = 'soumission';
					$this->afficherEnteteAdmin();
					$this->afficherSoumissionsDesUsagers();
					break;
					
					
				case 'supprimeOeuvre':
					$oeuvreASupprimer = ($_GET['idOeuvre']);
					
					/*-- DELETE TABLE Oeuvre --------------------------------------------------*/
					$modeleCategorieAdmin = new modeleSoumission();
					$valide = $modeleCategorieAdmin->supprimer($oeuvreASupprimer, "idOeuvre", "Oeuvres");
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
					$_SESSION['ongletActif'] = 'listeOeuvresAdmin';
					$this->afficherEnteteAdmin();
					$this->afficherListeDesOeuvres();
					break;
					
				
				case 'listeOeuvresAdmin': 
					$_SESSION['ongletActif'] = 'listeOeuvresAdmin';
					$this->afficherEnteteAdmin();
					$this->afficheVue("barRechercheAdmin");
					$this->afficherListeDesOeuvres();
					break;
					
					
				case 'carroussel':
					$_SESSION['ongletActif'] = 'carroussel';
					$this->afficherEnteteAdmin();
                    $this->afficheVue("carouselAdmin");
					break;
					
				case 'rechercheOeuvreAdmin': 
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->afficherEnteteAdmin();
					$modeleListe = new RechercheAdmin();
					array_push($data,$modeleListe->rechercheOeuvresParPhotos($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheOeuvresParAuteur($_GET['valRecherche']));
					$this->afficheVue("barRechercheAdmin");
					$this->afficheVue("listeOeuvresAdmin",$data);
				
				}
				break;
            
				default:
					$this->accueil();
					break;   
			}
		}
		else
		{
			switch ($_GET['requete']) 
			{
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
					
					
				default:
					$this->accueil();
					break;   
			}
		}
	}
    
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////     MÉTHODES DU CONTROLEUR     ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
		
    
    protected function afficheVue($nomVue, $data = null)                                // affiche la vue 
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
			$this->afficherPageGestion();
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
    
    private function afficherPageGestion()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories        
        $vue = "gestionCategorie";
		$this->afficheVue($vue, $data);
    }
	
	private function afficherFormSoumissionAdmin()
	{
		$vue = "soumissionOeuvre1";                                                     // input : titre et titre variante
        $dataSoumissions = null;
        if(isset($_GET["idSoumissionUsager"]))
        {
            $idSoumissionUsager = ($_GET["idSoumissionUsager"]);
            $modeleSoumisionAdmin = new modeleSoumission();                             // appelle modeleSoumission
            $dataSoumissions = $modeleSoumisionAdmin->obtenir($idSoumissionUsager, "idSoumission", "Soumissions");     // récupère la table Soumissions
            $choixArrondissement = $dataSoumissions['idArrondissementSoumission'];
        }
        $this->afficheVue($vue, $dataSoumissions);
        
        $vue = "soumissionArtiste"; 
        $this->afficheVue($vue, $dataSoumissions);
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories
        $vue = "soumissionCategorie";                                                   // select : catégories
        $this->afficheVue($vue, $data);
        
        $vue = "soumissionOeuvre2";                                                     // input : fin production, accession, matériaux, 
		$this->afficheVue($vue);                                                        //         technique, dimension
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");   // récupère la table Arrondissements                                   
        if(isset($_GET["idSoumissionUsager"]))
        {
            $data['choix'] = $choixArrondissement;
        }
        $vue = "soumissionArrondissement"; 
        $this->afficheVue($vue, $data);                                                 // select : arrondissements

        $vue = "soumissionOeuvre3";                                                     // inputs : parc, batiment, adresse, latitude, 
		$this->afficheVue($vue, $dataSoumissions);                                      //          longitude
        
        $vue = "boutonSoumission";                                                      // bouton soumission
        $this->afficheVue($vue);               
	}
	
    private function afficherSoumissionsDesUsagers()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Soumissions","idSoumission");       // récupère la table Soumissions
        $vue = "soumissionsDesUsagers";
        $this->afficheVue($vue, $data);
    }
    
     private function afficherListeDesOeuvres()
     {
         // récupération du code de Nicolas d'affichage de la liste des oeuvres du côté usager
         $data = [];                                                             // initialisation de $data
         $modeleListe = new ModeleListe();
         array_push($data,$modeleListe->getOeuvresParPhotos());
         array_push($data,$modeleListe->getOeuvresParAuteur());
         $this->afficheVue("listeOeuvresAdmin",$data); 
     }
    
	private function afficheImportation()
	{
		$vue = "afficheImportation";
		$this->afficheVue($vue);
	}	

	private function afficheImportationOK()
	{
		$vue = "afficheImportationOK";
		$this->afficheVue($vue);
	}
	
	private function afficheVerification($data)
	{
		$vue = "afficheVerification";
		$this->afficheVue($vue,$data);
	}
	
	private function obtenirJSON()
	{
		$oRemote = new Donnesremote();
		return $oRemote->getpublicJSON();
	}
	
	private function traiterDonnees($jsonSite,$action)
	{
		
		$nomOeuvres = count($jsonSite);//numero des oeuvres dans le Json
		
		
		/////////////////////////////////////////////////////
		///////////////traitement des artistes///////////////
		/////////////////////////////////////////////////////
		
		$tabArtistes = $this->obtenirTabArtistes(); // Obtenir la derniere liste des artistes de la BD
		$novArtistes = 0;
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les oeuvres
		{
			foreach($jsonSite[$i]->Artistes as $artiste)
			{
				$ilExiste = $this->verifierArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif,$tabArtistes);//je dois faire ça me contre mon array, pa contre la BD
				if(!$ilExiste)
				{
					switch ($action)
					{
						
						case "importationBD":
						
							$artActuelle = $artiste->Nom ." ".$artiste->Prenom ." ".$artiste->NomCollectif;
							array_push($tabArtistes,$artActuelle);
							$this->inclureArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
							$novArtistes++;
							break;
						
						case "verification":
							$novArtistes++;
							break;
					}
				}
			}
			
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des arrondissements////////
		/////////////////////////////////////////////////////
		
		$tabArrondissements = $this->obtenirTabArrondissements();//Obtenir la derniere liste des arrondissements de la BD
		$novArrondissements = 0;
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les arrondissement
		{
			$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement,$tabArrondissements);
			if(!$ilExiste)
			{
				switch($action)
				{
					case "importationBD":
						
						$novArrondissements++;
						array_push($tabArrondissements,$jsonSite[$i]->Arrondissement);
						$this->inclureArrondissement($jsonSite[$i]->Arrondissement);
						break;
					
					case "verification":
						
						$novArrondissement++;
						break;
				}
			}
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des categories/////////////
		/////////////////////////////////////////////////////
		
		$tabCategories = $this->obtenirTabCategories();//Obtenir la derniere liste des categories de la BD
		$novCategories = 0;
		
		for($i=0;$i<$nomOeuvres;$i++)// for pour parcourir tout les categories
		{
			$ilExiste = $this->verifierCategorie($jsonSite[$i]->SousCategorieObjet,$tabCategories);
			if(!$ilExiste)
			{
				switch($action)
				{
					case "importationBD":
					
						$novCategories++;
						array_push($tabCategories,$jsonSite[$i]->SousCategorieObjet);
						$this->inclureCategorie($jsonSite[$i]->SousCategorieObjet);
						break;
					
					case "verification":
						
						$novCategories++;
						break;
				}
				
			}
		}
		
		/////////////////////////////////////////////////////
		///////////////traitement des oeuvres////////////////
		/////////////////////////////////////////////////////
		
		//Obtenir la derniere liste des oeuvres de la BD
		$tabOeuvres = $this->obtenirTabOeuvres();
		$novOeuvres = 0;
		
		//Obtenir la derniere liste des arrondissements dans la BD
		$oArrondissementsListe = new Arrondissements();
		$listeArrondissements = $oArrondissementsListe->obtenirTous("Arrondissements","idArrondissement");//contienne le resultat du tableau avec les arrondissement
		
		//Obtenir la derniere liste des categories dans la BD
		$oCategoriesListe = new Categories();
		$listeCategories = $oCategoriesListe->obtenirTous("Categories","idCategorie");//contienne le resultat du tableau avec les categories
		
		//L'insertion des oeuvres (il faut le faire avec un while parce que avec des for il avait problèmes de deconnexion)
		
		$curOeuvre = 0;//compteur pour savoir l'ouvre du JSON à traiter
		while($curOeuvre<$nomOeuvres)
		{
			$ilExiste = $this->verifierOeuvre($jsonSite[$curOeuvre]->NoInterne,$tabOeuvres);//verification par NoInterne d'oeuvre
			if(!$ilExiste)
			{
				
				switch($action)
				{
					case "importationBD":
					
						$novOeuvres++;
						array_push($tabOeuvres,$jsonSite[$curOeuvre]->NoInterne);
						$this->inclureOeuvre($jsonSite[$curOeuvre],$listeArrondissements,$listeCategories);
						break;
					
					case "verification":
						
						$novOeuvres++;
						break;
				}
			}
			$curOeuvre++;
		}
		
		if($action == "importationBD"){
			
			/////////////////////////////////////////////////////
			///////////////traitement des Oeuvres-Artistes///////
			/////////////////////////////////////////////////////
			
			/******** Obtenir la derniere liste des Oeuvres dans la BD*************/
			$oOeuvresListe = new Oeuvres();
			$listeOeuvres = $oOeuvresListe->obtenirTous("Oeuvres","idOeuvre");//contienne le resultat du tableau avec les categories
			//$nomOeuvres = count($listeOeuvres);
			/******** Obtenir la derniere liste des artistes dans la BD*************/
			$oArtistesListe = new Artistes();
			$listeArtistes = $oArtistesListe->obtenirTous("Artistes","idArtiste");
			$nomOArtistes = count($listeArtistes);
			
			$curOeuvre = 0;//compteur pour savoir l'ouvre du JSON à traiter
			while($curOeuvre<$nomOeuvres)
			{
				$this->insererArtisteOeuvre($jsonSite[$curOeuvre],$listeOeuvres,$nomOeuvres,$listeArtistes,$nomOArtistes);
				$curOeuvre++;
			}
			
		}
		
		$dataUpdate = 
			[
				'Artistes' => $novArtistes,
				'Arrondissements'  => $novArrondissements, 
				'Categories'  => $novCategories, 
				'Oeuvres'  => $novOeuvres
			];
		return $dataUpdate;
		
	}
	
	//***** functions par rapport à des traitement des artistes
	private function obtenirTabArtistes()
	{	
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
    
    private function enregistrerImportation($donnes)
	{
		$oMisaJour = new MiseaJour();
		$oMisaJour->enregistrement($donnes);
	}
}
?>















