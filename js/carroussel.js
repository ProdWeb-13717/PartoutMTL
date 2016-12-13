window.addEventListener("load", function()
{
	console.log("On lance le carroussel");
	var toutURL = document.getElementById("toutURL").value;
	var toutTitre = document.getElementById("toutTitre").value;
	var toutDescr = document.getElementById("toutDescr").value;
	//console.log(toutURL);
	var toutURL = toutURL.split('~');
	var toutTitre = toutTitre.split('~');
	var toutDescr = toutDescr.split('~');
	//console.log(toutURL);
	var taille = toutURL.length;
	//console.log(taille);
	var compteurCar = 0;
	var divCarousel = document.getElementById("carousel");
	
	divCarousel.style.backgroundImage = 'url('+toutURL[0]+')';
	document.getElementById("descrCar").innerHTML = toutTitre[0]+" "+toutDescr[0];

	
	setInterval(function()
	{
		console.log("On change la photo");
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