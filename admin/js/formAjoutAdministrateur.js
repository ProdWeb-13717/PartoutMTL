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
     
        if(document.querySelector("#boutonAjoutAdmin"))                                // 
        { 
           document.querySelector("#boutonAjoutAdmin").addEventListener("click", function(evt)
            {
                //console.log(evt.target.firstChild.nextSibling.nodeValue);
				
				
			//valeur qui requeille les info du formulaire; ////////////////////////////////////
				var prenom 			= document.getElementById("AjoutAdminPrenom").value;
				var nom 			= document.getElementById("AjoutAdminNom").value;
				var nomUsager 		= document.getElementById("AjoutAdminUsager").value;
				var motPasse 		= document.getElementById("AjoutAdminPass").value;
				var courriel 		= document.getElementById("AjoutAdminCourriel").value;
				var niveauAdmins 	= document.getElementsByName("AjoutAdminNiveau");
				
				for(n in niveauAdmins)
				{
					if(niveauAdmins[n].checked)
					{
						var niveau = niveauAdmins[n].value;
						break;
					}
				}
			///////////////////////////////////////////////////////////////////////////////////
			
				if(((nomUsager != null && nomUsager != "") && (motPasse != null && motPasse != "")) && (courriel != null && courriel != ""))
				{
					var data = JSON.stringify	({
													prenomAdmin 	: prenom,
													nomAdmin 		: nom,
													nomUsagerAdmin 	: nomUsager,
													motPasseAdmin 	: motPasse,
													courrielAdmin 	: courriel,
													niveauAdmin		: niveau
												});
												
												
					console.log(data);
					 
					/*-- REQUÊTE AJAX -------------------------------------------------------------*/
					var xhr = new XMLHttpRequest();                                                 // nouvelle requête
					
					xhr.open("POST", "index.php?requete=ajoutAdministrateur")                       // controleur case "requete" = "supprimeSoumission"
					xhr.setRequestHeader("Content-type", "application/json");
					
					xhr.addEventListener("load", function(e){
						
						//console.log(e.currentTarget);
						//console.log(e.currentTarget.responseText);
						document.getElementById("AjoutAdminPrenom").value = "";
						document.getElementById("AjoutAdminNom").value = "";
						document.getElementById("AjoutAdminUsager").value = "";
						document.getElementById("AjoutAdminPass").value = "";
						document.getElementById("AjoutAdminCourriel").value = "";
						var niveauAdmins 	= document.getElementsByName("AjoutAdminNiveau");
						for(n in niveauAdmins)
						{
							if(niveauAdmins[n].value == 1)
							{
								var niveau = niveauAdmins[n].checked;
							}
						}
						
						
						
						window.location.href = "./index.php?requete=permissionAdmin";               
					});
					xhr.send(data);                                                        // envoie la requête et les datas en POST
				}
            });  
        
        }
    })
})();
    
