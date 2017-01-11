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
    
   
   window.addEventListener("load", function(){                                          // au chargement de la page
     
       if(document.querySelector(".optionBDContainer"))
       {    
           var boutones = document.getElementsByClassName("btforms");						// prendre les bouttons dans la page
           var nomboutones = boutones.length;
           var forms = document.getElementsByTagName("form");								// prendre les formulaires dans la page
	//****** code inspire de stackoverflow http://stackoverflow.com/questions/256754/how-to-pass-arguments-to-addeventlistener-listener-function
	//****** Usager: http://stackoverflow.com/users/1603177/zaloz
	
           for(var i=0;i<nomboutones;i++)
           {
               boutones[i].addEventListener("click", envoyerForm, false);
               boutones[i].param = forms[i];
           }
       }
    });
	
	
	function envoyerForm(evt)
	{
		evt.target.disabled = true; //Blockage des buttons de verification et mise à jour pour eviter que l'usager cours le script plusiers fois
		evt.target.param.submit(); // envoye le formulaire pertinant
		var gifSection = document.getElementById("charImage");
		gifSection.style.display = "inline";
	}

})();