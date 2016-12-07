<!-- SECTION ARTISTE DE LA SOUMISSION D'UNE OEUVRE, TABLE Artistes ---------------------------------->

        <label for="prenomArtisteOeuvreAjoutAdmin"><span class="couleurErreurSoumission">PRÉNOM DE L'ARTISTE : </span></label>
        <input type="text" name="prenomArtisteOeuvreAjout" id="prenomArtisteOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
				    value="<?php echo $data['prenomArtisteSoumission']; ?>"
				    <?php
                }
             ?>
        /><br/>

        <label for="nomArtisteOeuvreAjoutAdmin"><span class="couleurErreurSoumission">NOM DE L'ARTISTE : </span></label>
        <input type="text" name="nomArtisteOeuvreAjout" id="nomArtisteOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
				    value="<?php echo $data['nomArtisteSoumission']; ?>"
				    <?php
                }
            ?>     
        /><br/>
        
        <label for="collectifOeuvreAjoutAdmin"><span class="couleurErreurSoumission">COLLECTIF : </span></label>
        <input type="text" name="collectifOeuvreAjout" id="collectifOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
				    value="<?php echo $data['nomArtisteSoumission']; ?>"
				    <?php
                }
            ?>
        /><br/>
