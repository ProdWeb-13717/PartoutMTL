<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->

<div class="soumissionAdmin">
    <h1>AJOUTER UNE OEUVRE</h1>
    <section class="soumissionAdminFormulaire">
        <label for="titreOeuvreAjoutAdmin"><span class="couleurErreurSoumission">TITRE : </span></label>
        <input type="text" name="titreOeuvreAjout" id="titreOeuvreAjoutAdmin" 
            <?php 
                 if(isset($_GET["idSoumissionUsager"]))
                 {
                    ?>
				    value="<?php echo $data['titreSoumission']; ?>"
				    <?php
			     }
            ?>
        /><br/>
        <label for="titreVarianteOeuvreAjoutAdmin">TITRE VARIANTE : </label>
        <input type="text" name="titreVarianteOeuvreAjout" id="titreVarianteOeuvreAjoutAdmin"/><br/>
