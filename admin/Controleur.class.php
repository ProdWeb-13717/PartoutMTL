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
			
			$nomOeuvres = count($jsonSite);
			
			for($i=0;$i<$nomOeuvres;$i++){// for pour parcourir tout les oeuvres
				
				//***traitement des artistes***
				
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
				
				
				//confirmation qu'un arrondissement n'est pas dans la BD et ajout si necessaire
					
				$ilExiste = $this->verifierArrondissement($jsonSite[$i]->Arrondissement);
				if(!$ilExiste){
					
					$this->inclureArrondissement($jsonSite[$i]->Arrondissement);
				}
				//fin traitement des arrondissements
				
				
				//*** traitement des categories
				
				//echo $jsonSite[$i]->SousCategorieObjet;
				//echo "<br>";
				
				
				//confirmation qu'une categorie n'est pas dans la BD et ajout si necessaire
					
				$ilExiste = $this->verifierCategorie($jsonSite[$i]->SousCategorieObjet);
				if(!$ilExiste){
					
					$this->inclureCategorie($jsonSite[$i]->SousCategorieObjet);
				}
				
				
				//fin traitement des categories
				
				
				
				//*** traitement des oeuvres
				
				//echo $jsonSite[$i]->SousCategorieObjet;
				//echo "<br>";
				
				
				//confirmation qu'une categorie n'est pas dans la BD et ajout si necessaire
					
				/*echo $jsonSite[$i]->Titre;
				echo " - ";
				echo $jsonSite[$i]->TitreVariante;
				echo " - ";*/
				echo $jsonSite[$i]->NumeroAccession;
				echo "<br>";
				
				
				//fin traitement des oeuvres
				
				
				
				
				
				
			}
			
		}
		//***** functions par rapport à des traitement des artistes
		
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
		
		
		//***** functions par rapport à des traitement des arrondissements
		
		
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
		
		//***** functions par rapport à des traitement des categories
		
		
		private function verifierCategorie($categorie)
		{
			
			$oCategorie = new Categories();
			$data = $oCategorie->obtenirCategorie($categorie);
			return $data;
			
		}
		
		private function inclureCategorie($categorie)
		{
			
			$oCategorie = new Categories();
			$data = $oCategorie->insererCategorie($categorie);
			
		}
		
		
}
?>















