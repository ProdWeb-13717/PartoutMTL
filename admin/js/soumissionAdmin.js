/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jonathmartel@gmail.com)
 * @version 1
 * @update 2013-12-11
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 *
 */

 // Placer votre JavaScript ici

//IIFE
(function(){
    
    window.addEventListener("load", function(){                                          // au chargement de la page
     
        if(document.querySelector(".soumissionAdmin"))                                   // si la classe "soumissionAdmin" existe
        {
            var btnSoumettre = document.querySelector("#boutonSoumission");
            btnSoumettre.addEventListener("click", function(evt){
                
                /*-- OEUVRES ------------------------------------------------------------------*/
                var valeurTitre = document.querySelector("[name=titreOeuvreAjout]").value;
                var valeurTitreVariante = document.querySelector("[name=titreVarianteOeuvreAjout]").value;
                //var valeurDateFinProduction = document.querySelector("[name=dateFinProductionOeuvreAjout]").value;
                //var valeurDateAccession = document.querySelector("[name=dateAccessionOeuvreAjout]").value;
                //var valeurCollection = document.querySelector("[name=collectionOeuvreAjout]").value;
                //var valeurModeAcquisition = document.querySelector("[name=modeAcquisitionOeuvreAjout]").value;
                //var valeurMateriaux = document.querySelector("[name=materiauxOeuvreAjout]").value;
                //var valeurTechnique = document.querySelector("[name=techniqueOeuvreAjout]").value;
                //var valeurDimensions = document.querySelector("[name=dimensionsOeuvreAjout]").value;
                //var valeurParc = document.querySelector("[name=parcOeuvreAjout]").value;
                //var valeurBatiment = document.querySelector("[name=batimentOeuvreAjout]").value;
                //var valeurAdresseCivique = document.querySelector("[name=adresseCiviqueOeuvreAjout]").value;
                //var valeurLatitude = document.querySelector("[name=latitudeOeuvreAjout]").value;
                //var valeurLongitude = document.querySelector("[name=longitudeOeuvreAjout]").value;
                //var valeurDescription = document.querySelector("[name=descriptionOeuvreAjout]").value;
                
                /*-- ARTISTES -----------------------------------------------------------------*/
                var valeurPrenomArtiste = document.querySelector("[name=prenomArtisteOeuvreAjout]").value;
                var valeurNomArtiste = document.querySelector("[name=nomArtisteOeuvreAjout]").value;
                var valeurCollectif = document.querySelector("[name=collectifOeuvreAjout]").value;
                
                /*-- CATÉGORIES ---------------------------------------------------------------*/
                var valeurCategorie = document.querySelector("[name=categorieOeuvreAjout]").value;
                
                /*-- ARRONDISSEMENTS ----------------------------------------------------------*/
                var valeurArrondissement = document.querySelector("[name=arrondissementOeuvreAjout]").value;
                
                /*-- PHOTOS -------------------------------------------------------------------*/
                var valeurUrlPhoto = document.querySelector("[name=urlPhotoOeuvreAjout]").value;
            
                console.log(valeurTitre);
                console.log(valeurTitreVariante);
                console.log(valeurPrenomArtiste);
                console.log(valeurNomArtiste);
                console.log(valeurCollectif);
                console.log(valeurCategorie);
                console.log(valeurArrondissement);
                console.log(valeurUrlPhoto);
                
                var data = JSON.stringify({titre             : valeurTitre, 
                                           titreVariante     : valeurTitreVariante,  
                                         /*dateFinProduction : valeurDateFinProduction,
                                           dateAccession     : valeurDateAccession,
                                           nomCollection     : valeurCollection,
                                           modeAcquisition   : valeurModeAcquisition,
                                           materiaux         : valeurMateriaux,
                                           technique         : valeurTechnique,
                                           dimensions        : valeurDimensions,
                                           parc              : valeurParc,
                                           batiment          : valeurBatiment,
                                           adresseCivique    : valeurAdresseCivique,
                                           latitude          : valeurLatitude,
                                           longitude         : valeurLongitude,
                                           description       : valeurDescription,                                            
                                            */
                                           prenomArtiste     : valeurPrenomArtiste,
                                           nomArtiste        : valeurNomArtiste,
                                           collectif         : valeurCollectif,
                                           idCategorie       : valeurCategorie,
                                           idArrondissement  : valeurArrondissement,
                                           urlPhoto          : valeurUrlPhoto});
                
                console.log(data);
                
                var xhr = new XMLHttpRequest();
                //xhr.addEventListener("readyStatechange", function(e)){}
                
                xhr.open("POST", "index.php?requete=insereSoumission")
                xhr.setRequestHeader("Content-type", "application/json");
                
                xhr.addEventListener("load", function(e){
                    console.log(e.currentTarget);
                    console.log(e.currentTarget.responseText);
                                     
                });
                xhr.send(data);
                
            });

        }

    });
    
})();



