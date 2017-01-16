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
		if(isset($_SESSION['authentifie']))
		{
			switch ($_GET['requete']) 
			{	
				
                /////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////    CONNECTION / DÉCONNECTION    ///////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
                
                
                case 'deconnectionAdmin':
					session_unset();
					$this->accueil();  	
					break;	

                
                /////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////    OEUVRES    ////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
                
                
                case 'oeuvresAdmin':                                                         // page principale de l'onglet OEUVRES
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
					$this->afficheVue("barRechercheAdmin");
					$this->afficheVue("lienHautDePage");
                    $this->afficherListeDesOeuvres();
                    $this->afficheVue("footer");

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
                
                
                /*-- MODIFICATION D'UNE OEUVRE ------------------------------------------------*/ 
                
                case 'modifieOeuvre':
                    $this->afficherEnteteAdmin();
                    $this->afficherFormModificationAdmin();
                    break;
                
                
                case 'updateModification':                                                  // à l'envoi du formulaire
					/*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
					//$tableauContenu = json_decode (file_get_contents('php://input'), true); // decode la string JSON
					$tableauContenu = json_decode ($_POST['data'], true);                   // decode la string JSON dans formData
                    extract($tableauContenu);                                               // convertit le JSON en variables
                
                    /*-- UPDATE TABLE Oeuvres -------------------------------------------------*/
                    $modeleSoumisionAdmin = new modeleSoumission();
                    $valide = $modeleSoumisionAdmin->modifierOeuvre($tableauContenu);                                       
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
                    
                    /*-- UPDATE TABLE Artistes ------------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();
					$artisteDeLOeuvre = $modeleSoumisionAdmin->obtenir($idOeuvre, "idOeuvre", "ArtistesOeuvres"); // récupère l'id de l'artiste à modifier
                    $artisteAModifier = $artisteDeLOeuvre['idArtiste'];
                    $valide = $modeleSoumisionAdmin->modifierArtiste($tableauContenu, $artisteAModifier);                                       
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
                
                    /*-- INSERT TABLE Photos ---------------------------------------------------*/
                    //  sources :   https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire
                    //              http://php.net/manual/fr/features.file-upload.post-method.php
                    
                    if(isset($_FILES['photos'])){                                                 // si il y a une photo
                        $uploadDirection = './images/';

                        $modeleSoumisionAdmin = new modeleSoumission();
                        $idPhotos = $modeleSoumisionAdmin->obtenirDernier("idPhoto", "Photos");
                        $idPhotos++;
                    
                        $nomPhoto = "photo#" . $idPhotos . ".jpg";
                        $uploadPhoto = $uploadDirection . $nomPhoto;
                        
                        move_uploaded_file($_FILES['photos']['tmp_name'], $uploadPhoto);
                        
                        /*-- INSERT urlPhoto TABLE Photos --------------------------------------*/
                        $modeleSoumisionAdmin = new modeleSoumission();
                        $valide = $modeleSoumisionAdmin->insererUrlPhoto($nomPhoto, $idOeuvre);                                       
                        if(!$valide)
				        {                                                                         // si non réussi
                            $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                            break;
                        }
                    }
                
                    $tableauContenu['photo'] = $nomPhoto;
                    
                    
                    $this->afficheVue("afficheSoumission", $tableauContenu); 
                
                    break;
                
                
                /*-- SUPPRESSION D'UNE OEUVRE -------------------------------------------------*/
                
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
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
                    $this->afficheVue("lienHautDePage");
					$this->afficherListeDesOeuvres();
					break;
                

                /*-- AJOUT D'UNE OEUVRE ------------------------------------------------------*/  
                
                case 'soumission':                                                          // page formulaire d'ajout administrateur
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
					$this->afficherFormSoumissionAdmin();             
					break;
				
				
				case "insereSoumission":                                                    // à l'envoi du formulaire
					/*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
					//$tableauContenu = json_decode (file_get_contents('php://input'), true); // decode la string JSON
                    $tableauContenu = json_decode ($_POST['data'], true);                   // decode la string JSON dans formData
                    extract($tableauContenu);                                               // convertit le JSON en variables
                
					/*-- INSERT TABLE Oeuvres -------------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();
					$valide = $modeleSoumisionAdmin->insererSoumissionOeuvre($tableauContenu);                                       
					if(!$valide)
					{                                                                       // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
				
					/*-- INSERT TABLE Photos ---------------------------------------------------*/
                    $modeleSoumisionAdmin = new modeleSoumission();
                    $photo = $tableauContenu["urlPhoto"];
                    if($photo != "" || $photo != null)
                    {
					   $valide = $modeleSoumisionAdmin->insererUrlPhoto($photo);
					   if(!$valide)
					   {                                                                       // si non réussi
					   	$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
					   	break;
					   }
                    }
                
                    //  sources :   https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire
                    //              http://php.net/manual/fr/features.file-upload.post-method.php
                    
                    if(isset($_FILES['photos'])){                                                 // si il y a une photo
                        $uploadDirection = './images/';
 
                        $modeleSoumisionAdmin = new modeleSoumission();
                        $idPhotos = $modeleSoumisionAdmin->obtenirDernier("idPhoto", "Photos");
                        $idPhotos++;
                    
                        $nomPhoto = "photo#" . $idPhotos . ".jpg";
                        $uploadPhoto = $uploadDirection . $nomPhoto;
                        //$nomPhoto = basename($_FILES['photos']['name']);
                        
                        move_uploaded_file($_FILES['photos']['tmp_name'], $uploadPhoto);
                        
                        /*-- INSERT urlPhoto TABLE Photos --------------------------------------*/
                        $modeleSoumisionAdmin = new modeleSoumission();
                        $valide = $modeleSoumisionAdmin->insererUrlPhoto($nomPhoto);                                       
                        if(!$valide)
				        {                                                                         // si non réussi
                            $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                            break;
                        }
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
					
					$this->afficheVue("afficheSoumission", $tableauContenu);    
					break;
                
                
				/*-- OEUVRES SOUMISES PAR LES USAGERS -----------------------------------------*/
                
                case 'soumissionsDesUsagers':                                               // page affichage des soumissions des usagers
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
                    $this->afficheVue("lienHautDePage");
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
                    $this->afficheVue("lienHautDePage");
					$this->afficherSoumissionsDesUsagers();
					break;
                
                
                /*-- CATÉGORIES D'OEUVRES ------------------------------------------------------*/
                
                case 'gestionCategorie':
                    $_SESSION['ongletActif'] = 'oeuvresAdmin';
                    $this->afficherEnteteAdmin();
                    $this->afficherPageGestionCategorie();
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

                
                /////////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////////    ARTISTES    ///////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
                
                
                
                
                
                
                /////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////    AFFICHAGE    ///////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
				
                
                case 'affichage':
					$_SESSION['ongletActif'] = 'affichage';
					$this->afficherEnteteAdmin();
					$this->afficherPageAffichage();
					break;
                
                
                /////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////    IMPORTATION    //////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
                   
                    
                case 'importation':
					$_SESSION['ongletActif'] = 'importation';
					$this->afficherEnteteAdmin();
					$misJourData = $this->obtenirMiseAJour();
					$this->afficheImportation($misJourData);
					break;
					
					
				case 'importationok':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
					$novData = $this->importation($publicJson,"importationBD");//traiter donnes avec l'action importation
					$this-> enregistrerImportation($novData);
					$this->afficheImportationOK($novData);                                                   
					break;   
                    

				case 'verification':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
					$novData = $this->importation($publicJson,"verification");//traiter donnes avec l'action importation
					$this->afficheVerification($novData);
					break;
				
					
                /////////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////    ADMIN    /////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
					
                    
				case 'permissionAdmin': 
					$this->permissionAdmin();
					break;
					
				
				case 'innitialisationPasse':
					$modelAdmin = new Admin();
					$data = $modelAdmin->innitialisationPasse($_GET['nomUsagerAdmin']);
					$this->permissionAdmin();
					break;
				
					
				case 'supprimeAdmin':
					$modelAdmin = new Admin();
					$data = $modelAdmin->supprimer($_GET['nomUsagerAdmin']);
					$this->permissionAdmin();
					break;
					
					
				case 'modifieNiveauAdmin':
					$modelAdmin = new Admin();
					$data = $modelAdmin->modifieNiveauAdmin($_GET['nomUsagerAdmin'], $_GET['niveauAdmin']);
					$this->permissionAdmin();
					break;
					
					
				case 'ajoutAdministrateur':
					$donnee = json_decode (file_get_contents('php://input'), true);
					$modelAdmin = new Admin();
					$data = $modelAdmin->ajoutAdministrateur($donnee);
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
	
    
    /*-- GLOBAL ----------------------------------------------------------------------------*/
    
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
     
    public function phpAlert($message)
    {
		// source : http://stackoverflow.com/questions/13837375/how-to-show-an-alert-box-in-php
        echo '<script type="text/javascript">window.alert("' . $message . '")</script>';
    }
	 
    private function accueil()
    {
		if(!isset($_SESSION['authentifie']))
		{
			$this->afficheVue("head");
			$this->afficheVue("enteteAdmin");
			$this->afficheVue('FormAutentificationAdmin');
		}
		else
		{
			$this->afficherEnteteAdmin();
			$this->afficheVue("barRechercheAdmin");
			$this->afficheVue("lienHautDePage");
            $this->afficherListeDesOeuvres();
            $this->afficheVue("footer");
		}
    }
 
	protected function afficherEnteteAdmin()
	{
        $this->afficheVue("head");
		$this->afficheVue("enteteAdmin");
        $this->afficheVue("boutonDeconnectionAdmin");
        $this->afficheVue("menuAdmin");
        
	}
    
    
    /*-- OEUVRES --------------------------------------------------------------------------*/
    
    private function afficherListeDesOeuvres()
    {
        // récupération du code de Nicolas d'affichage de la liste des oeuvres du côté usager
        $data = [];                                                             // initialisation de $data
        $modeleListe = new ModeleListe();
        array_push($data,$modeleListe->getOeuvresParPhotos());
        array_push($data,$modeleListe->getOeuvresParAuteur());
        $this->afficheVue("listeOeuvresAdmin",$data); 
    }
    
    private function afficherFormSoumissionAdmin()
	{                                                 
        $dataSoumissions = null;
        if(isset($_GET["idSoumissionUsager"]))
        {
            $idSoumissionUsager = ($_GET["idSoumissionUsager"]);
            $modeleSoumisionAdmin = new modeleSoumission();                             // appelle modeleSoumission
            $dataSoumissions = $modeleSoumisionAdmin->obtenir($idSoumissionUsager, "idSoumission", "Soumissions");     // récupère la table Soumissions
            $choixArrondissement = $dataSoumissions['idArrondissementSoumission'];
        }
        
        $this->afficheVue("soumissionOeuvre1", $dataSoumissions);                       // input : titre et titre variante
        
        $this->afficheVue("soumissionArtiste", $dataSoumissions);                       // input : prenom, nom, collectif
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories                                                 
        $this->afficheVue("soumissionCategorie", $data);                                // select : catégories
                                                             
		$this->afficheVue("soumissionOeuvre2");                                         // input : fin production, accession, matériaux,
                                                                                        //         technique, dimension
        
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");   // récupère la table Arrondissements                                   
        if(isset($_GET["idSoumissionUsager"]))
        {
            $data['choix'] = $choixArrondissement;
        }
        $this->afficheVue("soumissionArrondissement", $data);                           // select : arrondissements

		$this->afficheVue("soumissionOeuvre3", $dataSoumissions);                       // inputs : parc, batiment, adresse, latitude,
                                                                                        //          longitude
        
        $this->afficheVue("boutonSoumission");                                          // bouton soumission
        
        $this->afficheVue("footer");
	}

    private function afficherFormModificationAdmin()
	{                                                 
        $dataOeuvreAModifie = null;
        
        $idOeuvre = ($_GET["idOeuvre"]);
        $modeleModificationAdmin = new ModeleListe();                                   // appelle modeleSoumission
        $dataOeuvreAModifie = $modeleModificationAdmin->getOeuvresParID($idOeuvre);     // récupère toutes les infos d'une oeuvre spécifiée par son ID
        foreach($dataOeuvreAModifie as $oeuvre){
            $choixCategorie = $oeuvre['idCategorie'];
            $choixArrondissement = $oeuvre['idArrondissement'];
        }
        
        $this->afficheVue("soumissionOeuvre1", $dataOeuvreAModifie);                    // input : titre et titre variante
        
        $this->afficheVue("soumissionArtiste", $dataOeuvreAModifie);                    // input : prenom, nom, collectif


        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories                                                 
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
            $data['choix'] = $choixCategorie;
        }
        $this->afficheVue("soumissionCategorie", $data);                                // select : catégories
        
		$this->afficheVue("soumissionOeuvre2", $dataOeuvreAModifie);                    // input : fin production, accession, matériaux,
                                                                                        //         technique, dimension
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");   // récupère la table Arrondissements                                   
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
            $data['choix'] = $choixArrondissement;
        }
        $this->afficheVue("soumissionArrondissement", $data);                           // select : arrondissements

		$this->afficheVue("soumissionOeuvre3", $dataOeuvreAModifie);                    // inputs : parc, batiment, adresse, latitude,
                                                                                        //          longitude
        $this->afficheVue("boutonModification");                                        // bouton modification

        $this->afficheVue("footer");
	}
    
    private function afficherSoumissionsDesUsagers()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Soumissions","idSoumission");       // récupère la table Soumissions
        $this->afficheVue("soumissionsDesUsagers", $data);
        $this->afficheVue("footer"); 
    }
    
    private function afficherPageGestionCategorie()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                 // appelle modeleSoumission
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");       // récupère la table Categories        
		$this->afficheVue("gestionCategorie", $data);
        $this->afficheVue("footer");   
    }
	
	
    /*-- AFFICHAGE -----------------------------------------------------------------------*/

    private function afficherPageAffichage()
    {
        $this->afficheVue("gestionCarrousel");
        $this->afficheVue("footer");   
    }
    
    
    /*-- ADMIN ---------------------------------------------------------------------------*/
    
    private function permissionAdmin()
	{
		$_SESSION['ongletActif'] = 'permissionAdmin';
		$this->afficherEnteteAdmin();
		$modelAdmin = new Admin();
		$data = $modelAdmin->obtenirTous();
        $this->afficheVue("permissionAdmin",$data);
        $this->afficheVue("footer");
	}
    
    
    /*-- IMPORTATION ----------------------------------------------------------------------*/
    
	private function afficheImportation($data)
	{
		$this->afficheVue("afficheImportation");
		$this->afficheVue("historiqueBD",$data);
        $this->afficheVue("footer"); 
	}	

	private function afficheImportationOK($data)
	{
		$this->afficheVue("afficheImportationOK",$data);
		$this->afficheVue("footer");
	}
	
	private function afficheVerification($data)
	{
		$this->afficheVue("afficheVerification",$data);
        $this->afficheVue("footer"); 
	}
	
	private function obtenirJSON()
	{
		$oRemote = new Donnesremote();
		return $oRemote->getpublicJSON();
	}
	
	private function obtenirMiseAJour()
	{
		$oMisaJour = new MiseaJour();
		return $oMisaJour->obtenirXenregistrement(10,"MiseAJours","idMiseAJour");
		
	}
	
	private function importation($jSon,$action)
	{
		$oImportation = new Importation();
		return $oImportation->traiterDonnees($jSon,$action);
	}
	    
    private function enregistrerImportation($donnes)
	{
		$oMisaJour = new MiseaJour();
		$oMisaJour->enregistrement($donnes);
	}
}
?>


