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
					$this->traiterDonnees($publicJson);//parce qu'on envoi des donnees il n'est pas neccessaire de retourner quelque chose
				
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
		
		private function traiterDonnees($jsonSite){
			
			$nomOuvres = count($jsonSite);
			
			for($i=0;$i<20;$i++){// for pour parcourir tout les oeuvres
				
				//***traitement des artistes*** esto podria ir en una funcion..despues lo probamos//
				
				foreach($jsonSite[$i]->Artistes as $artiste){
					
					// verification des donnees null
					if($artiste->Nom == null){
						
						$artiste->Nom = "";
					}
					if($artiste->Prenom == null){
						
						$artiste->Prenom = "";
					}
					if($artiste->NomCollectif == null){
						
						$artiste->NomCollectif = "";
					}
					
					//confirmation qu'un artiste n'est pas dans la BD et ajout si necessaire
					
					$ilExiste = $this->verifierArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
					if(!$ilExiste){
						
						$this->inclureArtiste($artiste->Nom,$artiste->Prenom,$artiste->NomCollectif);
					}
				}
				//fin traitement des artistes
				
				
				
				
				//*** traitement des arrondissements
				
				//echo $i." - ".$jsonSite[$i]->Arrondissement ."<br>";
				
				//confirmation qu'un arrondissement n'est pas dans la BD et ajout si necessaire
					
				$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement);
				if(!$ilExiste){
					
					$this->inclureArrondissement($jsonSite[$i]->Arrondissement);
				}
				
				
			}
			
		}
		
		private function verifierArtiste($nom,$prenom,$collectif)
		{
			
			$oArtistes = new Artistes();
			$data = $oArtistes->obtenirArtiste($nom,$prenom,$collectif);
			return $data;
			
		}
		
		private function inclureArtiste($nom,$prenom,$collectif)
		{
			
			$oArtistes = new Artistes();
			$data = $oArtistes->insererArtiste($nom,$prenom,$collectif);
			
		}
		
		private function verifierArrondissement($arrondissement)
		{
			
			$oArrondissements = new Arrondissements();
			$data = $oArrondissements->obtenirArrondissement($arrondissement);
			return $data;
			
		}
		
		private function inclureArrondissement($arrondissement)
		{
			
			$oArrondissements = new Arrondissements();
			$data = $oArrondissements->insererArrondissement($arrondissement);
			
		}
}
?>















