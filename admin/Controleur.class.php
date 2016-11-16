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
        $this->afficheVue("head");
        
        switch ($_GET['requete']) 
        {
			case 'accueil':
				$this->accueil();                                                          // option quand get requete est accueil
				break;
				
			case 'formAutentificationAdmin':
				$vue = 'FormAutentificationAdmin';
				$this->afficheVue($vue);
				break;
				
			case 'AutentificationAdmin':
				$admin = new Admin();
				$resulta = $admin->verificationAutentificationAdmin();
				if($resulta)
				{
					unset($_POST['usager']);
					unset($_POST['pass']);
				}
				
				$_GET['requete'] = "accueil";
				
				if($resulta == false)
				{
					$vue = 'FormAutentificationAdmin';
					$this->afficheVue($vue);
				}
				else
				{
					$this->accueil();
				}
				break;
				
			case 'deconnectionAdmin':
				session_unset();
				$this->accueil();  	
				break;
				
			case 'importation':
				$vue = "enteteAdmin";
				$this->afficheVue($vue);
				$this->importation();                                                      
				break;
				
			case 'importationok':
			
				$vue = "enteteAdmin";
				$this->afficheVue($vue);
				$publicJson = $this->obtenirJSON();//cet variable contienne les donnes en format JSON
				$this->traiterDonnees($publicJson);//parce qu'on envoi des donnees il n'est pas neccessaire de retourner quelque chose
				$this->importationok();                                                    
				break;
				
				
            case 'soumission':// page formulaire de soumission administrateur
                //$this->soumissionAdmin();
				
				$this->afficherEnteteAdmin();

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
	

		/**
		 * Traite la requête
		 * @return void
		 */
		
		/*private function accueil()
		{
			$oVue = new Vueimportation();
			
			$oVue->afficheEntete();
			$oVue->afficheAccueil();
			$oVue->affichePied();
		}*/
		// Placer les méthodes du controleur.
		private function importation()
		{
			$oVue = new Vueimportation();
			
			$oVue->afficheEntete();
			$oVue->afficheformImportation();
			$oVue->affichePied();
		}
		
	public function afficherFormAutentificationAdmin()
	{
		$vue = "boutonSoumission";
        $this->afficheVue($vue);
		
		
	}
	
	protected function afficherEnteteAdmin()
	{
        $this->afficheVue("enteteAdmin");
        $this->afficheVue("boutonDeconnectionAdmin");
		
	}
    
	
	
    private function accueil()
    {

		if(!isset($_SESSION['authentifie']))
		{
			$vue = 'FormAutentificationAdmin';
			$this->afficheVue($vue);
		}
		else
		{
			$this->afficherEnteteAdmin();
		}

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
			
			for($i=0;$i<=14;$i++)// for pour parcourir tout les oeuvres
			{
				
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
				
				$ilExiste = $this->verifierOeuvre($jsonSite[$i]->NoInterne);
				if(!$ilExiste){
					//echo $i+1 ." ";
					$this->inclureOeuvre($jsonSite[$i]);
					//echo "paila no esta";
					//echo "<br>";
				}
				
				
				//echo $jsonSite[$i]->SousCategorieObjet;
				//echo "<br>";
				
				
				//confirmation qu'une categorie n'est pas dans la BD et ajout si necessaire
					
				/*echo $jsonSite[$i]->Titre;
				echo " - ";
				echo $jsonSite[$i]->TitreVariante;
				echo " - ";*/
				//echo $jsonSite[$i]->NumeroAccession;
				//echo "<br>";
				
				
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
		
		//***** functions par rapport à des traitement des oeuvres
		
		private function verifierOeuvre($noInterne)
		{
			
			$oOeuvre = new Oeuvres();
			$data = $oOeuvre->obtenirOeuvre($noInterne);
			return $data;
			
		}
		
		private function inclureOeuvre($oeuvre)
		{
			
			$oOeuvres = new Oeuvres();
			$data = $oOeuvres->traiterOeuvre($oeuvre);
			
		}
		

}
?>















