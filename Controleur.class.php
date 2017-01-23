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
		switch ($_GET['requete']) 
		{
			
            /////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////    ACCUEIL    ////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
            
            
            case 'accueil':
				$this->accueil(); // option quand get requete est accueil
				break;

            
            case 'contact':
                $this->afficheVue("head");
                $this->afficheVue("enteteAccueil");
                $this->afficheVue("contact");
                $this->afficheVue("footer");
                break;
    
    
            /////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////    ARTISTES    ////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
            
            
			//Affichage de la liste de tous les artistes	
            case 'listeArtistes':
				$data = []; // initialisation de $data
  				$this->entete();
				$modeleListe = new ModeleListe();
				$data = $modeleListe->getArtisteTout();
				$this->afficheVue("barRecherche");
				$this->afficheVue("listeArtistes",$data);
                $this->afficheVue("footer");
				break;
            
            
            /////////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////////    OEUVRES    ////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
			
            
			//Affichage de la liste de toutes les oeuvres
			case 'listeOeuvres':  
				$data = []; // initialisation de $data
				$this->entete();
				$modeleListe = new ModeleListe();
				array_push($data,$modeleListe->getOeuvresParPhotos());
				array_push($data,$modeleListe->getOeuvresParAuteur());
				$this->afficheVue("barRecherche");
				$this->afficheVue("listeOeuvres",$data);
                $this->afficheVue("footer");
				break;
				
			//Affiche les oeuvre après avoir cliqué sur le nom d'un artiste
			case 'listeOeuvreParAuteurId':  
				$this->entete();
				$data = [];
				$modeleListe = new ModeleListe();
				if(isset($_GET['idArtiste']))
				{
					//On va chercher les informations reliées à l'oeuvres ainsi que ses auteurs et les photo qui y son relié et on les tock dans  $data
					array_push($data,$modeleListe->getOeuvresParPhotos());
					array_push($data,$modeleListe->getOeuvresParAuteur());
					array_push($data, $modeleListe->getOeuvresParAuteurId($_GET['idArtiste']));
                    
					if($data[0] != 0 && $data[1] != 0 && $data[2] != 0)
					{
						if(count($data) != 0)
						{
							$this->afficheVue("barRecherche");
							$this->afficheVue("listeOeuvresParArtisteId",$data);
							$this->afficheVue("footer");
						}
						else
						{
							echo "<h1>Cette id n'existe pas !</h1>";
						}
					}
					else
					{
						echo "<h1>Une erreure s'est produite dans votre requête</h1>";
					}
				}
				else
				{
					echo "<h1>!!! ERREUR !!! : Un ID d'Artiste est requis pour cette requête... </h1>";
				}
				break;
				
			//Affichage d'une oeuvre individuelle
			case 'afficheOeuvre':  
				$this->entete();
				$data = [];
				$modeleListe = new ModeleListe();
				if(isset($_GET['idOeuvre']))
				{
					//On va chercher les informations reliées à l'oeuvres ainsi que ses auteurs et les photo qui y son relié et on les tock dans  $data
					array_push($data, $modeleListe->getOeuvresParID($_GET['idOeuvre']));
					array_push($data, $modeleListe->getPhotoParIDOeuvre($_GET['idOeuvre']));
					if($data[0] != 0 && $data[1] != 0)
					{
						if(count($data) != 0)
						{
							$this->afficheVue("affichageOeuvre",$data);
						}
						else
						{
							echo "<h1>Cette id n'existe pas !</h1>";
						}
					}
					else
					{
						echo "<h1>Une erreure s'est produite dans votre requête</h1>";
					}
				}
				else
				{
					echo "<h1>!!! ERREUR !!! : Un ID d'oeuvre est requis pour cette requête... </h1>";
				}
				break;
			
            
            /////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////    RECHERCHE    ///////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
			
            
			case 'rechercheAvance': // la recherche Avance
				$this->entete();
				$this->afficheVue("rechercheAvance");
				break;	
				
			case 'rechercheOeuvre': 
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheOeuvresParPhotos($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheOeuvresParAuteur($_GET['valRecherche']));
					$this->afficheVue("barRecherche");
					$this->afficheVue("listeOeuvres",$data);
				
				}
				break;
            
			case 'rechercheAvanceOeuvres': 
				if(isset($_GET['valRecherche']) && isset($_GET['cleRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheOeuvresAvanceParPhotos($_GET['valRecherche'],$_GET['cleRecherche']));
					array_push($data,$modeleListe->rechercheOeuvresAvanceParAuteur($_GET['valRecherche'],$_GET['cleRecherche']));
					$this->afficheVue("rechercheAvance");
					$this->afficheVue("listeOeuvres",$data);
				
				}
				break;
				
			case 'rechercheAvanceArtistesOeuvres':  //avance par oeuvre par artistes
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvres($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvres($_GET['valRecherche']));
					$this->afficheVue("rechercheAvance");
					$this->afficheVue("listeOeuvres",$data);
				
				}
				break;
				
			case 'rechercheAvanceArtistesOeuvresArrondissements':  //avance par oeuvre par Arrondissements
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvresArrondissements($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvresArrondissements($_GET['valRecherche']));
					$this->afficheVue("rechercheAvance");
					$this->afficheVue("listeOeuvres",$data);
				
				}
				break;
				
				case 'rechercheAvanceArtistesOeuvresCategories':  //avance par oeuvre par Categories
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvresCategories($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheAvanceArtistesOeuvresCategories($_GET['valRecherche']));
					$this->afficheVue("rechercheAvance");
					$this->afficheVue("listeOeuvres",$data);
				
				}
				break;
            
            case 'rechercheArtistes': 
				if(isset($_GET['valRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					$data = $modeleListe->rechercheArtisteTout($_GET['valRecherche']);
					$this->afficheVue("barRecherche");
					$this->afficheVue("listeArtistes",$data);
				
				}
				break;
            
			case 'rechercheAvanceArtistes': // la value de recherche d'oeuvre par titre envoye par AJAX
				if(isset($_GET['valRecherche']) && isset($_GET['cleRecherche']))
				{
					$data = []; // initialisation de $data
					$this->entete();
					$modeleListe = new Recherche();
					$data = $modeleListe->rechercheAvanceArtisteTout($_GET['valRecherche'],$_GET['cleRecherche']);
					$this->afficheVue("rechercheAvance");
					$this->afficheVue("listeArtistes",$data);
					
				}
				break;
            
            case 'rechercheAccueil': // la value de recherche d'oeuvre par titre envoye par AJAX
				if(isset($_GET['valRecherche']))
				{
					//********* recherche pour artistes
					$dataArtistes = []; // initialisation de $dataArtistes
					$this->entete();
					$modeleListe = new Recherche();
					$dataArtistes = $modeleListe->rechercheArtisteTout($_GET['valRecherche']);
					//************** recherche pour oeuvre
					$data = []; // initialisation de $data
					$modeleListe = new Recherche();
					array_push($data,$modeleListe->rechercheOeuvresParPhotos($_GET['valRecherche']));
					array_push($data,$modeleListe->rechercheOeuvresParAuteur($_GET['valRecherche']));
					$this->afficheVue("barRecherche");
					$this->afficheVue("listeOeuvres",$data);
					$this->afficheVue("listeArtistes",$dataArtistes);
				
				}
				break;
            
            
            /////////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////////    CARTE    /////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
            
				
			case 'carte':
				$this->entete();                    
                $modeleCarte = new Recherche();
				$data = $modeleCarte->obtenirOeuvres();
                $this->afficheVue("carte", $data);
                $this->afficheVue("footer");
                break;
            
            
            /////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////    SOUMISSION    //////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////
            
             
            case 'soumissionOeuvre':                                                                        // page formulaire de soumission usager
				$this->entete();                    
                $modeleSoumisionUsager = new modeleSoumissionUsager();                                      // appelle "modeleSoumissionUsager"
                $data = $modeleSoumisionUsager->obtenirTous("Arrondissements", "nomArrondissement");        // récupère la table Arrondissements
                $this->afficheVue("soumissionOeuvreUsager", $data);                                         // affiche la vue avec les arrondissements en datas                              
                $this->afficheVue("footer");                                                                // affiche le footer
                break;
            
            case "insereSoumissionUsager":                                                                  // à l'envoi du formulaire
            
                /*-- DATA RÉCUPÉRÉES ---------------------------------------------------------*/
                $tableauContenu = json_decode ($_POST['data'], true);                                       // decode la string JSON dans formData
                extract($tableauContenu);                                                                   // convertit le JSON récupé en variables
            
                /*-- INSERT TABLE Soumission -------------------------------------------------*/
                $modeleSoumisionUsager = new modeleSoumissionUsager();                                      // appelle "modeleSoumission"
                $valide = $modeleSoumisionUsager->insererSoumission($tableauContenu);                       // appelle la fonction "insererSoumission" avec les variables récupérées en paramètres                                     
                if(!$valide)
				{                                                                                           // si non réussi
                    $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                    break;
                }
                
                /*-- PHOTO RÉCUPÉRÉE ---------------------------------------------------------*/
                //  sources :   https://openclassrooms.com/courses/upload-de-fichiers-par-formulaire
                //              http://php.net/manual/fr/features.file-upload.post-method.php
                
                if(isset($_FILES['photos'])){                                                               // si il y a une photo
                    $uploadDirection = './images/';                                                         // chemin relatif de l'emplacement où sera uploader la photo
                    
                    $modeleSoumisionUsager = new modeleSoumissionUsager();                                  // appelle "modeleSoumissionUsager"
                    $idSoumission = $modeleSoumisionUsager->obtenirDernier("idSoumission", "Soumissions");  // obtient le dernier id de la table Soumissions
                    
                    $nomPhoto = "photoUsager" . $idSoumission . ".jpg";                                     // le nouveau nom de la photo aura cet id récupéré concaténé
                    $uploadPhoto = $uploadDirection . $nomPhoto;                                            // nom et adresse complète de la photo

                    move_uploaded_file($_FILES['photos']['tmp_name'], $uploadPhoto);                        // la photo est uploader à son emplacement
                    
                    /*-- INSERT photoSoumision TABLE Soumissions -----------------------------*/
                    $modeleSoumisionUsager = new modeleSoumissionUsager();                                  // appelle "modeleSoumissionUsager"
                    $valide = $modeleSoumisionUsager->insererPhotoSoumission($nomPhoto);                    // insere le nom de la phot dans la base de donnée, table Soumissions                                     
                    if(!$valide)                                                                            // si non réussi
				    {
                        $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                        break;
                    }
                }
            
                /*-- INSERT TABLE CourrielsUsagers -------------------------------------------*/
                $modeleSoumisionUsager = new modeleSoumissionUsager();                                      // appelle "modeleSoumissionUsager"
				$existe = $modeleSoumisionUsager->verifierCourrielUsager($tableauContenu);                  // vérifie si le courriel existe dans la base de données
				if($existe == NULL){                                                                        // s'il n'existe pas
					$modele = new modeleSoumissionUsager();                                                 // appelle "modeleSoumissionUsager"
					$valide = $modele->insererCourrielUsager($tableauContenu);                              // insère cet email dans la base de données, table CourrielsUsagers
					if(!$valide)                                                                            // si non réussi
					{
						$this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
						break;
					}
				}
                
                $vue = "remerciements";                                                                     // lorsque la soumission est complété, l'usager voit un message de remerciements à l'écran
                $this->afficheVue($vue);    
                break;    
				
				
            default:
				$this->accueil();                                                                           // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
				break;  
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////     MÉTHODES DU CONTROLEUR     ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
	
    
    /*-- GLOBAL ------------------------------------------------------------------------------*/
    
    protected function afficheVue($nomVue, $data = null)
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
	
	function entete() // pour afficher le head et entete d'usager
	{
		$this->afficheVue("head");
		$this->afficheVue("enteteUser");
	}
    
    
    /*-- PAGE D'ACCUEIL -----------------------------------------------------------------------*/
	
	private function accueil()
	{
		$this->afficheVue("head");
        $this->afficheVue("enteteAccueil");
		$modCar = new ModeleCarroussel();
		$data = $modCar -> getPhotoCarroussel();
        $this->carroussel();
        $this->afficheVue("footer");
	}
	
	function carroussel() // la fonction pour afficher le carroussel
	{
		$modCar = new ModeleCarroussel();
		$data = $modCar -> getPhotoCarroussel();
		$this->afficheVue("carroussel",$data);
	}
	
	function rechercheOeuvreTitre() // la fonction pour la recherche d'oeuvre par son titre
	{
		$oVue = new Vue();
		$oVue->afficheEntete();
		
		$oVueRecherche = new VueRecherche();
		$oVueRecherche->afficheRechercheOeuvreTitre();

		$oVue->affichePied();
	}
}
?>

