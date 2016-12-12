<!-- AFFICHAGE DES SOUMISSIONS DES USAGERS, TABLE Soumissions --------------------------------------->

<section class="afficheSoumissionsUsagers">
    <h1 class="margin100">SOUMISSIONS DES USAGERS</h1>
	<ul>
	<?php
		foreach($data as $soumission)
        {
        ?>
            <ul class='soumissionDesUsagers margin10-100' name='soumissionDunUsager' id="<?php echo $soumission['idSoumission']?>">
                <li><a href="./index.php?requete=soumission&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">
                    SOUMISSION #        <?php echo $soumission["idSoumission"]?></a>            </li>
                <li>TITRE :             <?php echo $soumission["titreSoumission"]?>             </li>
                <li>PRÉNOM ARTISTE :    <?php echo $soumission["prenomArtisteSoumission"]?>     </li>
                <li>NOM ARTISTE :       <?php echo $soumission["nomArtisteSoumission"]?>        </li>
                <li>COLLECTIF :         <?php echo $soumission["collectifSoumission"]?>         </li>
                <li>ARRONDISSEMENTS :   <?php 
                                              $modeleSoumisionAdmin = new modeleSoumission();
                                              $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($soumission['idArrondissementSoumission'],'idArrondissement',"Arrondissements");
                                              echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                                        ?>                                                      </li>
                <li>PARC :              <?php echo $soumission["parcSoumission"]?>              </li>
                <li>ADRESSE CIVIQUE :   <?php echo $soumission["adresseCiviqueSoumission"]?>    </li>
                <li>DESCRIPTION :       <?php echo $soumission["descriptionSoumission"]?>       </li>
                <li>PHOTO :             <?php echo $soumission["photoSoumission"]?>             </li>
                <li>COURRIEL :          <?php echo $soumission["courrielSoumission"]?>          </li>
                <li><a href="./index.php?requete=supprimeSoumissionUsager&idSoumissionUsager=
                                        <?php echo $soumission["idSoumission"]?>">SUPPRIMER</a> </li>
            </ul>
            <?php
		}
	?>
	</ul>		
</section>