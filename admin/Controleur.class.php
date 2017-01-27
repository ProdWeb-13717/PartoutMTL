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
                
                
                case 'updateModification':                                                                              // à l'envoi du formulaire
					/*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
					//$tableauContenu = json_decode (file_get_contents('php://input'), true);
					$tableauContenu = json_decode ($_POST['data'], true);                                               // decode la string JSON dans formData
                    extract($tableauContenu);                                                                           // convertit le JSON en variables
                
                    /*-- UPDATE TABLE Oeuvres -------------------------------------------------*/
                    $modeleSoumisionAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
                    $valide = $modeleSoumisionAdmin->modifierOeuvre($tableauContenu);                                   // modifie les entrées de la table Oeuvres avec les données en paramètre                                       
					if(!$valide)
					{                                                                                                   // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
                    
                    /*-- UPDATE TABLE Artistes ------------------------------------------------*/
                    $modeleSoumisionAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$existe = $modeleSoumisionAdmin->verifierArtiste($tableauContenu);                                  // vérifie si le nom de l'artiste une fois modifié existe dans la base de données, s'il existe, retourne son id
					if($existe)                                                                                         // s'il existe
                    {
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
				        $artisteDeLOeuvre = $modeleSoumisionAdmin->obtenir($idOeuvre, "idOeuvre", "ArtistesOeuvres");   // récupère l'id de l'artiste à modifier associé à l'id de l'oeuvre
                        $artisteAModifier = $artisteDeLOeuvre['idArtiste'];
                        
                        if($artisteAModifier != $existe)                                                                // si l'id de l'artiste à modifier n'est pas le même que l'id de l'artiste ayant le même nom une fois modifié
                        {
                            $modeleSoumisionAdmin = new modeleSoumission();                                             // appelle modèle "modeleSoumision"
				            $artisteDeLOeuvre = $modeleSoumisionAdmin->modifierOeuvreArtiste($idOeuvre, $existe);       // associe l'id de l'oeuvre à l'id de l'artiste présent dans la table ArtistesOeuvres
                            if(!$valide)
				            {                                                                                           // si non réussi
                                $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                                break;
				            }    
                        } 
                    }
                    if($existe== NULL)
                    {
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
				        $artisteDeLOeuvre = $modeleSoumisionAdmin->obtenir($idOeuvre, "idOeuvre", "ArtistesOeuvres");   // récupère l'id de l'artiste à modifier associé à l'id de l'oeuvre
                        $artisteAModifier = $artisteDeLOeuvre['idArtiste'];
                        $valide = $modeleSoumisionAdmin->modifierArtiste($tableauContenu, $artisteAModifier);           // modifie les entrées de la table Artistes avec les données en paramètre
				        if(!$valide)
				        {                                                                                               // si non réussi
                            $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                            break;
				        }
                    }
                    
                    /*-- DELETE PHOTOS TABLE Photos -------------------------------------------*/
                    if(isset($_POST['photoASupprimer']))
                    {   
                        $tableauDePhotos = json_decode ($_POST['photoASupprimer'], true);                               // decode la string JSON dans photoASupprimer
                        
                        foreach ($tableauDePhotos as $photoASupprimer)                                                  // pour chaque photos à supprimer
                        {
                            $modeleCategorieAdmin = new modeleSoumission();                                             // appelle modèle "modeleSoumision"
                            $valide = $modeleCategorieAdmin->supprimer($photoASupprimer, "idPhoto", "Photos");          // supprime la photo
                            if(!$valide)
                            {                                                                                           // si non réussi
                                $this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
                                break;
                            }
                        }
                    }
                
                    /*-- INSERT PHOTOS TABLE Photos -------------------------------------------*/
                    //  sources :   https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire
                    //              http://php.net/manual/fr/features.file-upload.post-method.php
                    
                    if(isset($_FILES['photos']))                                                                        // si il y a une photo
                    {
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $idPhotos = $modeleSoumisionAdmin->obtenirDernier("idPhoto", "Photos");                         // obtient l'id de la dernière photo inscrite dans la tabe Photos
                        $idPhotos++;                                                                                    // additionne 1 à ce chiffre
                    
                        $uploadDirection = '../images/';                                                                // emplacement de la photo
                        $nomPhoto = "photo_" . $idPhotos . ".jpg";                                                      // nom de la photo
                        $uploadPhoto = $uploadDirection . $nomPhoto;                                                    // nom complet de la photo
                        
                        move_uploaded_file($_FILES['photos']['tmp_name'], $uploadPhoto);                                // charge la photo à son emplacement avec son nouveau nom
                        
                        $tableauContenu["urlPhoto"] = $nomPhoto;
                        
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $valide = $modeleSoumisionAdmin->insererUrlPhoto($nomPhoto, $idOeuvre);                         // associe l'oeuvre et la photo dans la table Photos                                        
                        if(!$valide)
				        {                                                                                               // si non réussi
                            $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                            break;
                        }
                        
                        $tableauContenu['photo'] = $nomPhoto;                                                           // ajoute le nom de la photo à la variable $tableauContenu
                    }
                    
                    $this->afficheVue("afficheSoumission", $tableauContenu);                                            // affiche la vue afficheSoumission avec les données placées en paramètre
                
                    break;
                
                
                /*-- SUPPRESSION D'UNE OEUVRE -------------------------------------------------*/
                
                case 'supprimeOeuvre':
					$oeuvreASupprimer = ($_GET['idOeuvre']);                                                            // récupère l'id de l'oeuvre à supprimer
					
					/*-- DELETE TABLE Oeuvre --------------------------------------------------*/
					$modeleCategorieAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$valide = $modeleCategorieAdmin->supprimer($oeuvreASupprimer, "idOeuvre", "Oeuvres");               // supprime l'oeuvre 
					if(!$valide)
					{                                                                                                   // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
                
					$_SESSION['ongletActif'] = 'oeuvresAdmin';                                                          // rafraichi la page
					$this->afficherEnteteAdmin();
                    $this->afficheVue("lienHautDePage");
					$this->afficherListeDesOeuvres();
					break;
                

                /*-- AJOUT D'UNE OEUVRE -------------------------------------------------------*/  
                
                case 'soumission':                                                                                      // page formulaire d'ajout administrateur
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
					$this->afficherFormSoumissionAdmin();             
					break;
				
				
				case "insereSoumission":                                                                                // à l'envoi du formulaire
					/*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
					//$tableauContenu = json_decode (file_get_contents('php://input'), true);
                    $tableauContenu = json_decode ($_POST['data'], true);                                               // decode la string JSON dans formData
                    extract($tableauContenu);                                                                           // convertit le JSON en variables
                
					/*-- INSERT TABLE Oeuvres -------------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$valide = $modeleSoumisionAdmin->insererSoumissionOeuvre($tableauContenu);                          // écrit la soumission dans la base de données                                      
					if(!$valide)
					{                                                                                                   // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
				
					/*-- INSERT TABLE Photos                 
                         PHOTO VENANT D'UNE SOUMISSION D'UN USAGER -----------------------------*/
                    $photo = $tableauContenu["urlPhoto"];                                                               // récupère la photo
                    if($photo != "" || $photo != null)                                                                  // s'il y a une photo soumise
                    {   
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $idPhotos = $modeleSoumisionAdmin->obtenirDernier("idPhoto", "Photos");                         // obtient l'id de la dernière photo inscrite dans la tabe Photos
                        $idPhotos++;                                                                                    // additionne 1 à ce chiffre
                        
                        $nomPhoto = "../images/" . $photo;                                                              // nom de la photo
                        $nouveauNomPhoto = "photo_" . $idPhotos . ".jpg";                                               // nouveau nom de la photo
                        rename($nomPhoto, "../images/" . $nouveauNomPhoto);                                             // renomme la photo
                        
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $valide = $modeleSoumisionAdmin->insererUrlPhoto($nouveauNomPhoto);                             // écrit le nouveau nom de la photo dans la table Photos
                        if(!$valide)
                        {                                                                                               // si non réussi
					   	   $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
					   	break;
					   }
                    }
                
                    /*-- PHOTO VENANT D'UN AJOUT ADMIN -----------------------------------------*/
                    //  sources :   https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire
                    //              http://php.net/manual/fr/features.file-upload.post-method.php
                    if(isset($_FILES['photos'])){                                                                       // si il y a une photo
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $idPhotos = $modeleSoumisionAdmin->obtenirDernier("idPhoto", "Photos");                         // obtient l'id de la dernière photo inscrite dans la tabe Photos
                        $idPhotos++;                                                                                    // additionne 1 à ce chiffre
                        
                        $uploadDirection = '../images/';                                                                // emplacement de la photo
                        $nomPhoto = "photo_" . $idPhotos . ".jpg";                                                      // nom de la photo
                        $uploadPhoto = $uploadDirection . $nomPhoto;                                                    // nom complet de la photo
                        
                        move_uploaded_file($_FILES['photos']['tmp_name'], $uploadPhoto);                                // charge la photo à son emplacement avec son nouveau nom
                        
                        $tableauContenu["urlPhoto"] = $nomPhoto;                                                        // ajoute le nom de la photo à la variable $tableauContenu
                        
                        $modeleSoumisionAdmin = new modeleSoumission();                                                 // appelle modèle "modeleSoumision"
                        $valide = $modeleSoumisionAdmin->insererUrlPhoto($nomPhoto);                                    // écrit le nom de la photo dans la table Photos                                           
                        if(!$valide)
				        {                                                                                               // si non réussi
                            $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                            break;
                        }
                    }
					
					/*-- INSERT TABLE Artistes -------------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$existe = $modeleSoumisionAdmin->verifierArtiste($tableauContenu);                                  // vérifie si l'artiste existe dans la base de données, s'il existe, retourne son id
					if($existe == NULL){                                                                                // s'il n'existe pas
						$modele = new modeleSoumission();                                                               // appelle modèle "modeleSoumision"
						$valide = $modele->insererSoumissionArtiste($tableauContenu);                                   // écrit le nom de l'artiste
						if(!$valide)
						{                                                                                               // si non réussi
							$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
							break;
						}
					}
					
					/*-- INSERT TABLE ArtistesOeuvres ------------------------------------------*/
					$modeleSoumisionAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$valide = $modeleSoumisionAdmin->insererSoumissionArtisteOeuvres($existe);                          // associe l'artiste à l'oeuvre dans la table ArtistesOeuvres
					if(!$valide)
					{                                                                                                   // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
                
                    /*-- SUPPRIME LA SOUMISSION DE L'USAGER, TABLE Soumissions ----------------*/ 
                    $idSoumissionUsager = $tableauContenu["idSoumissionUsager"];                                        // récupère l'id de la soumission
                    if($idSoumissionUsager != "")                                                                       // s'il y a une soumission
                    {
                        $modele = new modeleSoumission();                                                               // appelle modèle "modeleSoumision"
						$valide = $modele->supprimer($idSoumissionUsager, "idSoumission", "Soumissions");               // supprime la soumission
						if(!$valide)
						{                                                                                               // si non réussi
							$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
							break;
						}
                    }
					
					$this->afficheVue("afficheSoumission", $tableauContenu);                                            // appelle la vue afficheSoumission avec les données placées en paramètre 
					break;
                

				/*-- OEUVRES SOUMISES PAR LES USAGERS -----------------------------------------*/
                
                case 'soumissionsDesUsagers':                                                                           // page affichage des soumissions des usagers
					$_SESSION['ongletActif'] = 'oeuvresAdmin';
					$this->afficherEnteteAdmin();
                    $this->afficheVue("lienHautDePage");
					$this->afficherSoumissionsDesUsagers();             
					break;
                
                
                case 'supprimeSoumissionUsager':
					$soumissionASupprimer = ($_GET['idSoumissionUsager']);                                              // récupère l'id de la soumission à supprimer
					
					/*-- DELETE TABLE Soumissions ---------------------------------------------*/
					$modeleCategorieAdmin = new modeleSoumission();                                                     // appelle modèle "modeleSoumision"
					$valide = $modeleCategorieAdmin->supprimer($soumissionASupprimer, "idSoumission", "Soumissions");   // supprime la soumission
					if(!$valide)
					{                                                                                                   // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
                
					$_SESSION['ongletActif'] = 'soumission';                                                            // rafraichi la page
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
					$tableauContenu = json_decode (file_get_contents('php://input'), true);                            // decode la string JSON
                    extract($tableauContenu);                                                                          // convertit le JSON en variables

					/*-- INSERT TABLE Categories -----------------------------------------------*/
                    $modeleCategorieAdmin = new Categories();                                                          // appelle modèle "Categories"
					$valide = $modeleCategorieAdmin->insererCategorie($tableauContenu['categorie']);                   // écrit la nouvelle catégorie dans la table Catégories                                    
					if(!$valide)
					{                                                                                                  // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande d'ajout d'une catégorie.");
						break;
					}
					break;
				
					
				case 'supprimerCategorie':
					$tableauContenu = json_decode (file_get_contents('php://input'), true);                            // decode la string JSON
					extract($tableauContenu);                                                                          // convertit le JSON en variables
					$categorieASupprimer = $tableauContenu['categorie'];                                               // récupère la catégorie à supprimer
					
					/*-- DELETE TABLE Categories ----------------------------------------------*/
					$modeleCategorieAdmin = new Categories();                                                          // appelle modèle "Categories"
					$valide = $modeleCategorieAdmin->supprimer($categorieASupprimer);                                  // supprime la catégorie                                      
					if(!$valide)
					{                                                                                                  // si non réussi
						$this->phpAlert("Désolé, il y a eu un problème lors de la demande de suppression d'une catégorie.");
						break;
					}
					break;

                
                /////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////    AFFICHAGE    ///////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
				
                
                case 'affichage':
					$_SESSION['ongletActif'] = 'affichage';
					$this->afficherEnteteAdmin();
					$this->afficherPageAffichage();
					break;
						
				case 'ajouterImageCarroussel':
					$_SESSION['ongletActif'] = 'affichage';
					$this->afficherEnteteAdmin();
					$this->ajouterImageCarroussel();
					break;
				
				case 'suprimerImageCarroussel':
					$_SESSION['ongletActif'] = 'affichage';
					$this->afficherEnteteAdmin();
					$this->suprimerImageCarroussel();
					break;
                
                /////////////////////////////////////////////////////////////////////////////////////
                ////////////////////////////////    IMPORTATION    //////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////
                   
                    
                case 'importation':
					$_SESSION['ongletActif'] = 'importation';
					$this->afficherEnteteAdmin();
					$misJourData = $this->obtenirMiseAJour();														// Obtienne la liste du dernières mis à jours
					$this->afficheImportation($misJourData);														// Affiche la liste du dernières mis à jours
					break;
					
					
				case 'importationok':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();																//Obtiene le string JSON du site des donnés publiques
					$novData = $this->importation($publicJson,"importationBD");										//Appele le module importation
					$this-> enregistrerImportation($novData);														//Garde qui a fait l'importation sur la table mis a jour
					$this->afficheImportationOK($novData);                                                   		//Montre le résultat d'importation
					break;   
                    

				case 'verification':
					$this->afficherEnteteAdmin();
					$publicJson = $this->obtenirJSON();																//cet variable contienne les donnes en format JSON
					$novData = $this->importation($publicJson,"verification");										//Appele le module importation
					$this->afficheVerification($novData);															//Montre le résultat de verification
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
					$resultat = $admin->verificationAutentificationAdmin();
					if($resultat == 0)
					{
						$this->afficheVue("head");
						$this->afficheVue("enteteAdmin");
						$this->afficheVue('FormAutentificationAdmin');
					}
					else if($resultat == 1)
					{
						$this->afficheVue("head");
						$this->afficheVue("enteteAdmin");
						$this->afficheVue('changerMotDePasse');
					}
					else
					{
						unset($_POST['usager']);
						unset($_POST['pass']);
						$this->accueil();
					}
					echo $resultat;
					break;
					
				
				case 'changerMotDePasse':
					$admin = new Admin();
					$resulta = $admin->changementPasse($_POST['usager'], $_POST['pass']);
					header('Location: index.php?requete=affichage');
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
        $data = [];                                                                                                     // initialisation de $data
        $modeleListe = new ModeleListe();
        array_push($data,$modeleListe->getOeuvresParPhotos());
        array_push($data,$modeleListe->getOeuvresParAuteur());
        $this->afficheVue("listeOeuvresAdmin",$data); 
    }
    
    private function afficherFormSoumissionAdmin()
	{                                                 
        $dataSoumissions = null;
        if(isset($_GET["idSoumissionUsager"]))                                                                          // s'il s'agit d'une soumission d'un usager
        {
            $idSoumissionUsager = ($_GET["idSoumissionUsager"]);                                                        // s'il s'agit d'une soumission d'un usager
            $modeleSoumisionAdmin = new modeleSoumission();                                                             // appelle modèle "modeleSoumision"
            $dataSoumissions = $modeleSoumisionAdmin->obtenir($idSoumissionUsager, "idSoumission", "Soumissions");      // récupère l'arrondissement associé à cet oeuvre
            $choixArrondissement = $dataSoumissions['idArrondissementSoumission'];
        }
        
        $this->afficheVue("soumissionOeuvre1", $dataSoumissions);                                                       // input : titre et titre variante
        
        $this->afficheVue("soumissionArtiste", $dataSoumissions);                                                       // input : prenom, nom, collectif
        
        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");                                       // récupère la table Categories                                                 
        $this->afficheVue("soumissionCategorie", $data);                                                                // select : catégories
                                                             
		$this->afficheVue("soumissionOeuvre2");                                                                         // input : fin production, accession, matériaux,
                                                                                                                        //         technique, dimension
        
        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");                             // récupère la table Arrondissements                                   
        if(isset($_GET["idSoumissionUsager"]))                                                                          // s'il s'agit d'une soumission d'un usager
        {
            $data['choix'] = $choixArrondissement;                                                                      // place la valeur de l'arrondissement dans le tableau data
        }
        $this->afficheVue("soumissionArrondissement", $data);                                                           // select : arrondissements

		$this->afficheVue("soumissionOeuvre3", $dataSoumissions);                                                       // inputs : parc, batiment, adresse, latitude,
                                                                                                                        //          longitude
        
        $this->afficheVue("boutonSoumission");                                                                          // bouton soumission
        
        $this->afficheVue("footer");
	}

    private function afficherFormModificationAdmin()
	{                                                 
        $dataOeuvreAModifie = null;                                                                                     // initialise la variable $dataOeuvreAModifie à null
        
        $idOeuvre = ($_GET["idOeuvre"]);                                                                                // récupère l'id de l'oeuvre
        $modeleModificationAdmin = new ModeleListe();                                                                   // appelle modèle "modeleSoumision"
        $dataOeuvreAModifie = $modeleModificationAdmin->getOeuvresParID($idOeuvre);                                     // récupère toutes les infos d'une oeuvre spécifiée par son ID
        foreach($dataOeuvreAModifie as $oeuvre){
            $choixCategorie = $oeuvre['idCategorie'];                                                                   // récupère l'id de la catégorie associé à cette oeuvre
            $choixArrondissement = $oeuvre['idArrondissement'];                                                         // récupère l'id de l'arrondissement associé à cette oeuvre
        }
        
        $this->afficheVue("soumissionOeuvre1", $dataOeuvreAModifie);                                                    // input : titre et titre variante
        
        $this->afficheVue("soumissionArtiste", $dataOeuvreAModifie);                                                    // input : prenom, nom, collectif


        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");                                       // récupère la table Categories                                                 
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                                             // s'il s'agit d'une modification d'une oeuvre
        {
            $data['choix'] = $choixCategorie;                                                                           // place la valeur de la catégorie dans le tableau data
        }
        $this->afficheVue("soumissionCategorie", $data);                                                                // select : catégories
        
		$this->afficheVue("soumissionOeuvre2", $dataOeuvreAModifie);                                                    // input : fin production, accession, matériaux,
                                                                                                                        //         technique, dimension
        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Arrondissements", "nomArrondissement");                             // récupère la table Arrondissements                                   
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                                             // s'il s'agit d'une modification d'une oeuvre
        {
            $data['choix'] = $choixArrondissement;                                                                      // place la valeur de l'arrondissement dans le tableau data
        }
        $this->afficheVue("soumissionArrondissement", $data);                                                           // select : arrondissements
        
        $modeleListe = new ModeleListe();                                                                               // appelle modèle "modeleListe"
        array_push($dataOeuvreAModifie, $modeleListe->getPhotoParIDOeuvre($idOeuvre));                                  // récupère la ou les photos de l'oeuvre
		$this->afficheVue("soumissionOeuvre3", $dataOeuvreAModifie);                                                    // inputs : parc, batiment, adresse, latitude,
                                                                                                                        //          longitude
        $this->afficheVue("boutonModification");                                                                        // bouton modification

        $this->afficheVue("footer");
	}
    
    private function afficherSoumissionsDesUsagers()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Soumissions","idSoumission");                                       // récupère la table Soumissions
        $this->afficheVue("soumissionsDesUsagers", $data);                                                              // affiche la vue soumissionsDesUsagers avec les données placées en paramètre 
        $this->afficheVue("footer"); 
    }
    
    private function afficherPageGestionCategorie()
    {
        $modeleSoumisionAdmin = new modeleSoumission();                                                                 // appelle modèle "modeleSoumision"
		$data = $modeleSoumisionAdmin->obtenirTous("Categories", "nomCategorie");                                       // récupère la table Categories        
		$this->afficheVue("gestionCategorie", $data);                                                                   // affiche la vue gestionCategorie avec les données placées en paramètre
        $this->afficheVue("footer");   
    }
	
    /*-- AFFICHAGE -----------------------------------------------------------------------*/

    private function afficherPageAffichage()
    {
		$modelCarroussel = new Carroussel();
		$data = $modelCarroussel->obtenirTous();
        $this->afficheVue("gestionCarrousel", $data);
		$modelCarroussel = new Carroussel();
		$data = $modelCarroussel->obtenirTousImages();
        $this->afficheVue("gestionAjoutCarrousel", $data);
        $this->afficheVue("footer");   
    }
	
	private function suprimerImageCarroussel()
	{
		$modelCarroussel = new Carroussel();
		$data = $modelCarroussel->supprimer($_GET['idCaroussel']);
		header('Location: index.php?requete=affichage');
	}
	
	private function ajouterImageCarroussel()
	{
		$modelCarroussel = new Carroussel();
		$data = $modelCarroussel->ajouterImageCarroussel($_POST['carrousselAjoutTitre'],$_POST['choixPhoto'],$_POST['idOeuvre']);
		unset($_POST['carrousselAjoutTitre']);
		unset($_POST['choixPhoto']);
		unset($_POST['idOeuvre']);
		header('Location: index.php?requete=affichage');
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
    
	private function afficheImportation($data)																			//Montre les vues de l'action importation
	{
		$this->afficheVue("afficheImportation");
		$this->afficheVue("historiqueBD",$data);
        $this->afficheVue("footer"); 
	}	

	private function afficheImportationOK($data)																		//Montre les vues de l'action importation OK
	{
		$this->afficheVue("afficheImportationOK",$data);
		$this->afficheVue("footer");
	}
	
	private function afficheVerification($data)																			//Montre les vues de l'action verification
	{
		$this->afficheVue("afficheVerification",$data);
        $this->afficheVue("footer"); 
	}
	
	private function obtenirJSON()																						//Module pour obtenir le JSON
	{
		$oRemote = new Donnesremote();
		return $oRemote->getpublicJSON();
	}
	
	private function obtenirMiseAJour()																					
	{
		$oMisaJour = new MiseaJour();
		return $oMisaJour->obtenirXenregistrement(10,"MiseAJours","idMiseAJour");										//Module pour obtenir les 10 dernières rangées de la table mise jour
	}
	
	private function importation($jSon,$action)
	{
		$oImportation = new Importation();
		return $oImportation->traiterDonnees($jSon,$action);															//Traitement de donnes en comparisant contre le JSON
	}
	    
    private function enregistrerImportation($donnes)																	//Enregistre qui a fait la dernière mis a jour
	{
		$oMisaJour = new MiseaJour();
		$oMisaJour->enregistrement($donnes);
	}
}
?>


