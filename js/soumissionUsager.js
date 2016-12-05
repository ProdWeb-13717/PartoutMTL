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
     
        if(document.querySelector(".soumissionUsager"))                                     // si la classe "soumissionAdmin" existe
        { 
            var btnSoumettre = document.querySelector("#boutonSoumission");                 // récupère le bouton SOUMETTRE
                btnSoumettre.addEventListener("click", function(evt){                       // à l'événement CLIC   
                    
                if(validationSoumission()){                                                 // valide certaines entrées, si valide
                    
                    /*-- RÉCUPÈRE LES ENTRÉES DE LA TABLE SOUMISSION ------------------------------*/
                    var valeurTitre             = document.querySelector("[name=titreOeuvreSoumission]").value;
                    var valeurPrenomArtiste     = document.querySelector("[name=prenomArtisteOeuvreSoumission]").value;
                    var valeurNomArtiste        = document.querySelector("[name=nomArtisteOeuvreSoumission]").value;
                    var valeurCollectif         = document.querySelector("[name=collectifOeuvreSoumission]").value;
                    var valeurArrondissement    = document.querySelector("[name=arrondissementOeuvreSoumission]").value;
                    if(valeurArrondissement == "#"){                                        // si l'usager n'a rien sélectionné
                        valeurArrondissement = null;                                        // sa valeur est null
                    }
                    var valeurParc              = document.querySelector("[name=parcOeuvreSoumission]").value;
                    var valeurAdresseCivique    = document.querySelector("[name=adresseCiviqueOeuvreSoumission]").value;
                    var valeurDescription       = document.querySelector("[name=descriptionOeuvreSoumission]").value;
                    var valeurPhoto             = document.querySelector("[name=photoOeuvreSoumission]").value;
                    var valeurCourriel          = document.querySelector("[name=courrielOeuvreSoumission]").value;
                
                    /*-- LES ENTRÉES DANS UN JSON TRADUIT EN STRING -------------------------------*/
                    var data = JSON.stringify({titreSoumission             : valeurTitre, 
                                               prenomArtisteSoumission     : valeurPrenomArtiste,
                                               nomArtisteSoumission        : valeurNomArtiste,
                                               collectifSoumission         : valeurCollectif,
                                               idArrondissementSoumission  : valeurArrondissement,
                                               parcSoumission              : valeurParc,
                                               adresseCiviqueSoumission    : valeurAdresseCivique,
                                               descriptionSoumission       : valeurDescription,
                                               photoSoumission             : valeurPhoto,
                                               courrielSoumission          : valeurCourriel});
                    console.log(data);                   
                    
                    /*-- REQUÊTE AJAX -------------------------------------------------------------*/
                    var xhr = new XMLHttpRequest();                                         // nouvelle requête
                    
                    xhr.open("POST", "index.php?requete=insereSoumissionUsager")            // controleur case "requete" = "insereSoumissionUsager"
                    xhr.setRequestHeader("Content-type", "application/json");
                    
                    xhr.addEventListener("load", function(e){
                        console.log(e.currentTarget);
                        console.log(e.currentTarget.responseText);
                        //window.location.href = "./index.php?requete=afficheSoumission";
                        document.querySelector(".soumissionUsager").innerHTML = e.currentTarget.responseText;                 
                    });
                    xhr.send(data);                                                         // envoie la requête et les datas en POST    
                }
                else                                                                        // sinon, message de champs invalides
                {
                    document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez remplir correctement les champs";
                }  
            });
        }  
    });
    
    function validationSoumission(){
        
        /*-- BOOLÉEN, VALIDE OU NON ---------------------------------------------------*/
        var valide= true;
        
        /*-- RÉCUPÈRE LES ENTRÉES À VALIDER -------------------------------------------*/
        var valeurTitre     = document.querySelector("[name=titreOeuvreSoumission]").value;
        var valeurCourriel  = document.querySelector("[name=courrielOeuvreSoumission]").value;
        
        /*-- REGEX --------------------------------------------------------------------*/
        // source : https://www.google.ca/webhp?sourceid=chrome-instant&ion=1&espv=2&ie=UTF-8#q=email%20regular%20expression
        var courrielRegex   = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        
        /*-- REINITIALISE LA COULEUR DES TITRES DES INPUTS ----------------------------*/
        var couleurErreur   = document.querySelectorAll(".couleurErreurSoumission");
        for (i = 0; i < couleurErreur.length; i++) {    
            couleurErreur[i].style.color= "black";        //"#016737";
        }
        
        /*-- VÉRIFICATIONS ------------------------------------------------------------*/
        
        if(valeurTitre == ""){                                                              // y'a t-il un titre ?
            valide= false;                                                                  // si non
            couleurErreur[0].style.color= "brown";                                          // le titre du input est rouge
        }
        
        if(valeurCourriel == ""){                                                           // y'a t-il un courriel ?
            valide= false;                                                                  // si non
            couleurErreur[1].style.color= "brown";     
        }
        
        if(!courrielRegex.exec(valeurCourriel)){                                            // respecte t'elle la regex, si non ?
                valide= false;
                couleurErreur[1].style.color= "brown";                                      // le titre du input est rouge
            }
        
        /*-- BOOLÉEN, VALIDE OU NON ---------------------------------------------------*/
        if (valide){
            return true;
        }
        else{
            return false;
        }
    }
})();