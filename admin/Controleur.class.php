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
<<<<<<< HEAD
       /**
	 * Traite la requête
	 * @return void
	 */
	public function gerer()
	{
		
        $vue = "head";
        $this->afficheVue($vue);
        
        $vue = "enteteAdmin";
        $this->afficheVue($vue);
        
        switch ($_GET['requete']) 
        {
			case 'accueil':
				$this->accueil();                                                          // option quand get requete est accueil
				break;
			case 'importation':
				$this->importation();                                                      // option quand get requete n'existe pas
				break;
			case 'importationok':
				$this->importationok();                                                    // option quand get requete n'existe pas
				break;
            case 'soumission':                                                             // page formulaire de soumission administrateur
                //$this->soumissionAdmin();

                
                $vue = "soumissionOeuvre1";
				$this->afficheVue($vue);
            
                $vue = "soumissionArtiste";
				$this->afficheVue($vue);
                
                $modeleSoumisionAdmin = new modeleSoumission();
				$data = $modeleSoumisionAdmin->obtenirCategories();
                $vue = "soumissionCategorie";
                $this->afficheVue($vue, $data);
            
                $vue = "soumissionOeuvre2";
				$this->afficheVue($vue);
            
                $modeleSoumisionAdmin = new modeleSoumission();
				$data = $modeleSoumisionAdmin->obtenirArrondissements();
                $vue = "soumissionArrondissement";
                $this->afficheVue($vue, $data);
            
                $vue = "soumissionOeuvre3";
				$this->afficheVue($vue);
            
                $vue = "soumissionPhoto";
				$this->afficheVue($vue);
            
                $vue = "boutonSoumission";
                $this->afficheVue($vue);
                

                break;
            case "insereSoumission":                                                       // à l'envoi du formulaire
                /*-- paramètres dirigés vers la table Oeuvres -----------------------------*/
            
                $tableauContenu = json_decode (file_get_contents('php://input'), true);
                var_dump($tableauContenu);
                extract($tableauContenu);
                
                var_dump ($titre);
                var_dump ($titreVariante);
                var_dump ($idCategorie);
                var_dump ($idArrondissement);
                var_dump ($urlPhoto);
               
                /*-- TABLE Oeuvres --------------------------------------------------------*/
                $modele = new modeleSoumission();
                $valide = $modele->insererSoumissionOeuvre($tableauContenu);
                                                           
                if($valide){									
                    echo "merci";	
                    //print_r("merci");
                }else{
                    echo "ERROR";
                }
            
                /*-- TABLE Photos ---------------------------------------------------------*/
                $modele = new modeleSoumission();
                $valide = $modele->insererUrlPhoto($tableauContenu);
                if($valide){									
                    echo "merci";	
                    //print_r("merci");
                }else{
                    echo "ERROR";
                }
                
                /*-- TABLE Artistes -------------------------------------------------------*/
                $modele = new modeleSoumission();
                $valide = $modele->insererSoumissionArtiste($tableauContenu);
                
                if($valide){									
                    echo "merci";	
                }else{
                    echo "ERROR";
                }
                
                /*-- TABLE ArtistesOeuvres ------------------------------------------------*/
                $modele = new modeleSoumission();
                $valide = $modele->insererSoumissionArtisteOeuvres();
                
                if($valide){									
                    echo "merci";	
                }else{
                    echo "ERROR";
                }
                break;
            default:
				$this->accueil();
				break;
=======
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			
			switch ($_GET['requete']) {
				case 'accueil':
					$this->accueil();              // option quand get requete est accueil
					break;
				case 'importation':
					$this->importation();          // option quand get requete n'existe pas
					break;
				case 'importationok':
					$this->importationok();        // option quand get requete n'existe pas
					break;
                 case 'soumission':
                    $this->soumissionAdmin();
                    break;
                case "insereSoumission":
                    
                    /*-- dirigé vers la table Oeuvres -----------------------------------------*/
                    $titreOeuvreAjout = $_POST['titreOeuvreAjout'];
                    $titreVarianteOeuvreAjout = $_POST['titreVarianteOeuvreAjout'];
                    $dateFinProduction = $_POST['dateFinProductionOeuvreAjout'];
                    $collection = $_POST['collectionOeuvreAjout'];
                    $modeAcquisition = $_POST['modeAcquisitionOeuvreAjout']; 
                    $dateAcquisition = $_POST['dateAcquisitionOeuvreAjout'];
                    $materiaux = $_POST['materiauxOeuvreAjout'];
                    $technique = $_POST['techniqueOeuvreAjout'];
                    $dimensions = $_POST['dimensionsOeuvreAjout'];
                    $parc = $_POST['parcOeuvreAjout'];
                    $batiment = $_POST['batimentOeuvreAjout'];
                    $adresseCivique = $_POST['adresseCiviqueOeuvreAjout'];
                    $latitude = $_POST['latitudeOeuvreAjout'];
                    $longitude = $_POST['longitudeOeuvreAjout'];
                    $description = $_POST['descriptionOeuvreAjout'];
                    
                    /*-- dirigé vers la table Artistes ----------------------------------------*/
                    $nomArtiste = $_POST['nomArtisteOeuvreAjout'];
                    $prenomArtiste = $_POST['prenomArtisteOeuvreAjout'];
                    $collectif = $_POST['collectifOeuvreAjout'];
                    
                    /*-- dirigé vers la table Catégories --------------------------------------*/
                    $categorie = $_POST['categorieOeuvreAjout'];
                    
                    /*-- dirigé vers la table Arrondissements ---------------------------------*/
                    $arrondissement = $_POST['arrondissementOeuvreAjout'];
                    
                    /*-- dirigé vers la table Photos ------------------------------------------*/
                    $urlPhoto = $_POST['urlPhotoOeuvreAjout'];
                    
                    /*-- 
                    /*-- instancie une nouvelle itération de la classe SoumissionAdmin --------*/
                    $modele = new SoumissionAdmin();
				    
                    $valide = $modele->insererSoumissionOeuvre($titre, 
                                                               $titreVariante, 
                                                               $dateFinProduction, 
                                                               $collection, 
                                                               $modeAcquisition, 
                                                               $dateAcquisition, 
                                                               $materiaux, 
                                                               $technique, 
                                                               $dimensions, 
                                                               $parc, 
                                                               $batiment, 
                                                               $adresseCivique, 
                                                               $latitude, 
                                                               $longitude, 
                                                               $description);       
                    
                    
                    if($valide){									
				        echo "merci";	
                        //print_r("merci");
                        //$this->soumissionReussie();
				    }
				    else{
				        echo "ERROR";
                        //$this->afficheEchec();
				    }
                    
                    /*-- instancie une nouvelle itération de la classe SoumissionAdmin --------*/
                    $modele = new SoumissionAdmin();
                    
                    $valide = $modele->insererSoumissionArtiste($nomArtiste,
                                                                $prenomArtiste,
                                                                $collectif);
                    
                    if($valide){									
				        echo "merci";	
                        //print_r("merci");
                        //$this->soumissionReussie();
				    }
				    else{
				        echo "ERROR";
                        //$this->afficheEchec();
				    }
                    
                    /*-- instancie une nouvelle itération de la classe SoumissionAdmin --------*/
                    $modele = new SoumissionAdmin();
                    
                    $valide = $modele->insererSoumissionArtiste($nomArtiste,
                                                                $prenomArtiste,
                                                                $collectif);
                    if($valide){									
				        echo "merci";	
                        //print_r("merci");
                        //$this->soumissionReussie();
				    }
				    else{
				        echo "ERROR";
                        //$this->afficheEchec();
				    }
                    
				        
                    break;
                
				default:
					$this->accueil(); // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
					break;
			}
		}
		private function accueil()
		{
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheAccueil();
			$oVue->affichePied();
>>>>>>> origin
		}
	}
    
    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////     MÉTHODES DU CONTROLEUR     ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    
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
    
    
    
    private function accueil()
    {
        $oVue = new Vue();
        
        //$oVue->afficheEntete();
        $oVue->afficheAccueil();
        $oVue->affichePied();
    }

    function importation()
    {
        $oVue = new Vue();
        
        //$oVue->afficheEntete();
        $oVue->afficheformImportation();
        $oVue->affichePied();
    }
		
<<<<<<< HEAD
    function importationok()
    {
        $oVue = new Vue();
        
        //$oVue->afficheEntete();
        $oVue->afficheImportationok();
        $oVue->affichePied();
    }
    
=======
		function importationok()
		{
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheImportationok();
			$oVue->affichePied();
		}
    
        private function soumissionAdmin()
		{
			$oVue = new Vue();
			$oVue->afficheEntete();
			$oVue->afficheSoumissionAdmin();
			$oVue->affichePied();
		}

        
        private function soumissionReussie()
		{
			$oVue = new Vue();
			$oVue->afficheEntete();
			$oVue->afficheReussi();
			$oVue->affichePied();
		}
    
        private function afficheEchec()
        {
			$oVue = new Vue();
			$oVue->afficheEntete();
			$oVue->afficheEchec();
			$oVue->affichePied();
		}
>>>>>>> origin
    
    
}
?>















