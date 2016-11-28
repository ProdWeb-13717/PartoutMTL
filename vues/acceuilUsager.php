
<?php
?>


<body id="pageAcceuil">
	<div id="acceuil">
		<header id="headerAcceuil">
		
		<div id="logo">P<span id="blanch">ART</span>OUT<br/></div>

		<div id="menuAcceuil">
			<ul>
				<!--Chaque li est un lien dans la barre menu-->
				<li><a href="index.php?requete=rechercheOeuvreTitre">RECHERCHE AVANCÉ</a></li>
				<li><a href="index.php?requete=listeArtistes">ARTISTES</a></li>
				<li><a href="index.php?requete=listeOeuvres">OEUVRES</a></li>
				<li><a href="#">SOUMISSION</a></li>
			</ul>     
		</div>
	 
		</header>
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
</body>