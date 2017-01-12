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
     
        /*-- SECTION GESTION CATÉGORIE ------------------------------------------------------------*/
        if(document.querySelector(".categorie"))                                            // si la classe "categorie" existe
        { 
            /*-- AJOUT D'UNE CATÉGORIE ------------------------------------------------------------*/
            var btnAjout = document.querySelector("#boutonAjoutCategorie");                 // récupère le bouton AJOUTER
            btnAjout.addEventListener("click", function(evt){                               // à l'événement CLIC
                
                /*-- RÉCUPÈRE L'ENTRÉE DU CHAMPS CATÉGORIE ----------------------------------------*/
                var valeurCategorie = document.querySelector("[name=categorieAjout]").value;
                
                if(valeurCategorie != ""){                                                  // s'il y a entrée dans le champs
                    
                    evt.target.disabled=true;                                               // il n'y a plus d'évènements au click
                
                    /*-- LES ENTRÉES DANS UN JSON TRADUIT EN STRING -------------------------------*/
                    var data = JSON.stringify({categorie : valeurCategorie});
                    
                    /*-- REQUÊTE AJAX -------------------------------------------------------------*/
                    var xhr = new XMLHttpRequest();                                         // nouvelle requête
                    
                    xhr.open("POST", "index.php?requete=ajoutCategorie")                    // controleur case "requete" = "ajoutCategorie"
                    xhr.setRequestHeader("Content-type", "application/json");
                    
                    xhr.addEventListener("load", function(e){
                        console.log(e.currentTarget);
                        console.log(e.currentTarget.responseText);
                        window.location.href = "./index.php?requete=gestionCategorie";                
                    });
                    xhr.send(data);                                                         // envoie la requête et les datas en POST
                } 
                else                                                                        // sinon, message de champs invalides
                {
                    document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez remplir le champs";
                }
            });
            
            /*-- SUPPRESSION D'UNE CATÉGORIE ------------------------------------------------------*/
            var btnAjout = document.querySelector("#boutonSuppressionCategorie");           // récupère le bouton SUPPRIMER
            btnAjout.addEventListener("click", function(evt){                               // à l'événement CLIC
                
                /*-- RÉCUPÈRE L'ENTRÉE DU CHAMPS CATÉGORIE ----------------------------------------*/
                var valeurSelectCategorie = document.querySelector("[name=categorieSuppression]").value;
                console.log(valeurSelectCategorie);
                
                if(valeurSelectCategorie != "#"){
                    /*-- LES ENTRÉES DANS UN JSON TRADUIT EN STRING -------------------------------*/
                    var data = JSON.stringify({categorie : valeurSelectCategorie});
                    
                    /*-- REQUÊTE AJAX -------------------------------------------------------------*/
                    var xhr = new XMLHttpRequest();                                         // nouvelle requête
                    
                    xhr.open("POST", "index.php?requete=supprimerCategorie")                // controleur case "requete" = "supprimerCategorie"
                    xhr.setRequestHeader("Content-type", "application/json");
                    
                    xhr.addEventListener("load", function(e){
                        console.log(e.currentTarget);
                        console.log(e.currentTarget.responseText);
                        window.location.href = "./index.php?requete=gestionCategorie";                
                    });
                    xhr.send(data);                                                         // envoie la requête et les datas en POST
                }
                else                                                                        // sinon, message de champs invalides
                {
                    document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez choisir une catégorie";
                }
            });
       
            
            
        } 
    });
})();
    