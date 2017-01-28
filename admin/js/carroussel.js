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
     
        if(document.querySelector("#boutonAjoutCarroussel"))
        { 
           document.querySelector("#boutonAjoutCarroussel").addEventListener("click", function(evt)
            {
               
               //valeur qui requeille les info du formulaire; ////////////////////////////////////
               var choix = document.getElementsByClassName("choixPhoto");
               
               for(var c=0;c < choix.length;c++)
               {
                   if(choix[c].checked)
                   {
                       var choixPhoto = choix[c].value;
                   }
               }
               
               /*-- REQUÊTE GET ----------------------------------------------------------------------*/
				
               if(choixPhoto != null)
               {
                   document.getElementById("carrousselAjoutForm").action = "index.php?requete=ajouterImageCarroussel&id=" + choixPhoto;
               }
            });  
        }
    })
})();
    
