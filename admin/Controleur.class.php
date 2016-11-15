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
                
                var_dump ("var_dump");
                var_dump ($titre);
                var_dump ($titreVariante);
                var_dump ($prenomArtiste);
                var_dump ($nomArtiste);
                var_dump ($collectif);
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
                $existe = $modele->verifierArtiste($tableauContenu);
                var_dump ("existe ????");
                var_dump ($existe);
                if($existe == NULL){
                    $modele = new modeleSoumission();
                    $valide = $modele->insererSoumissionArtiste($tableauContenu);
                    if($valide){									
                        echo "merci";	
                    }else{
                        echo "ERROR";
                    }
                }
                
                /*-- TABLE ArtistesOeuvres ------------------------------------------------*/
                $modele = new modeleSoumission();
                $valide = $modele->insererSoumissionArtisteOeuvres($existe);
                if($valide){									
                    echo "merci";	
                }else{
                    echo "ERROR";
                }
                break;
            default:
				$this->accueil();
				break;
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
    
    private function autentificationAdmin()
    {
        $oVue = new VueAdmin();
        $admin = new Admin();
        $resulta = $admin->verifFormAutentifiAdmin();
        
        
        $oVue->afficheEntete();
        
        if($resulta)
        {
            $oVue->afficherAcceuilAdmin();
        }
        else
        {
            $oVue->afficheFormAutentificationAdmin();
        }
        
        $oVue->affichePied();
    }
    
    private function admin()
    {
        $oVue = new VueAdmin();
        
        $oVue->afficheEntete();
        $oVue->verifFormAutentifiAdmin();
        $oVue->affichePied();
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
		

    function importationok()
    {
        $oVue = new Vue();
        
        //$oVue->afficheEntete();
        $oVue->afficheImportationok();
        $oVue->affichePied();
    }
    


}
?>















