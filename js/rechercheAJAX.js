window.addEventListener("load", function()
{
	
	
	Recherche();
		
	
});

function Recherche(){
	
	
	var btnRecherche = document.getElementById("btnRecherche");
	var motRecherche = document.getElementById("motRecherche"); //rechercheOeuvre 
	var categorieRecherche = document.getElementById("categorieRecherche"); 
	var souscategorieRecherche = document.getElementById("souscategorieRecherche"); 
	
	
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
	
	btnRecherche.onclick = function(){
		
		if(motRecherche.value==""){
			alert("Séléctionner un catégorie et sous-catégorie et puis entrez un lettre ou le mot complét");
		}else{
			
			if(document.getElementById("boiteRecherche")){
				document.getElementById("boiteRecherche").innerHTML = '';
				
			}
			if(motRecherche.value!=""){
				if(document.getElementById("boiteRecherche")){
					document.getElementById("boiteRecherche").innerHTML = '';
					
				}
				
				motRechercheF();
			}
			else{
				
				motRechercheF();
			}
		}
	};

}


function motRechercheF(){
	
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
			
			xhr.open("GET", "http://localhost/PartoutMTL/index.php?requete=txtRecherche&valRecherche=" + txtRecherche);
			
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
						
						if(document.getElementById("pageAcceuil")){
							
							document.getElementById("pageAcceuil").removeAttribute("id");
							
						}
						
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

