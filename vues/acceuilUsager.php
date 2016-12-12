<script>
    window.addEventListener('load', function(){
	var ferme = false;    
	var elmBoutStart = document.getElementById('burger');
    var	menuStart = document.querySelector('.menu');
	var timer;
    
	elmBoutStart.addEventListener('click', function(){
		
		
		
		if (ferme == false)
		{
			/*
			if(timer) {
				clearTimeout(timer); //cancel the previous timer.
				timer = null;
                console.log('clear timer');
			}*/
			
			//fait apparaître les items du menu
			document.getElementsByClassName("menu")[0].style.display = "block";
            menuStart.classList.toggle('menu_ouverture');
            menuStart.classList.toggle('menu_fermeture');
			console.log('bouton ouvre');
            
            //ouverture du menu burger
			document.getElementsByClassName('bare-burger')[0].style.transform = "rotateZ(47.5deg)";
			document.getElementsByClassName('bare-burger')[1].style.transform = "translate(90%, 0px) scaleX(55)";
			document.getElementsByClassName('bare-burger')[2].style.transform = "rotateZ(-47.5deg)";
			ferme = true;
		}
		else
		{
		console.log('bouton ferme');
            //fait disparaître les items du menu
            menuStart.classList.toggle('menu_fermeture');
			
			//alert(timer);
            
			//fermeture du menu burger
			document.getElementsByClassName('bare-burger')[0].style.transform = "rotateZ(0)";
			document.getElementsByClassName('bare-burger')[1].style.transform = "translate(0%, 0px)";
			document.getElementsByClassName('bare-burger')[2].style.transform = "rotateZ(0)";
			ferme = false;
            timer = setTimeout(time, 500);
		}
	})
	
	function time(){
		console.log('display none');
		document.getElementsByClassName("menu")[0].style.display = "none";
		menuStart.classList.toggle('menu_ouverture');
	}
	
}) 
    
</script>




<body>
    <header>
        <section>
            <article class="logo">
            <span class="logoFadeIn logoFadeInAnimation">P</span><span id="art">ART</span><span class="logoFadeIn logoFadeInAnimation">OUT</span>
            </article>    
            <article class="sousTitre">PORTAIL D'ART PUBLIC DE MONTRÉAL</article>
        </section>
		
        <nav id="menuAcceuil"> <!-- id est aussi utilise pour recherche-->
            <div class="ligne ligne_glisse"></div>
            <ul class="row">   
				<!--Chaque li est un lien dans la barre menu-->
                <li><a href="index.php?requete=acceuil">ACCEUIL</a></li>
				<li id="liRecherche"><a href="index.php?requete=rechercheAvance">RECHERCHE AVANCÉE</a></li>
                <li><a href="index.php?requete=listeArtistes">ARTISTES</a></li>
                <li><a href="index.php?requete=listeOeuvres">OEUVRES</a></li>
                <li><a href="index.php?requete=soumissionOeuvre">SOUMISSION</a></li>  
            </ul>	
        </nav>
    </header>
	
	<section id="carousel"> 
		<article id="barRechercheAcceuil">
			<form class="rechercheAcceuil">
				<input id='motRecherche' placeholder="Rechercher une oeuvre/ un(e) artiste" name="rechercheOeuvre" type='text'  />	
				<input type="button" id="btnRecherche" value="Rechercher"/>
			</form>
		</article>
	</section>
	<!--section id="apropos">
		<p id="titreApropos">
			
		</p>
		<p id="text">
        
		</p>
	</section-->