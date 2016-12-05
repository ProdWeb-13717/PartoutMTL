/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jonathmartel@gmail.com)
 * @version 1
 * @update 2013-12-11
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 *
 */

//IIFE
(function(){
    
    window.addEventListener("load", function(){                                             // au chargement de la page
     
        if(document.querySelector(".afficheSoumissionsUsagers"))                            // 
        { 
            var btnSoumissionAAjouter = document.querySelectorAll (".boutonAjouterSoumissionUsager"); // récupère les boutons SOUMETTRE   
            console.log(btnSoumissionAAjouter);
            console.log(btnSoumissionAAjouter.length);
            for (i = 0; i <= btnSoumissionAAjouter.length; i++){
                console.log(i);
                btnSoumissionAAjouter[i].addEventListener("click", function(evt){                      // à l'événement CLIC
                    console.log(document.querySelector("[name=soumissionDunUsager]").value);
                    console.log(btnSoumissionAAjouter[i].value);
                });   
            }
            //btnSoumissionAAjouter.addEventListener("click", function(evt){                      // à l'événement CLIC
                
            //var btnSoumissionAAjouter = document.getElementsByClassName("boutonAjouterSoumissionUsager");
            //console.log(btnSoumissionAAjouter);
            //btnSoumissionAAjouter.addEventListener("click", function(evt){
                
                
            //});    
                    
            
            
            
            
            
            
            
            
            
                //var valeurIdSoumissionUsager = document.querySelector("[name=soumissionDunUsager]").value;
                //console.log(valeurIdSoumissionUsager);
                
                /*
                if(validationSoumission()){                                                 // valide certaines entrées, si valide
                    
                    /*-- RÉCUPÈRE LES ENTRÉES DE LA TABLE OEUVRES ----------------------------------
                    var valeurTitre             = document.querySelector("[name=titreOeuvreAjout]").value;
                    var valeurTitreVariante     = document.querySelector("[name=titreVarianteOeuvreAjout]").value;
                    var valeurDateFinProduction = document.querySelector("[name=dateFinProductionOeuvreAjout]").value;
                    if(valeurDateFinProduction == ""){                                      // si l'entrée date fin de production est vide
                        valeurDateFinProduction = null;                                     // sa valeur est null
                    }
                    var valeurDateAccession         = document.querySelector("[name=dateAccessionOeuvreAjout]").value;
                    if(valeurDateAccession == ""){                                          // si l'entrée date d'accession est vide
                        valeurDateAccession = null;                                         // sa valeur est null
                    }
                    var valeurCollection        = document.querySelector("[name=collectionOeuvreAjout]").value;
                    var valeurModeAcquisition   = document.querySelector("[name=modeAcquisitionOeuvreAjout]").value;
                    var valeurMateriaux         = document.querySelector("[name=materiauxOeuvreAjout]").value;
                    var valeurTechnique         = document.querySelector("[name=techniqueOeuvreAjout]").value;
                    var valeurDimensions        = document.querySelector("[name=dimensionsOeuvreAjout]").value;
                    var valeurParc              = document.querySelector("[name=parcOeuvreAjout]").value;
                    var valeurBatiment          = document.querySelector("[name=batimentOeuvreAjout]").value;
                    var valeurAdresseCivique    = document.querySelector("[name=adresseCiviqueOeuvreAjout]").value;
                    var valeurLatitude          = document.querySelector("[name=latitudeOeuvreAjout]").value;
                    if(valeurLatitude == ""){                                               // si l'entrée latitude est vide
                        valeurLatitude = null;                                              // sa valeur est null
                    }
                    var valeurLongitude         = document.querySelector("[name=longitudeOeuvreAjout]").value;
                    if(valeurLongitude == ""){                                              // si l'entrée longitude est vide
                        valeurLongitude = null;                                             // sa valeur est null
                    }
                    var valeurDescription       = document.querySelector("[name=descriptionOeuvreAjout]").value;
                    
                    /*-- RÉCUPÈRE LES ENTRÉES DE LA TABLE ARTISTES --------------------------------
                    var valeurPrenomArtiste     = document.querySelector("[name=prenomArtisteOeuvreAjout]").value;
                    var valeurNomArtiste        = document.querySelector("[name=nomArtisteOeuvreAjout]").value;
                    var valeurCollectif         = document.querySelector("[name=collectifOeuvreAjout]").value;
                    
                    /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE CATÉGORIES ---------------------------------
                    var valeurCategorie         = document.querySelector("[name=categorieOeuvreAjout]").value;
                    if(valeurCategorie == "#"){                                             // si l'administrateur n'a rien sélectionné
                        valeurCategorie = null;                                             // sa valeur est null
                    }
                    
                    /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE ARRONDISSEMENTS ----------------------------
                    var valeurArrondissement    = document.querySelector("[name=arrondissementOeuvreAjout]").value;
                    if(valeurArrondissement == "#"){                                        // si l'administrateur n'a rien sélectionné
                        valeurArrondissement = null;                                        // sa valeur est null
                    }
                    
                    /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE PHOTOS -------------------------------------
                    var valeurUrlPhoto          = document.querySelector("[name=urlPhotoOeuvreAjout]").value;
                
                    /*-- LES ENTRÉES DANS UN JSON TRADUIT EN STRING -------------------------------
                    var data = JSON.stringify({titre             : valeurTitre, 
                                               titreVariante     : valeurTitreVariante,  
                                               prenomArtiste     : valeurPrenomArtiste,
                                               nomArtiste        : valeurNomArtiste,
                                               collectif         : valeurCollectif,
                                               idCategorie       : valeurCategorie,
                                               dateFinProduction : valeurDateFinProduction,
                                               nomCollection     : valeurCollection,
                                               modeAcquisition   : valeurModeAcquisition,
                                               dateAccession     : valeurDateAccession,
                                               materiaux         : valeurMateriaux,
                                               technique         : valeurTechnique,
                                               dimensions        : valeurDimensions,
                                               idArrondissement  : valeurArrondissement,
                                               parc              : valeurParc,
                                               batiment          : valeurBatiment,
                                               adresseCivique    : valeurAdresseCivique,
                                               latitude          : valeurLatitude,
                                               longitude         : valeurLongitude,
                                               urlPhoto          : valeurUrlPhoto,
                                               description       : valeurDescription});
                    //console.log(data);
                    
                    /*-- REQUÊTE AJAX -------------------------------------------------------------
                    var xhr = new XMLHttpRequest();                                         // nouvelle requête
                    
                    xhr.open("POST", "index.php?requete=insereSoumission")                  // controleur case "requete" = "insereSoumission"
                    xhr.setRequestHeader("Content-type", "application/json");
                    
                    xhr.addEventListener("load", function(e){
                        console.log(e.currentTarget);
                        console.log(e.currentTarget.responseText);
                        //window.location.href = "./index.php?requete=afficheSoumission";
                        document.querySelector(".soumissionAdmin").innerHTML = e.currentTarget.responseText;                 
                    });
                    xhr.send(data);                                                         // envoie la requête et les datas en POST
                    
                }
                else                                                                        // sinon, message de champs invalides
                {
                    document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez remplir correctement les champs";
                }  
            });*/
        }
        
        
    });
})();
    
