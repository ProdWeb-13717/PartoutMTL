//Script pour afficher une page quand on clique son onglet correspondant

//IIFE
(function(){
    
    window.addEventListener("load", function()
                            {
        var secListe = document.getElementById("liste");
        
        if(secListe)
        {
            secListe.addEventListener("click",function(){
                var eTarget = event.target;
                //Si le target du event est un span de la classe pageBalise on change de page
                if(eTarget.nodeName == "SPAN" && eTarget.classList.contains("pageBalise"))
                {
                    var idVisible = eTarget.id;
                    
                    var toutePages= document.querySelectorAll("div.pageListe");
                    
                    for(var i = 0 ; i < toutePages.length ; i++)
                    {
                        toutePages[i].classList.add("pageCache");
                    }
                    
                    $pageVisible = document.getElementById("page"+idVisible);
                    $pageVisible.classList.remove("pageCache");
                    window.scrollTo(0,0); //scroll vers le haut de la page
                }
            });
        }
    });
})();