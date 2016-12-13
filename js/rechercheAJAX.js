window.addEventListener("load", function()
{
	
	
	Recherche();
		
	
});

function Recherche(){ 
	
	
	var btnRecherche = document.getElementById("btnRecherche");                         //bouton de submit dans la recherche simple
	var btnRechercheAvance = document.getElementById("btnRechercheAvance");             //bouton de submit dans la recherche avancé
	var motRecherche = document.getElementById("motRecherche");                         //le mot recherché 
	var categorieRecherche = document.getElementById("categorieRecherche");             // la balise select de catégorie dans la recherche avancé
	var souscategorieRecherche = document.getElementById("souscategorieRecherche");     // la balise select de sou-catégorie dans la recherche avancé
	var labelSouCategorie = document.getElementById("labelSouCategorie");         		// la balise label pour sou-catégorie dans la recherche avancé
	var motRechercheAvance = document.getElementById("motRechercheAvance");         	// le mot recherché  dans la recherche avancé
	var oeuvres = document.getElementById("oeuvres");                                   // prendre le titre de vue 'liste oeuvres' dans la recherche simple sur les oeuvres
	var artistes = document.getElementById("artistes");                                 // prendre le titre de vue 'liste artistes' dans la recherche simple sur les artistes
	var acceuil = document.getElementById("menuAccueil");                               // prendre le titre de vue 'accueil' dans la recherche simple sur les oeuvres
	var msgResultat = document.getElementById("msgResultat");                           // la balise pour afficher un message pour la résultat de recherche
	var msg="";
	
	if(btnRecherche)
	{ // la recherche simple
		
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
	if(categorieRecherche)
	{ 															   // générer les options de souscategorieRecherche
		
		categorieRecherche.onchange = function(){
			
			console.log(categorieRecherche.value);
			
			if(categorieRecherche.value=="")
			{
				
				labelSouCategorie.style.display= "none";
				motRechercheAvance.disabled= true;
				
			}
			else
			{	
			
				labelSouCategorie.style.display= "";
				
				
				if(categorieRecherche.value=="Artistes"){
					
					motRechercheAvance.disabled= true;
					var length = souscategorieRecherche.options.length;
					console.log(length);
					
					if(length!=0)
					{ 											  // effacer les options de souscategorieRecherche
						souscategorieRecherche.innerHTML = "";
					}
					
					
					option0 = document.createElement("option");
					option0.value = "";
					option0.innerHTML = "Séléctioner";
					souscategorieRecherche.add(option0);
					
					option1 = document.createElement("option");
					option1.value = "nomArtiste";
					option1.innerHTML = "nom";
					souscategorieRecherche.add(option1);
					
					option2 = document.createElement("option");
					option2.value = "prenomArtiste";
					option2.innerHTML = "prénom";
					souscategorieRecherche.add(option2);
					
					option3 = document.createElement("option");
					option3.value = "idArtiste";
					option3.innerHTML = "id";
					souscategorieRecherche.add(option3);
					
				}
				else if(categorieRecherche.value=="Oeuvres")
				{
					
					motRechercheAvance.disabled= true;
					var length = souscategorieRecherche.options.length;
					console.log(length);
					
					if(length!=0)
					{ // effacer les options de souscategorieRecherche
						souscategorieRecherche.innerHTML = "";
					}
					
					
					option0 = document.createElement("option");
					option0.value = "";
					option0.innerHTML = "Séléctioner";
					souscategorieRecherche.add(option0);
					
					option1 = document.createElement("option"); 
					option1.value = "artiste";
					option1.innerHTML = "nom ou prénom d'artiste";
					souscategorieRecherche.add(option1);
					
					option2 = document.createElement("option");
					option2.value = "nomArrondissement";
					option2.innerHTML = "Arrondissement";
					souscategorieRecherche.add(option2);
					
					option3 = document.createElement("option");
					option3.value = "nomCategorie";
					option3.innerHTML = "nom de catégorie";
					souscategorieRecherche.add(option3);
					
					option4 = document.createElement("option");
					option4.value = "titre";
					option4.innerHTML = "titre";
					souscategorieRecherche.add(option4);
					
					option5 = document.createElement("option");
					option5.value = "dateFinProduction";
					option5.innerHTML = "date de fin production";
					souscategorieRecherche.add(option5);
					
					option6 = document.createElement("option");
					option6.value = "materiaux";
					option6.innerHTML = "materiaux";
					souscategorieRecherche.add(option6);
					
					option7 = document.createElement("option");
					option7.value = "technique";
					option7.innerHTML = "technique";
					souscategorieRecherche.add(option7);
					
					option7 = document.createElement("option");
					option7.value = "parc";
					option7.innerHTML = "parc";
					souscategorieRecherche.add(option7);
					
					option8 = document.createElement("option");
					option8.value = "batiment";
					option8.innerHTML = "batiment";
					souscategorieRecherche.add(option8);
					
					option9 = document.createElement("option");
					option9.value = "adresseCivique";
					option9.innerHTML = "adresse civique";
					souscategorieRecherche.add(option9);
					
				}
				souscategorieRecherche.onchange = function(){
					
					if(souscategorieRecherche.value!="")
					{ 
						motRechercheAvance.disabled= false;
					}else{
						motRechercheAvance.disabled= true;
					}
				};
				

			}
		}
	}
	if(btnRechercheAvance){ // la recherche avancé
		
		btnRechercheAvance.onclick = function(){
		
			if(motRechercheAvance.value!="")
			{
				
				console.log(motRechercheAvance.value);
				categorieDeRecherche = categorieRecherche.value;
				souCategorieDerecherche = souscategorieRecherche.value;
				motDeRecherche = motRechercheAvance.value;
				
				rechercheAvance(categorieDeRecherche, souCategorieDerecherche, motDeRecherche);
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
			
			if(categorieDeRecherche=="oeuvres"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost/PartoutMTL/index.php?requete=rechercheOeuvre&valRecherche=" + txtRecherche);
				msg ='dans la liste des oeuvres';
			}
			else if(categorieDeRecherche=="artistes"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost/PartoutMTL/index.php?requete=rechercheArtistes&valRecherche=" + txtRecherche);
				msg ='dans la liste des aristes';
			}
			else if(categorieDeRecherche=="acceuil"){
				console.log("categorieDeRecherche : "+categorieDeRecherche)
				xhr.open("GET", "http://localhost/PartoutMTL/index.php?requete=rechercheAccueil&valRecherche=" + txtRecherche);
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
						if(msgResultat.value!="")
						{
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


function rechercheAvance(categorieDeRecherche, souCategorieDerecherche, motDeRecherche){ // function de recherche avancé **********************************
	
	//déclaration de l'objet XMLHttpRequest
	var xhr;
	xhr = new XMLHttpRequest();
	
	
	
	if(xhr)
	{	
	    
		
		if(motDeRecherche.value!= "")
		{
			
			//obtenir le nom du fichier à aller chercher.
			var txtRecherche = encodeURIComponent(motDeRecherche);
			
			if(categorieDeRecherche=="Oeuvres"){
				
				if(souCategorieDerecherche=="artiste")
				{
					url = "http://localhost/PartoutMTL/index.php";
					params = "requete=rechercheAvanceArtistesOeuvres&valRecherche="+ txtRecherche;
					xhr.open("GET", url+"?"+params, true);
				}
				else if(souCategorieDerecherche=="nomArrondissement")
				{	
					url = "http://localhost/PartoutMTL/index.php";
					params = "requete=rechercheAvanceArtistesOeuvresArrondissements&valRecherche="+ txtRecherche;
					xhr.open("GET", url+"?"+params, true);
					
				}
				else if(souCategorieDerecherche=="nomCategorie")
				{
					url = "http://localhost/PartoutMTL/index.php";
					params = "requete=rechercheAvanceArtistesOeuvresCategories&valRecherche="+ txtRecherche;
					xhr.open("GET", url+"?"+params, true);
				}
				else
				{
					url = "http://localhost/PartoutMTL/index.php";
					params = "requete=rechercheAvanceOeuvres&valRecherche="+ txtRecherche+"&cleRecherche="+souCategorieDerecherche;
					xhr.open("GET", url+"?"+params, true);
				}
				
				msg = 'de '+souCategorieDerecherche+' dans la liste des oeuvres';
			}
			else if(categorieDeRecherche=="Artistes"){
				
				url = "http://localhost/PartoutMTL/index.php";
				params = "requete=rechercheAvanceArtistes&valRecherche="+ txtRecherche+"&cleRecherche="+souCategorieDerecherche;
				xhr.open("GET", url+"?"+params, true);
				msg = 'de '+souCategorieDerecherche+' dans la liste des aristes';
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
						if(msgResultat.value!="")
						{
							msgResultat.innerHTML ="";
						}
						msgResultat.innerHTML ='La la résultat de recherche avancé '+msg+' pour "'+txtRecherche+' ":';
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

