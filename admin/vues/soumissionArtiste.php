<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SECTION ARTISTE DE LA SOUMISSION D'UNE OEUVRE, TABLE Artistes ---------------------------------->

<h3 class="espaceH3">ARTISTE</h3>

<section class="flex-row-left formulaireSoumissionAdmin">
    <article class="formulaireSoumissionAdminGauche">
        <label for="prenomArtisteOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Prénom : </span></label>
        <input type="text" name="prenomArtisteOeuvreAjout" id="prenomArtisteOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
				    value="<?php echo $data['prenomArtisteSoumission']; ?>"
				    <?php
                }

                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $artiste)
                    {
                        if ($artiste['prenomArtiste'] != NULL){
                            ?>
                            value="<?php echo $artiste['prenomArtiste']; ?>"
                            <?php
                        }
                    }
                }
             ?>
        />
    </article>
    
    <article class="espaceHaut10">
        <label for="nomArtisteOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Nom : </span></label>
        <input type="text" name="nomArtisteOeuvreAjout" id="nomArtisteOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
				    value="<?php echo $data['nomArtisteSoumission']; ?>"
				    <?php
                }

                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $artiste)
                    {
                        if ($artiste['nomArtiste'] != NULL){
                            ?>
                            value="<?php echo $artiste['nomArtiste']; ?>"
                            <?php
                        }
                    }
                }
            ?>     
        />
    </article>
</section>

<section class="flex-row-left formulaireSoumissionAdmin">
    <article>
    <label for="collectifOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Collectif : </span></label>
    <input type="text" name="collectifOeuvreAjout" id="collectifOeuvreAjoutAdmin"
        <?php 
            if(isset($_GET["idSoumissionUsager"]))
            {
                ?>
				value="<?php echo $data['collectifSoumission']; ?>"
				<?php
            }

            if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
            {
                foreach($data as $artiste)
                {
                    if ($artiste['collectif'] != NULL){
                        ?>
                        value="<?php echo $artiste['collectif']; ?>"
                        <?php
                    }
                }
            }
        ?>
    />
    </article>
</section>

