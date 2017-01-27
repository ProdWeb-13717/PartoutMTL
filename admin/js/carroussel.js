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
     
        if(document.querySelector("#boutonAjoutCarroussel"))                                // 
        { 
           document.querySelector("#boutonAjoutCarroussel").addEventListener("click", function(evt)
            {
				
                //console.log(evt.target.firstChild.nextSibling.nodeValue);
				
				
			//valeur qui requeille les info du formulaire; ////////////////////////////////////
				var choix = document.getElementsByClassName("choixPhoto");
				for(var c=0;c < choix.length;c++)
				{
					if(choix[c].checked)
					{
						var choixPhoto 		= choix[c].value;
					}
				}
				//console.log(lien);
			///////////////////////////////////////////////////////////////////////////////////
				if((titre != null && choixPhoto != null) /*&& titre != ""*/)
				{
					//document.getElementById("carrousselAjoutForm").value = true;
					document.getElementById("carrousselAjoutForm").action = "index.php?requete=ajouterImageCarroussel";
					//document.getElementById("carrousselAjoutForm").submit;
					// console.log(data);
					/*-- REQUÊTE AJAX -------------------------------------------------------------*/
	/*
				var titre 			= document.getElementById("carrousselAjoutTitre").value;
				var lienImage 		= "../images/photo_" + choixPhoto + ".jpg";
				var lien 			= "index.php?requete=afficheOeuvre&idOeuvre=" + choixPhoto;
				
					var data = JSON.stringify	({
													titre 		: titre,
													urlLien 	: lien,
													urlPhoto 	: lienImage
												});
					var xhr = new XMLHttpRequest();                                                 // nouvelle requête
					
					xhr.open("GET", "index.php?requete=ajouterImageCarroussel&titre=" + titre + "&idPhoto=" + choixPhoto) ;
					xhr.setRequestHeader();
					
					xhr.addEventListener("load", function(e){
						
						document.getElementById("carrousselAjoutTitre").value = "";
						window.location.href = "./index.php?requete=affichage";               
						
					});
					
					xhr.send();                                                        // envoie la requête et les datas en POST
						*/						
				}
            });  
        
        }
    })
})();
    
