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
				case 'importation':
					$this->importation(); // option quand get requete n'existe pas
					break;
				case 'importationok':
					
					$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
					//$connexionBD = $this->obtenirconnexionBD();//cet variable contienne la connexion à la BD neccesaire pour faire les querys
					$this->traiterDonnees($publicJson);//parce qu'on envoi des donnees il n'est pas neccessaire de retourner quelque chose
					
					//echo $publicJson[0]->Artistes[0]->Nom;
				
					$this->importationok(); // avant de montrer la vue, je dois aller chercher le donnes avec le modele
					break;
				default:
					$this->accueil(); // option quand get requete n'existe pas ou c'est incorrect(ça vais montrer la page d'accueil quand même)
					break;
			}
		}
		private function accueil()
		{
			$oVue = new Vueimportation();
			
			$oVue->afficheEntete();
			$oVue->afficheAccueil();
			$oVue->affichePied();
		}
		// Placer les méthodes du controleur.
		private function importation()
		{
			$oVue = new Vueimportation();
			
			$oVue->afficheEntete();
			$oVue->afficheformImportation();
			$oVue->affichePied();
		}
		
		private function importationok()
		{
			
			$oVue = new Vueimportation();
			$oVue->afficheEntete();
			$oVue->afficheImportationok();
			$oVue->affichePied();
		}
		
		// fucntions/modeles pour traitement sans affichage
		
		private function obtenirJSON()
		{
			$oRemote = new Donnesremote();
			return $oRemote->getpublicJSON();
			
		}
		
		/*private function obtenirconnexionBD()
		{
			$oArtistes = new Artistes();
			return $oArtistes->connexionBD();
			
		}*/
		
		private function traiterDonnees($jsonSite){
			
			$oArtistes = new Artistes();
			$data = $oArtistes->compteRanges();
			$nomArtistesBD = $data["quantite"];
			echo $nomArtistesBD;
			echo "<br>";
		}
		
}
?>















