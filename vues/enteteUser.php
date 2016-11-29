<body>
    <header>
        <div id="logo">P<span id="noir">ART</span>OUT<br/></div>
		<div id="barRecherche">
					<form class="rechercheAcceuil">
						<select id="categorieRecherche"  name="categorieRecherche">
							<option value="" >séléctionner catégorie</option>
							<option value="Artistes">Par l'artiste</option>
							<option value="Oeuvres">Par l'oeuvre</option>
						</select>
						<select name="souscategorieRecherche" id="souscategorieRecherche"  disabled>
							<option value="">séléctionner sou-catégorie</option>
							<option value="titre" >titre</option>
							
						</select>
						
						<input id='motRecherche' placeholder="Titre d'oeuvre" name="rechercheOeuvre" type='text'  />
						
						<input type="button" id="btnRecherche" value="Rechercher"/>
						<!--div id="boiteRecherche"></div-->
					</form>
		</div>

        <div id="menuUser">
            <ul>
				<!--Chaque li est un lien dans la barre menu-->
                <li><a href="index.php?requete=acceuil">ACCEUIL</a></li>
				<li id="liRecherche"><a href="index.php?requete=rechercheOeuvreTitre">RECHERCHE AVANCÉ</a></li>
                <li><a href="index.php?requete=listeArtistes">ARTISTES</a></li>
                <li><a href="index.php?requete=listeOeuvres">OEUVRES</a></li>
                <li><a href="index.php?requete=soumissionOeuvre">SOUMISSION</a></li>  
            </ul>
			
        </div>
		
    </header>
	<div id="boiteRecherche"></div>