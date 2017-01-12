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
     
        if(document.querySelector(".soumissionAdmin"))                                          // si la classe "soumissionAdmin" existe
        { 
            /*-- SOUMISSION ---------------------------------------------------------------------------*/
            if(document.querySelector("#boutonSoumission"))                                     // si le bouton SOUMETTRE existe
            {
                var btnSoumettre = document.querySelector("#boutonSoumission");                 // récupère le bouton SOUMETTRE
                btnSoumettre.addEventListener("click", function(evt)                            // à l'événement CLIC
                {                                         
                    if(validationSoumission())                                                  // valide certaines entrées, si valide
                    {    
                       
                        evt.target.disabled=true;                                               // il n'y a plus d'évènements au click
                        
                        var data = recupereValeur();                                            // récupère les valeurs entrées lors de la soumission            
                                    
                        /*-- REQUÊTE AJAX -------------------------------------------------------------*/
                        var xhr = new XMLHttpRequest();                                         // nouvelle requête
                        
                        xhr.open("POST", "index.php?requete=insereSoumission")                  // controleur case "requete" = "insereSoumission"
                        xhr.setRequestHeader("Content-type", "application/json");
                        
                        xhr.addEventListener("load", function(e){
                            console.log(e.currentTarget);
                            console.log(e.currentTarget.responseText);
                            //window.location.href = "./index.php?requete=afficheSoumission";
                            document.querySelector(".soumissionAdmin").innerHTML = e.currentTarget.responseText;                 
                        });
                        xhr.send(data);                                                         // envoie la requête et les datas en POST
                    }
                    else                                                                        // sinon, message de champs invalides
                    {
                        document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez remplir correctement les champs";
                    }  
                });
            }
        
            
            /*-- MODIFICATION -------------------------------------------------------------------------*/
            if(document.querySelector("#boutonModification"))                                   // si le bouton SOUMETTRE existe
            {
                var btnModifier = document.querySelector("#boutonModification");                // récupère le bouton MODIFIER
                btnModifier.addEventListener("click", function(evt)                             // à l'événement CLIC
                {                               
                    if(validationSoumission())                                                  // valide certaines entrées, si valide
                    {
                        var data = recupereValeur();                                            // récupère les valeurs entrées lors de la modification            
                        
                        /*-- REQUÊTE AJAX -------------------------------------------------------------*/
                        var xhr = new XMLHttpRequest();                                         // nouvelle requête
                        
                        xhr.open("POST", "index.php?requete=updateModification")                // controleur case "requete" = "updateModification"
                        xhr.setRequestHeader("Content-type", "application/json");
                        
                        xhr.addEventListener("load", function(e){
                            console.log(e.currentTarget);
                            console.log(e.currentTarget.responseText);
                            document.querySelector(".soumissionAdmin").innerHTML = e.currentTarget.responseText;                 
                        });
                        xhr.send(data);                                                         // envoie la requête et les datas en POST
                    }
                    else                                                                        // sinon, message de champs invalides
                    {
                        document.querySelector("#msgErreurSoumision").innerHTML = "Veuillez remplir correctement les champs";
                    }  
                });
            }
        }  
    });
    
    
    function recupereValeur(){
        /*-- RÉCUPÈRE LES ENTRÉES DE LA TABLE OEUVRES ----------------------------------*/
        
        var valeurId                = document.querySelector("[name=idOeuvreAModifie]").value;
        
        var valeurTitre             = document.querySelector("[name=titreOeuvreAjout]").value;
        var valeurTitreVariante     = document.querySelector("[name=titreVarianteOeuvreAjout]").value;
        var valeurDateFinProduction = document.querySelector("[name=dateFinProductionOeuvreAjout]").value;
        if(valeurDateFinProduction == ""){                                                      // si l'entrée date fin de production est vide
            valeurDateFinProduction = null;                                                     // sa valeur est null
        }
        var valeurDateAccession         = document.querySelector("[name=dateAccessionOeuvreAjout]").value;
        if(valeurDateAccession == ""){                                                          // si l'entrée date d'accession est vide
            valeurDateAccession = null;                                                         // sa valeur est null
        }
        var valeurCollection        = document.querySelector("[name=collectionOeuvreAjout]").value;
        var valeurModeAcquisition   = document.querySelector("[name=modeAcquisitionOeuvreAjout]").value;
        var valeurMateriaux         = document.querySelector("[name=materiauxOeuvreAjout]").value;
        var valeurTechnique         = document.querySelector("[name=techniqueOeuvreAjout]").value;
        var valeurDimensions        = document.querySelector("[name=dimensionsOeuvreAjout]").value;
        var valeurParc              = document.querySelector("[name=parcOeuvreAjout]").value;
        var valeurBatiment          = document.querySelector("[name=batimentOeuvreAjout]").value;
        var valeurAdresseCivique    = document.querySelector("[name=adresseCiviqueOeuvreAjout]").value;
        var valeurLatitude          = document.querySelector("[name=latitudeOeuvreAjout]").value;
        if(valeurLatitude == ""){                                                               // si l'entrée latitude est vide
            valeurLatitude = null;                                                              // sa valeur est null
        }
        var valeurLongitude         = document.querySelector("[name=longitudeOeuvreAjout]").value;
        if(valeurLongitude == ""){                                                              // si l'entrée longitude est vide
            valeurLongitude = null;                                                             // sa valeur est null
        }
        var valeurDescription       = document.querySelector("[name=descriptionOeuvreAjout]").value;
        
        /*-- RÉCUPÈRE LES ENTRÉES DE LA TABLE ARTISTES --------------------------------*/
        var valeurPrenomArtiste     = document.querySelector("[name=prenomArtisteOeuvreAjout]").value;
        var valeurNomArtiste        = document.querySelector("[name=nomArtisteOeuvreAjout]").value;
        var valeurCollectif         = document.querySelector("[name=collectifOeuvreAjout]").value;
        
        /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE CATÉGORIES ---------------------------------*/
        var valeurCategorie         = document.querySelector("[name=categorieOeuvreAjout]").value;
                    
        /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE ARRONDISSEMENTS ----------------------------*/
        var valeurArrondissement    = document.querySelector("[name=arrondissementOeuvreAjout]").value;
        
        /*-- RÉCUPÈRE L'ENTRÉE DE LA TABLE PHOTOS -------------------------------------*/
        var valeurUrlPhoto          = document.querySelector("[name=urlPhotoOeuvreAjout]").value;
                
        /*-- LES ENTRÉES DANS UN JSON TRADUIT EN STRING -------------------------------*/
        var data = JSON.stringify({idOeuvre          : valeurId,
                                   titre             : valeurTitre, 
                                   titreVariante     : valeurTitreVariante,  
                                   prenomArtiste     : valeurPrenomArtiste,
                                   nomArtiste        : valeurNomArtiste,
                                   collectif         : valeurCollectif,
                                   idCategorie       : valeurCategorie,
                                   dateFinProduction : valeurDateFinProduction,
                                   nomCollection     : valeurCollection,
                                   modeAcquisition   : valeurModeAcquisition,
                                   dateAccession     : valeurDateAccession,
                                   materiaux         : valeurMateriaux,
                                   technique         : valeurTechnique,
                                   dimensions        : valeurDimensions,
                                   idArrondissement  : valeurArrondissement,
                                   parc              : valeurParc,
                                   batiment          : valeurBatiment,
                                   adresseCivique    : valeurAdresseCivique,
                                   latitude          : valeurLatitude,
                                   longitude         : valeurLongitude,
                                   urlPhoto          : valeurUrlPhoto,
                                   description       : valeurDescription});
        //console.log(data);
        return data;
    }
    
    function validationSoumission(){
        
        /*-- BOOLÉEN, VALIDE OU NON ---------------------------------------------------*/
        var valide= true;
        
        /*-- RÉCUPÈRE LES ENTRÉES À VALIDER -------------------------------------------*/
        var valeurTitre         = document.querySelector("[name=titreOeuvreAjout]").value;
        var valeurPrenomArtiste = document.querySelector("[name=prenomArtisteOeuvreAjout]").value;
        var valeurNomArtiste    = document.querySelector("[name=nomArtisteOeuvreAjout]").value;
        var valeurCollectif     = document.querySelector("[name=collectifOeuvreAjout]").value;
        var valeurCategorie     = document.querySelector("[name=categorieOeuvreAjout]").value;
        var valeurDimensions    = document.querySelector("[name=dimensionsOeuvreAjout]").value;
        
        var valeurArrondissement= document.querySelector("[name=arrondissementOeuvreAjout]").value;
        
        var valeurLatitude      = document.querySelector("[name=latitudeOeuvreAjout]").value;
        var valeurLongitude     = document.querySelector("[name=longitudeOeuvreAjout]").value;
        
        /*-- REGEX --------------------------------------------------------------------*/
        var dimensionsRegex     = /^[0-9]+ ?x ?[0-9]+ ?x? ?[0-9]+? ?(cm)?$/;
        var latitudeRegex       = /^45\.[0-9]{4}$/;
        var longitudeRegex      = /^\-73\.[0-9]{4}$/;
        
        /*-- REINITIALISE LA COULEUR DES TITRES DES INPUTS ----------------------------*/
        var couleurErreur       = document.querySelectorAll(".couleurErreurSoumission");
        for (i = 0; i < couleurErreur.length; i++) {    
            couleurErreur[i].style.color= "black";
        }
        
        /*-- VÉRIFICATIONS ------------------------------------------------------------*/
        if(valeurTitre == "")                                                               // y'a t-il un titre ?
        {
            valide= false;                                                                  // si non
            couleurErreur[0].style.color= "brown";                                          // le titre du input est rouge
        }
        
        if(valeurPrenomArtiste == "" && valeurNomArtiste == "" && valeurCollectif == "")    // l'artiste est-il nommé ?
        {
            valide= false;                                                                  // si non
            for (i = 1; i <= 3; i++) {
                couleurErreur[i].style.color = "brown";                                     // les titres des inputs sont rouges
            }
        }
        
        if(valeurCategorie == "#")                                                          // la catégorie a t'elle été sélectionnée
        {
            valide= false;                                                                  // si non
            couleurErreur[4].style.color= "brown";                                          // le titre du input est rouge
        }
        
        if(valeurDimensions !="")                                                           // y'a t-il une dimension ?
        { 
            if(!dimensionsRegex.exec(valeurDimensions)){                                    // respecte t'elle la regex, si non ?
                valide= false;
                couleurErreur[5].style.color= "brown";                                      // le titre du input est rouge
            }   
        }
        
        if(valeurArrondissement == "#")                                                     // l'arrondissement a t'il été sélectionné
        {
            valide= false;                                                                  // si non
            couleurErreur[6].style.color= "brown";                                          // le titre du input est rouge
        }
        
        
        if(valeurLatitude !="")                                                             // y'a t-il une latitude ?
        {
            if(!latitudeRegex.exec(valeurLatitude)){                                        // respecte t'elle la regex, si non ?
                valide= false;
                couleurErreur[7].style.color= "brown";                                      // le titre du input est rouge
            }   
        }
        
        if(valeurLongitude !="")                                                            // y'a t-il une longitude ?
        { 
            if(!longitudeRegex.exec(valeurLongitude)){                                      // respecte t'elle la regex, si non ?	
                valide= false;
                couleurErreur[8].style.color= "brown";                                      // le titre du input est rouge
            } 
        }
        
        /*-- BOOLÉEN, VALIDE OU NON ---------------------------------------------------*/
        if (valide){
            return true;
        }
        else{
            return false;
        }
    }
})();



