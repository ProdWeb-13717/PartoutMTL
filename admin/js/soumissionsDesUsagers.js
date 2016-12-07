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
    
    window.addEventListener("load", function(){                                                 // au chargement de la page
     
        if(document.querySelector(".afficheSoumissionsUsagers"))                                // 
        { 
            document.querySelector(".afficheSoumissionsUsagers").addEventListener("click", function(evt)
            {
                //console.log(evt.target.firstChild.nextSibling.nodeValue);
                
                
                /*
                var valeurIdSoumission = evt.target.id;
                var data = JSON.stringify({idSoumission : valeurIdSoumission});
                console.log(data);
                 
                /*-- REQUÊTE AJAX -------------------------------------------------------------
                var xhr = new XMLHttpRequest();                                                 // nouvelle requête
                
                xhr.open("POST", "index.php?requete=supprimeSoumissionUsager")                  // controleur case "requete" = "supprimeSoumission"
                xhr.setRequestHeader("Content-type", "application/json");
                
                xhr.addEventListener("load", function(e){
                    //console.log(e.currentTarget);
                    //console.log(e.currentTarget.responseText);
                    window.location.href = "./index.php?requete=soumissionsDesUsagers";               
                });
                xhr.send(data); */                                                                // envoie la requête et les datas en POST
            });  
        }
    })
})();
    
