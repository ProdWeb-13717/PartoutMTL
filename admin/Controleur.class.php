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
				$_SESSION['ongletActif'] = 'importation';
				$this->afficherEnteteAdmin();
				$this->importation();                                                      
				break;
				
				
			case 'importationok':
				$this->afficherEnteteAdmin();
				$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
				$this->traiterDonnees($publicJson);//parce qu'on envoi des donnees il n'est pas neccessaire de retourner quelque chose
				$this->importationok();                                                    
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
                
                print_r($tableauContenu);
                print_r($tableauContenu['categorie']);
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
            
            default:
				$this->accueil();
				break;   
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
		$this->afficheVue($vue);
        
        $vue = "soumissionArtiste";                                                     // input : prénom, nom, collectif artiste
		$this->afficheVue($vue);
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories
        $vue = "soumissionCategorie";                                                   // select : catégories
        $this->afficheVue($vue, $data);
        
        $vue = "soumissionOeuvre2";                                                     // input : fin production, accession, matériaux, 
		$this->afficheVue($vue);                                                        //         technique, dimension
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");   // récupère la table Arrondissements
        $vue = "soumissionArrondissement";                                              // select : arrondissements
        $this->afficheVue($vue, $data);
        
        $vue = "soumissionOeuvre3";                                                     // inputs : parc, batiment, adresse, latitude, 
		$this->afficheVue($vue);                                                        //          longitude
        
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
    
	private function importation()
	{
		$oVue = new Vueimportation();
		$oVue->afficheformImportation();
	}	

	private function importationok()
	{
		$oVue = new Vueimportation();
		$oVue->afficheImportationok();
	}
	
	private function obtenirJSON()
	{
		$oRemote = new Donnesremote();
		return $oRemote->getpublicJSON();
	}
	
	private function traiterDonnees($jsonSite)
	{
		$nomOeuvres = count($jsonSite);
		for($i=0;$i<=14;$i++)// for pour parcourir tout les oeuvres
		{
			//***traitement des artistes***
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

				$ilExiste = $this->verifierArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
				if(!$ilExiste)
				{
					$this->inclureArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
				}
			}
			//fin traitement des artistes
			
			//*** traitement des arrondissements
			$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement);
			if(!$ilExiste)
			{
				
				$this->inclureArrondissement($jsonSite[$i]->Arrondissement);
			}
			//fin traitement des arrondissements
			
			
			//*** traitement des categories
			$ilExiste = $this->verifierCategorie($jsonSite[$i]->SousCategorieObjet);
			if(!$ilExiste)
			{
				$this->inclureCategorie($jsonSite[$i]->SousCategorieObjet);
			}
			//fin traitement des categories
			
			//*** traitement des oeuvres
			$ilExiste = $this->verifierOeuvre($jsonSite[$i]->NoInterne);
			if(!$ilExiste)
			{
				$this->inclureOeuvre($jsonSite[$i]);
			}
			//fin traitement des oeuvres
		}
	}
	//***** functions par rapport à des traitement des artistes
	
	private function verifierArtiste($nom,$prenom,$collectif)
	{
		$oArtistes = new Artistes();
		$data = $oArtistes->obtenirArtiste($nom,$prenom,$collectif);
		return $data;
	}
	
	private function inclureArtiste($nom,$prenom,$collectif)
	{
		$oArtistes = new Artistes();
		$data = $oArtistes->insererArtiste($nom,$prenom,$collectif);
	}
	
	
	//***** functions par rapport à des traitement des arrondissements
	private function verifierArrondissement($arrondissement)
	{
		$oArrondissements = new Arrondissements();
		$data = $oArrondissements->obtenirArrondissement($arrondissement);
		return $data;
	}
	
	private function inclureArrondissement($arrondissement)
	{
		$oArrondissements = new Arrondissements();
		$data = $oArrondissements->insererArrondissement($arrondissement);
	}
	
	//***** functions par rapport à des traitement des categories
	private function verifierCategorie($categorie)
	{
		$oCategorie = new Categories();
		$data = $oCategorie->obtenirCategorie($categorie);
		return $data;
	}
	
	private function inclureCategorie($categorie)
	{
		$oCategorie = new Categories();
		$data = $oCategorie->insererCategorie($categorie);
	}
	
	//***** functions par rapport à des traitement des oeuvres
	private function verifierOeuvre($noInterne)
	{
		$oOeuvre = new Oeuvres();
		$data = $oOeuvre->obtenirOeuvre($noInterne);
		return $data;
	}
	
	private function inclureOeuvre($oeuvre)
	{
		$oOeuvres = new Oeuvres();
		$data = $oOeuvres->traiterOeuvre($oeuvre);
	}

}
?>















