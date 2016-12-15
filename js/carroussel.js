//Script pour faire changer l'image du carroussel
//IIFE
(function(){
    
    window.addEventListener("load", function(){
        
        if(document.getElementById("carousel"))                                                     // si la classe "carousel" existe
        { 
            //on établie les variable nécessaire au carroussel
            console.log("On lance le carroussel");							
            toutURL = document.getElementById("toutURL").value;				//on va chercher la string contenant les url d'images
            toutTitre = document.getElementById("toutTitre").value;			//on va chercher la string contenant les titres d'images
            toutDescr = document.getElementById("toutDescr").value;			//on va chercher la string contenant les descriptions d'images
            
            //on split les strings sur le caractère ~ pour en faire des tableaux
            toutURL = toutURL.split('~');
            toutTitre = toutTitre.split('~');
            toutDescr = toutDescr.split('~');
            
            //taille des tableaux
            taille = toutURL.length;
            
            //on initialise le compteur et l'image de départ de carroussel
            compteurCar = 0;
            divCarousel = document.getElementById("carousel");
            
            divCarousel.style.backgroundImage = 'url('+toutURL[0]+')';
            document.getElementById("descrCar").innerHTML = toutTitre[0]+" "+toutDescr[0];
            
            initialiserCarousel(); 
        }
    });
    
    function initialiserCarousel(){
        var divCarousel = document.getElementById("carousel");
        if(divCarousel)
        {
            imageCarousel();
        } 
    }
    
    function imageCarousel(){                                           //fonction qui change l'image à toutes les 3 secondes
        var divCarousel = document.getElementById("carousel");
        if(divCarousel) {
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
            setTimeout(imageCarousel,3000);
        }      
    }
})();
    