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
        
			$vue = "enteteUser";
			$this->afficheVue($vue);
			
			
			switch ($_GET['requete']) {
				case 'accueil':
					$this->accueil(); // option quand get requete est accueil
					break;
					
				case 'importation':
					$this->importation(); // option quand get requete n'existe pas
					break;
					
				case 'importationok':
					$this->importationok(); // option quand get requete n'existe pas
					break;
                    
                case 'listeArtistes':
				
					$vue = "listeArtistes";
					$modeleListe = new ModeleListe();
					$data = $modeleListe->getArtisteTout();
					$this->afficheVue($vue,$data);
					
					break;
					
				case 'listeOeuvres':
					
					$vue = "listeOeuvres";
					$modeleListe = new ModeleListe();
					$data = $modeleListe->getOeuvresTout();
					$this->afficheVue($vue,$data);
					
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
			$oVue = new Vue();
			
			$oVue->afficheEntete();
			$oVue->afficheAccueil();
			$oVue->affichePied();
		}
		// Placer les méthodes du controleur.
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
}
?>















