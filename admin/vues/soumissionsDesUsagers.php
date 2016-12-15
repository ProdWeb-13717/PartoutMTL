<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- AFFICHAGE DES SOUMISSIONS DES USAGERS, TABLE Soumissions --------------------------------------->

<section class="afficheSoumissionsUsagers">
    <h1>SOUMISSIONS DES USAGERS</h1>
	<ul>
		<?php
		foreach($data as $soumission)
        {
			?>
            <ul class='soumissionDesUsagers' name='soumissionDunUsager' id="<?php echo $soumission['idSoumission']?>">
			
                <li>
					<span  class="numeroSoumission">
						SOUMISSION #        <?php echo $soumission["idSoumission"]?>         
					</span>
				</li>
				
                <li>TITRE :             <?php echo $soumission["titreSoumission"]?>             </li>
                <li>PRÉNOM ARTISTE :    <?php echo $soumission["prenomArtisteSoumission"]?>     </li>
                <li>NOM ARTISTE :       <?php echo $soumission["nomArtisteSoumission"]?>        </li>
                <li>COLLECTIF :         <?php echo $soumission["collectifSoumission"]?>         </li>
				
                <li>ARRONDISSEMENTS :   
					<?php 
                    $modeleSoumisionAdmin = new modeleSoumission();
                    $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($soumission['idArrondissementSoumission'],'idArrondissement',"Arrondissements");
                    echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                    ?>                                                      
				</li>
				
                <li>PARC :              <?php echo $soumission["parcSoumission"]?>              </li>
                <li>ADRESSE CIVIQUE :   <?php echo $soumission["adresseCiviqueSoumission"]?>    </li>
                <li>DESCRIPTION :       <?php echo $soumission["descriptionSoumission"]?>       </li>
                <li>PHOTO :             <?php echo $soumission["photoSoumission"]?>             </li>
                <li>COURRIEL :          <?php echo $soumission["courrielSoumission"]?>          </li>
				
                <li class="liensSoumission">
                    <a href="./index.php?requete=soumission&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">AJOUTER</a>
                    <a href="./index.php?requete=supprimeSoumissionUsager&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">SUPPRIMER</a>                    
				</li>
            </ul>
			<?php
		}
		?>
	</ul>		
</section>