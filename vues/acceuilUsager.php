<body>
    <header>
        <div id="logo">P<span id="noir">ART</span>OUT<br/></div>
		<div id="menuAcceuil"> <!-- id est aussi utilise pour recherche -->
            <ul>
				<!--Chaque li est un lien dans la barre menu-->
                <li><a href="index.php?requete=acceuil">ACCEUIL</a></li>
				<li id="liRecherche"><a href="index.php?requete=rechercheAvance">RECHERCHE AVANCÉ</a></li>
                <li><a href="index.php?requete=listeArtistes">ARTISTES</a></li>
                <li><a href="index.php?requete=listeOeuvres">OEUVRES</a></li>
                <li><a href="index.php?requete=soumissionOeuvre">SOUMISSION</a></li>  
            </ul>
			
        </div>
		
    </header>
	
	<div id="carousel"> 
		<div id="barRechercheAcceuil">
			<form class="rechercheAcceuil">
				<input id='motRecherche' placeholder="Rechercher une oeuvre/ un(e) artiste" name="rechercheOeuvre" type='text'  />	
				<input type="button" id="btnRecherche" value="Rechercher"/>
			</form>
		</div>
	</div>
	<div id="apropos">
		<p id="titreApropos">
			What is Lorem Ipsum?
		</p>
		<p id="text">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	
		</p>
	</div>
</body>