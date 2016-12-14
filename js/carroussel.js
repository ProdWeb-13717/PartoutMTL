//Script pour faire changer l'image du carroussel

window.addEventListener("load", function()
{
	//on établie les variable nécessaire au carroussel
	console.log("On lance le carroussel");							
	var toutURL = document.getElementById("toutURL").value;				//on vas chercher le strin conenant les url d'images
	var toutTitre = document.getElementById("toutTitre").value;			//on vas chercher le strin conenant les titres d'images
	var toutDescr = document.getElementById("toutDescr").value;			//on vas chercher le strin conenant les descriptions d'images
	//console.log(toutURL);
	
	//on split les strings sur le caractère ~ pour en faire des tableaux
	var toutURL = toutURL.split('~');
	var toutTitre = toutTitre.split('~');
	var toutDescr = toutDescr.split('~');
	//console.log(toutURL);
	
	//taille des tableaux
	var taille = toutURL.length;
	
	//console.log(taille);
	
	//on initialise le compteur et l'image de départ de carroussel
	var compteurCar = 0;
	var divCarousel = document.getElementById("carousel");
	
	divCarousel.style.backgroundImage = 'url('+toutURL[0]+')';
	document.getElementById("descrCar").innerHTML = toutTitre[0]+" "+toutDescr[0];

	//fonction qui change l'image à toutes les 3 secondes
	setInterval(function()
	{
		console.log("On change la photo");
		
		//si on est pas encore à la fin du tableaux, on avance dedans, sinon on retourne au début
		if(((compteurCar + 1)%taille) != 0)
		{
			console.log(compteurCar +" on monte");
			divCarousel.style.backgroundImage = 'url('+toutURL[compteurCar]+')';
			
			document.getElementById("descrCar").innerHTML = toutTitre[compteurCar]+" "+toutDescr[compteurCar];
			
			compteurCar ++;
		}
		else if(((compteurCar + 1)%taille) == 0)
		{
			console.log(compteurCar +" on recommence");
			divCarousel.style.backgroundImage = 'url('+toutURL[compteurCar]+')';
			
			document.getElementById("descrCar").innerHTML = toutTitre[compteurCar]+" "+toutDescr[compteurCar];
			
			compteurCar  = 0;
		}
	}, 3000);
});