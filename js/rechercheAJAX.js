window.addEventListener("load", function()
{
	
	//window.onload= Recherche();
	Recherche();
		
	
});

function Recherche(){
	
	var elmRecherche = document.getElementById("rechercheOeuvre");
	
	
	elmRecherche.onkeyup = function(){
		
		
		document.getElementById("boiteRecherche").innerHTML = '';
	
		if(elmRecherche.value!=""){
			document.getElementById("boiteRecherche").innerHTML = '';
			rechercheOeuvre();
		}
		else{
			rechercheOeuvre();
		}
	};

}


function rechercheOeuvre(){
	
	//déclaration de l'objet XMLHttpRequest
	var xhr;
	xhr = new XMLHttpRequest();
	
	var valueRecherche=document.getElementById("rechercheOeuvre");
	
	if(xhr)
	{	
	    
		
		if(valueRecherche.value!= "")
		{
			
			//obtenir le nom du fichier à aller chercher.
			var txtRecherche = encodeURIComponent(valueRecherche.value);
			
			xhr.open("GET", "http://localhost:8080/PartoutMTL/index.php?requete=txtRecherche&valRecherche=" + txtRecherche);
			
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
						var tabDonnees = JSON.parse(xhr.responseText);
						
						
						for(var i = 0; i < tabDonnees.length; i++)
						{
							var liste = document.createElement("ul");
							liste.classList.add("elemListe");
							
							//--------------ID d'oeuvre
							var liID = document.createElement("li");
							var spanId =  document.createElement("span");
							spanId.innerHTML = 'ID :';
							spanId.classList.add("catElemListe");
							liID.appendChild(spanId);
							
							var spanIdN =  document.createElement("span");
							spanIdN.classList.add("catElemListeRecherche");
							spanIdN.innerHTML = tabDonnees[i].idOeuvre;
							liID.appendChild(spanIdN);
							
							liste.appendChild(liID);
							
							
							//--------------titre d'oeuvre
							var liTitre = document.createElement("li");
							var spanTitre =  document.createElement("span");
							spanTitre.innerHTML = 'Titre :';
							spanTitre.classList.add("catElemListe");
							liTitre.appendChild(spanTitre);
							
							var spanTitreN =  document.createElement("span");
							spanTitreN.classList.add("catElemListeRecherche");
							spanTitreN.innerHTML = tabDonnees[i].titre;
							liTitre.appendChild(spanTitreN);
							liTitre.classList.add("liRecherche");
							liste.appendChild(liTitre);
							
							
							document.getElementById("boiteRecherche").appendChild(liste);
						}						
						
						
						
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

