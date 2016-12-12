<?php
	$imagesURL = "";
	$longueur = count($data);

	for ($i = 0 ; $i < $longueur ; $i++)
	{
		$imagesURL = $imagesURL.$data[$i]["urlPhoto"];
		if($i != ($longueur-1))
		{
			$imagesURL = $imagesURL."~";
		}
	}
?>
<body>
    <header>
        <div id="logo">P<span id="noir">ART</span>OUT<br/></div>
		<div id="menuAccueil"> <!-- id est aussi utilise pour recherche -->
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
</body>