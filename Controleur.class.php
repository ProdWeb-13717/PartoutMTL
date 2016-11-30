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
			case 'accueil':
				$this->accueil(); // option quand get requete est accueil
				break;
				
				
            case 'listeArtistes':
				$data = []; // initialisation de $data
  				$this->entete();
				$modeleListe = new ModeleListe();
				$data = $modeleListe->getArtisteTout();
				$this->afficheVue("listeArtistes",$data);
				break;
				
			
			case 'listeOeuvres':  
				$data = []; // initialisation de $data
				$this->entete();
				$modeleListe = new ModeleListe();
				array_push($data,$modeleListe->getOeuvresParPhotos());
				array_push($data,$modeleListe->getOeuvresParAuteur());
				$this->afficheVue("listeOeuvres",$data);
				break;
				
				
			case 'rechercheOeuvreTitre': // la page de recherche d'oeuvre par titre
				$this->entete();
				$this->rechercheOeuvreTitre(); // option quand get requete n'existe pas
				break;
				
			
			case 'txtRecherche': // la value de recherche d'oeuvre par titre envoye par AJAX
				if(isset($_GET['valRecherche']))
				{
					$valeur = $_GET['valRecherche'];
					$oRecherche = new Recherche();
					$data = $oRecherche->rechercheOeuvres($valeur,"titre"); // cle = titre 
					$oVueRecherche = new VueRecherche();
					$this->entete();
					$oVueRecherche->resultatDataRecherche($data);
				}
				break;
            
            
            case 'soumissionOeuvre':                                                          // page formulaire de soumission usager
				$this->entete();                    
                $modeleSoumisionUsager = new modeleSoumissionUsager();                        // appelle modeleSoumission
                $data = $modeleSoumisionUsager->obtenirTous("Arrondissements", "nomArrondissement");   // récupère la table Arrondissements
                $vue = "soumissionOeuvreUsager";
                $this->afficheVue($vue, $data);    
                break;
            
            
            case "insereSoumissionUsager":                                                    // à l'envoi du formulaire
            
                /*-- DATA RÉCUPÉRÉES ------------------------------------------------------*/
                $tableauContenu = json_decode (file_get_contents('php://input'), true);       // decode la string JSON
                extract($tableauContenu);                                                     // convertit le JSON en variables
                
                var_dump($tableauContenu);
            
                /*-- INSERT TABLE Soumission ----------------------------------------------*/
                $modeleSoumisionUsager = new modeleSoumissionUsager();
                $valide = $modeleSoumisionUsager->insererSoumission($tableauContenu);                                       
                if(!$valide)
				{                                                           // si non réussi
                    $this->phpAlert("Désolé, il y a eu un problème lors de la soumission.");
                    break;
                }
                
                //$vue = "afficheSoumission";
                //$this->afficheVue($vue, $tableauContenu);    
                break;
				
				
            default:
				$this->accueil(); // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
				break;  
		}
	}

	////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////     MÉTHODES DU CONTROLEUR     ////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////
    
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
	
	private function accueil()
	{
		$this->afficheVue("head");
		$this->afficheVue("acceuilUsager");
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















