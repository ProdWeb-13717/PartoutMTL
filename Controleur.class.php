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
			
			
			switch ($_GET['requete']) {
				case 'accueil':
					$this->accueil(); // option quand get requete est accueil
					break;

                case 'listeArtistes':
					$data = [];
  					$this->entete();
  					$vue = "listeArtistes";
					$modeleListe = new ModeleListe();
					$data = $modeleListe->getArtisteTout();
					array_push($data,$modeleListe->getOeuvresParPhotos());
					array_push($data,$modeleListe->getOeuvresParAuteur());
					$this->afficheVue($vue,$data);
					break;

					
				case 'listeOeuvres':
					$data = [];
					$this->entete();
					$vue = "listeOeuvres";
					$modeleListe = new ModeleListe();
					array_push($data,$modeleListe->getOeuvresParPhotos());
					array_push($data,$modeleListe->getOeuvresParAuteur());
					$this->afficheVue($vue,$data);
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
					
                default:
					$this->accueil(); // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
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
		
		
		private function accueil()
		{
			$this->afficheVue("head");
			
			$oVue = new Vue();
			$oVue->afficheAccueil();
			
		}
		// Placer les méthodes du controleur.
		function entete() // pour afficher le head et entete d'usager
		{
			$this->afficheVue("head");
			$this->afficheVue("enteteUser");
		}
		
		function rechercheOeuvreTitre() // la fonction pour la recherche d'oeuvre par son titre
		{
			$oVue = new Vue();
			$oVueRecherche = new VueRecherche();
			$oVue->afficheEntete();
			$oVueRecherche->afficheRechercheOeuvreTitre();
			$oVue->affichePied();
		}
}
?>















