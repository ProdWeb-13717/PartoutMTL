<!-- AFFICHAGE DES SOUMISSIONS DES USAGERS, TABLE Soumissions --------------------------------------->

<div class="afficheSoumissionsUsagers">
    <h1 class="margin100">SOUMISSIONS DES USAGERS</h1>
	<ul>
	<?php
		foreach($data as $soumission)
        {
            ?>
            <hr/>
            <li class='soumissionDesUsagers margin10-100' name='soumissionDunUsager' id="<?php echo $soumission['idSoumission']?>"> 
                <a href="./index.php?requete=soumission&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">
                SOUMISSION #        <?php echo $soumission["idSoumission"]?> </a><br/>
                TITRE :             <?php echo $soumission["titreSoumission"]?> <br/>
                PRÉNOM ARTISTE :    <?php echo $soumission["prenomArtisteSoumission"]?> <br/>
                NOM ARTISTE :       <?php echo $soumission["nomArtisteSoumission"]?> <br/>
                COLLECTIF :         <?php echo $soumission["collectifSoumission"]?> <br/>
                ARRONDISSEMENTS :   <?php 
                                        $modeleSoumisionAdmin = new modeleSoumission();
                                        $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($soumission['idArrondissementSoumission'],'idArrondissement',"Arrondissements");
                                        echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                                    ?><br/>
                PARC :              <?php echo $soumission["parcSoumission"]?> <br/>
                ADRESSE CIVIQUE :   <?php echo $soumission["adresseCiviqueSoumission"]?> <br/>
                DESCRIPTION :       <?php echo $soumission["descriptionSoumission"]?> <br/>
                PHOTO :             <?php echo $soumission["photoSoumission"]?> <br/>
                COURRIEL :          <?php echo $soumission["courrielSoumission"]?> <br/>
                <!--input type="button" class="bouton" value="SUPPRIMER" id="<?php echo $soumission['idSoumission']?>"/-->
                <a href="./index.php?requete=supprimeSoumissionUsager&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">SUPPRIMER</a>
            </li>
			<br/>
            <?php
		}
	?>
	</ul>		
</div>