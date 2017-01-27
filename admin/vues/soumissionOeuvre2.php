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
                        if ($oeuvre['dateFinProduction'] != NULL){                                          // s'il y a une date de fin de production, écrit la date de fin de production de l'oeuvre dans le input DATE
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
    
    <!-- COLLECTION --------------------------------------------------------------------------------->
    <article>
        <label for="collectionOeuvreAjoutAdmin">Collection : </label>
        <select name="collectionOeuvreAjout" id="collectionOeuvreAjoutAdmin">
            <option value="Art public"
                <?php  
                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                     // si "modification"
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['nomCollection'] == "Art public"){                                  // sélectionne l'option "Art public" si c'est son nom de collection
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
                            if ($oeuvre['nomCollection'] == "Intégration à l'architecture"){                // sélectionne l'option "Intégration à l'architecture" si c'est son nom de collection
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
        
        <!-- MODE D'ACQUISITION ----------------------------------------------------------------------->
        <label for="modeAcquisitionOeuvreAjoutAdmin">Mode d'acquisition : </label>
        <input type="text" name="modeAcquisitionOeuvreAjout" id="modeAcquisitionOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['modeAcquisition'] != NULL){                                            // s'il y a un mode d'acquisition, écrit le mode d'acquisition de l'oeuvre dans le input TEXT
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
        
        <!-- DATE D'ACCESSION ------------------------------------------------------------------------>
        <label for="dateAccessionOeuvreAjoutAdmin">Date d'accession : </label>
        <input type="date" name="dateAccessionOeuvreAjout" id="dateAccessionOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['dateAccession'] != NULL){                                              // s'il y a une date d'accession, écrit la date d'accession de l'oeuvre dans le input DATE
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
        
        <!-- MATÉRIAUX ------------------------------------------------------------------------------>
        <label for="materiauxOeuvreAjoutAdmin">Matériaux : </label>
        <input type="text" name="materiauxOeuvreAjout" id="materiauxOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['materiaux'] != NULL){                                                  // s'il y a des matériaux, écrit les matériaux de l'oeuvre dans le input TEXT 
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
        
        <!-- TECHNIQUE ------------------------------------------------------------------------------>
        <label for="techniqueOeuvreAjoutAdmin">Technique : </label>
        <input type="text" name="techniqueOeuvreAjout" id="techniqueOeuvreAjoutAdmin"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['technique'] != NULL){                                                  // s'il y a des techniques, écrit les techniques de l'oeuvre dans le input TEXT 
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
        
        <!-- DIMENSIONS ----------------------------------------------------------------------------->
        <label for="dimensionsOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Dimensions : </span></label>
        <input type="text" name="dimensionsOeuvreAjout" id="dimensionsOeuvreAjoutAdmin" placeholder= "00 x 00 x 00 cm"
            <?php                   
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['dimensions'] != NULL){                                                 // s'il y a des dimensions, écrit les dimensions de l'oeuvre dans le input TEXT 
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

    
    