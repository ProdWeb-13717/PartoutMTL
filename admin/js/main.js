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


window.onload = function(){                                                                                     // au chargement de la page
    if(document.getElementById("formAjoutOeuvre"))                                                              // si le formulaire "formAjoutOeuvre" existe
    {
        document.getElementById("formAjoutOeuvre").addEventListener('submit', insereSoumission, false);         // mettre un écouteur sur le submit  
    }
            
    
}

function insereSoumission(){                                                                                    // au submit du formulaire "formAjoutOeuvre"
    
    if(validFormulaireSoumissionAdmin()){                                                                       // si le formulaire est valide
        soumission = recupereFormulaire();                                                                      // appel la fonction qui récupère le formulaire
        console.log(soumission);
        //soumissionString = JSON.stringify(soumission);                                                        // met le formule rempli dans une string
        //console.log(soumissionString);
        
       
        
        // return false; // bloquage de l'envoye du formulaire 
        // return true; // autorisation de l'envoye du formulaire    
    }
    else{
        document.getElementById("msgErreurSoumision").innerHTML = "Veuillez remplir correctement tous les champs";
    }
}
    

function validFormulaireSoumissionAdmin(){                                                                      // function de validation du formulaire
	var valide= true;                                                                                           // initialise la validation à true
	console.log("je valide");
		

    return valide;
}


function recupereFormulaire(){                                                                                  
	var tableauElement = document.formAjoutOeuvreAdmin.elements;
	var longueur = tableauElement.length-1;
	var tableauSoumission = {};
	for (var i = 0; i < longueur; i++) {
		var element = tableauElement[i];
		var valeur = encodeURIComponent(element.value);
		tableauSoumission[element.id] = valeur;	
	}
	return tableauSoumission;
}



