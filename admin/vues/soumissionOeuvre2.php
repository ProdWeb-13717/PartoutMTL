<!-- SUITE DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------------------------->


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

    <!-- FIN DE PRODUCTION -------------------------------------------------------------------------->
    <article class="espaceHaut10">
        <label for="dateFinProductionOeuvreAjoutAdmin">Fin de production : </label>
        <input type="date" name="dateFinProductionOeuvreAjout" id="dateFinProductionOeuvreAjoutAdmin"
            <?php  
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['dateFinProduction'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['dateFinProduction']; ?>"
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
        <label for="collectionOeuvreAjoutAdmin">Collection : </label>
        <select name="collectionOeuvreAjout" id="collectionOeuvreAjoutAdmin">
            <option value="Art public"
                <?php  
                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['nomCollection'] == "Art public"){
                                ?>
                                selected
                                <?php
                            }
                        }
                    }
                ?>     
            >Art public</option>
            <option value="Intégration à l'architecture"
                <?php  
                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['nomCollection'] == "Intégration à l'architecture"){
                                ?>
                                selected
                                <?php
                            }
                        }
                    }
                ?>        
            >Intégration à l'architecture</option>
        </select>
    </article>
</section>
 
<section class="flex-row-left formulaireSoumissionAdmin">
    <article class="formulaireSoumissionAdminGauche">
        <label for="modeAcquisitionOeuvreAjoutAdmin">Mode d'acquisition : </label>
        <input type="text" name="modeAcquisitionOeuvreAjout" id="modeAcquisitionOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['modeAcquisition'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['modeAcquisition']; ?>"
                            <?php
                        }
                    }
                }
            ?>       
        />
    </article>
    
    <article class="espaceHaut10">
        <label for="dateAccessionOeuvreAjoutAdmin">Date d'accession : </label>
        <input type="date" name="dateAccessionOeuvreAjout" id="dateAccessionOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['dateAccession'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['dateAccession']; ?>"
                            <?php
                        }
                    }
                }
            ?>
        />
    </article>
</section>

<section class="flex-row-left formulaireSoumissionAdmin">
    <article class="formulaireSoumissionAdminGauche">
        <label for="materiauxOeuvreAjoutAdmin">Matériaux : </label>
        <input type="text" name="materiauxOeuvreAjout" id="materiauxOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['materiaux'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['materiaux']; ?>"
                            <?php
                        }
                    }
                }
            ?>      
        />
    </article>
    
    <article class="espaceHaut10">
        <label for="techniqueOeuvreAjoutAdmin">Technique : </label>
        <input type="text" name="techniqueOeuvreAjout" id="techniqueOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['technique'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['technique']; ?>"
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
        <label for="dimensionsOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Dimensions : </span></label>
        <input type="text" name="dimensionsOeuvreAjout" id="dimensionsOeuvreAjoutAdmin" placeholder= "00 x 00 x 00 cm"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['dimensions'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['dimensions']; ?>"
                            <?php
                        }
                    }
                }
            ?> 
        />
    </article>
</section>    

    
    