var urlrecherche = window.location.toString(); //prendre URL  
	if (urlrecherche.indexOf("?") > 0) {
		var urlrecherche = urlrecherche.substring(0, urlrecherche.indexOf("?"));
		console.log(urlrecherche);
	}
(function(){ 
    window.addEventListener("load", function()
                            {
        Recherche();
    });
    
    function Recherche(){  
        var btnRecherche = document.getElementById("btnRecherche");                         //bouton de submit dans la recherche simple
        var motRecherche = document.getElementById("motRecherche");                         //le mot recherché 
        var oeuvres = document.getElementById("oeuvres");                                   // prendre le titre de vue 'liste oeuvres' dans la recherche simple sur les oeuvres
        var artistes = document.getElementById("artistes");                                 // prendre le titre de vue 'liste artistes' dans la recherche simple sur les artistes
        var acceuil = document.getElementById("carousel");                                  // prendre la vue 'carousel' dans la recherche simple pour afficher la resultat de recherche pour la page d'accueil
        
        if(btnRecherche || motRecherche)
        { // la recherche simple
            
            motRecherche.onkeydown  = function(ev){ // Si on enter dans input de recherche
				
				
				ev = ev || window.event;
				console.log("Keydown");
				
				if (ev.keyCode == 13) {
					ev.preventDefault();
					console.log("Enter");
					btnRecherche.click();
				}					
			};
			btnRecherche.onclick = function(){
                
                if(oeuvres)
                {
                    if(motRecherche.value!="")
                    {                                     				//rechecher dans la liste des oeuves
                        rechercheSimple("oeuvres");
                        console.log("oeuvres");
                    }
                }
                else if(artistes)
                {                     									//rechecher dans la liste des artistes
                    if(motRecherche.value!="")
                    {
                        console.log("artistes");
                        rechercheSimple("artistes");
                    }
                }
                else if(acceuil)
                {                   								    //rechecher dans les lites artistes et oeuvres dans la page d'accueil
                    if(motRecherche.value!="")
                    {
                        console.log("acceuil");
                        rechercheSimple("acceuil");
                    }
                }
            };
			
        }
        
        
    }
    
    
    function rechercheSimple(categorieDeRecherche){ // function de recherche simple *********************************************
        
        //déclaration de l'objet XMLHttpRequest
        var xhr;
        xhr = new XMLHttpRequest();
        
        var valueRecherche=document.getElementById("motRecherche");
        
        if(xhr)
        {	
            if(valueRecherche.value!= "")
            {
                
                //obtenir le nom du fichier à aller chercher.
                var txtRecherche = encodeURIComponent(valueRecherche.value);
                
                if(categorieDeRecherche=="oeuvres"){ //******************************* Juste cette partie est utilisé pour Admin
                    
                    console.log("categorieDeRecherche : "+categorieDeRecherche)
                    
                    params = "requete=rechercheOeuvreAdmin&valRecherche=" + txtRecherche;
                    xhr.open("GET", urlrecherche+"?"+params, true);
                }
                //2ème étape - spécifier la fonction de callback
                xhr.addEventListener("readystatechange", function()
                                    {
                    
                    if(xhr.readyState === 4)
                    {
                        if(xhr.status === 200)
                        {
                            //les données ont été reçues
                            document.querySelector("body").innerHTML = xhr.responseText;
                            Recherche();
                            
                        }
                        else if(xhr.status === 404)
                        {
                            //la page demandée n'existe pas
                            document.getElementById("boiteRecherche").innerHTML ="Ce titre n'existe pas";
                        }
                    }
                });
                //3ème étape - envoi de la requête
                xhr.send();
            }
        }
    }
    

})();

