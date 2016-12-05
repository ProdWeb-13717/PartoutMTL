window.addEventListener("load", function()
{
	
	
	Recherche();
		
	
});

function Recherche(){
	
	
	var btnRecherche = document.getElementById("btnRecherche");
	var motRecherche = document.getElementById("motRecherche"); //rechercheOeuvre 
	var categorieRecherche = document.getElementById("categorieRecherche"); 
	var souscategorieRecherche = document.getElementById("souscategorieRecherche"); 
	var oeuvres = document.getElementById("oeuvres"); 
	var artistes = document.getElementById("artistes"); 
	var acceuil = document.getElementById("menuAcceuil"); 
	var msgResultat = document.getElementById("msgResultat"); 
	var msg="";
	

	/*
	motRecherche.onclick = function(){
		if(categorieRecherche.value=="" || souscategorieRecherche.value==""){
			alert("Séléctionner un catégorie et sous-catégorie avant");
		}
		
	}
	
	categorieRecherche.onchange = function(){
		
		if(categorieRecherche.value=="Oeuvres"){
			souscategorieRecherche.disabled = false;
		}else if(categorieRecherche.value=="Artistes"){
			//---------------------- pour sprint 2
			souscategorieRecherche.value=""
			souscategorieRecherche.disabled = true;
		}else{
			souscategorieRecherche.value=""
			souscategorieRecherche.disabled = true;
			
		}
		
	}
	*/
	btnRecherche.onclick = function(){
		
		if(oeuvres){
			if(motRecherche.value!=""){
				motRechercheF("oeuvres");
				console.log("oeuvres");
			}
		}
		else if(artistes){
			if(motRecherche.value!=""){
				console.log("artistes");
				motRechercheF("artistes");
			}
		}
		else if(acceuil){
			if(motRecherche.value!=""){
				console.log("acceuil");
				motRechercheF("acceuil");
			}
		}
		
	};

}


function motRechercheF(categorieDeRecherche){
	
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
			
			if(categorieDeRecherche=="oeuvres"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost:8080/PartoutMTL/index.php?requete=rechercheOeuvre&valRecherche=" + txtRecherche);
				msg ='dans la liste des oeuvres';
			}
			else if(categorieDeRecherche=="artistes"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost:8080/PartoutMTL/index.php?requete=rechercheArtistes&valRecherche=" + txtRecherche);
				msg ='dans la liste des aristes';
			}
			else if(categorieDeRecherche=="acceuil"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost:8080/PartoutMTL/index.php?requete=rechercheAcceuil&valRecherche=" + txtRecherche);
				msg ='dans les listes des artistes et des oeuvres';
			}
			
			
			//2ème étape - spécifier la fonction de callback
			xhr.addEventListener("readystatechange", function()
			{
				
				//var imgload = $("#imgload");
				//imgload.show();
				
				if(xhr.readyState === 4)
				{
						
					if(xhr.status === 200)
					{
						//les données ont été reçues
						
						document.querySelector("body").innerHTML = xhr.responseText;
						if(msgResultat.value!=""){
							msgResultat.innerHTML ="";
						}
						msgResultat.innerHTML ='La la résultat de recherche '+msg+' pour "'+txtRecherche+' ":';
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

