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
			// j'ai suprimé cette partie parce que ca cause des problems pour afficher la resultat de recherche (case 'txtRecherche') et j'ai mit dans une function-SARA
			//$vue = "head";
			//$this->afficheVue($vue);
            //
			//$vue = "enteteUser";
			//$this->afficheVue($vue);
			
			
			switch ($_GET['requete']) {
				case 'accueil':
					$this->entete();
					$this->accueil(); // option quand get requete est accueil
					break;
					
				case 'importation':
					$this->entete();
					$this->importation(); // option quand get requete n'existe pas
					break;
					
				case 'importationok':
					$this->entete();
					$this->importationok(); // option quand get requete n'existe pas
					break;
                    
                case 'listeArtistes':
					$this->entete();
					$vue = "listeArtistes";
					$modeleListe = new ModeleListe();
					$data = $modeleListe->getArtisteTout();
					$this->afficheVue($vue,$data);
					
					break;
					
				case 'listeOeuvres':
					$this->entete();
					$vue = "listeOeuvres";
					$modeleListe = new ModeleListe();
					$data = $modeleListe->getOeuvresTout();
					$this->afficheVue($vue,$data);
					
					break;
				case 'rechercheOeuvreTitre': // la page de recherche d'oeuvre par titre
					$this->entete();
					$this->rechercheOeuvreTitre(); // option quand get requete n'existe pas
					break;
				case 'txtRecherche': // la value de recherche d'oeuvre par titre envoye par AJAX
					
					if(isset($_GET['valRecherche'])){
						
						$valeur = $_GET['valRecherche'];
						$oRecherche = new Recherche();
						$data = $oRecherche->rechercheOeuvres($valeur,"titre"); // cle = titre 
						$oVueRecherche = new VueRecherche();
			
						$oVueRecherche->resltatDataRecherche($data);
						
					}
					
				break;
					
                default:
					$this->entete();
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
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheAccueil();
			$oVue->affichePied();
		}
		// Placer les méthodes du controleur.
		function entete() // pour afficher le head et entete d'usager
		{
			$vue = "head";
			$this->afficheVue($vue);
			
			$vue = "enteteUser";
			$this->afficheVue($vue);
		}
		
		function importation()
		{
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheformImportation();
			$oVue->affichePied();
		}
		
		function importationok()
		{
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheImportationok();
			$oVue->affichePied();
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















