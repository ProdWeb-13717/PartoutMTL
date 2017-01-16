<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SUITE DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------------------------->   

    <section class="flex-row-left formulaireSoumissionAdmin">
        <article class="formulaireSoumissionAdminGauche">
            <label for="parcOeuvreAjoutAdmin">Parc : </label>
            <input type="text" name="parcOeuvreAjout" id="parcOeuvreAjoutAdmin"
                <?php 
                    if(isset($_GET["idSoumissionUsager"]))
                    {
                        ?>
                        value="<?php echo $data['parcSoumission']; ?>"
				        <?php
                    }

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['parc'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['parc']; ?>"
                                <?php
                            }
                        }
                    }
                ?> 
            />
        </article>
    
        <article class="espaceHaut10">
            <label for="batimentOeuvreAjoutAdmin">Bâtiment : </label>
            <input type="text" name="batimentOeuvreAjout" id="batimentOeuvreAjoutAdmin"
            <?php  
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                        if ($oeuvre['batiment'] != NULL){
                            ?>
                            value="<?php echo $oeuvre['batiment']; ?>"
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
            <label for="adresseCiviqueOeuvreAjoutAdmin">Adresse civique : </label>
            <input type="text" name="adresseCiviqueOeuvreAjout" id="adresseCiviqueOeuvreAjoutAdmin"
                <?php 
                    if(isset($_GET["idSoumissionUsager"]))
                    {
                        ?>
                        value="<?php echo $data['adresseCiviqueSoumission']; ?>"
                        <?php
                    }

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['adresseCivique'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['adresseCivique']; ?>"
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
            <label for="latitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Latitude : </span></label>
            <input type="text" name="latitudeOeuvreAjout" id="latitudeOeuvreAjoutAdmin" placeholder= "45.0000"
                <?php  
                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['latitude'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['latitude']; ?>"
                                <?php
                            }
                        }
                    }
                ?>
            />
        </article>
    
        <article class="espaceHaut10">
            <label for="longitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Longitude : </span></label>
            <input type="text" name="longitudeOeuvreAjout" id="longitudeOeuvreAjoutAdmin" placeholder= "-73.0000"
                <?php  
                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['longitude'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['longitude']; ?>"
                                <?php
                            }
                        }
                    }
                ?>       
            />
        </article>
    </section>

    <h3 class="espaceH3">PHOTO</h3>

    <section class="flex-column-left formulaireSoumissionAdmin">
        
    <?php  
        if($_GET['requete'] == "soumission" && isset($_GET['idSoumissionUsager']))
        {
            ?> 
            <article>
                <label for="urlPhotoOeuvreAjoutAdmin">URL photo : </label>
                <input type="text" name="urlPhotoOeuvreAjout" id="urlPhotoOeuvreAjoutAdmin"
                    value="<?php echo $data['photoSoumission']; ?>"
                />
            </article>  
            <?php
        }

        if($_GET['requete'] == "soumission" && !isset($_GET['idSoumissionUsager']))
        {
            ?>
            <article>
                <input type="hidden" name="urlPhotoOeuvreAjout" value=""/>
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="photoOeuvreSoumissionAdmin">Photo (.jpg) : </label>
                <input type="file" name="photoOeuvreSoumission" id="photoOeuvreSoumissionAdmin" accept="image/jpeg"/>
            </article>
            <?php
        }
   
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
            ?> 
            <article class="formulaireSoumissionAdmin">
                <input type="hidden" name="urlPhotoOeuvreAjout" value=""/>
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="nouvellePhotoOeuvreAdmin">Ajouter une photo : </label>
                <input type="file" name="nouvellePhotoOeuvre" id="nouvellePhotoOeuvreAdmin"/><br/>
            </article>
            <article>
                <label for="nouvellePhotoOeuvreAdmin">Supprimer une photo : </label>
            </article>
            <?php
        }
        ?> 
    </section> 

    <h3 class="espaceH3">DESCRIPTION</h3>

    <textarea rows="4" style="width: 337px;" name="descriptionOeuvreAjout" id="descriptionOeuvreAjoutAdmin"><?php 
        if(isset($_GET["idSoumissionUsager"]))
        {
            echo $data['descriptionSoumission'];
        }
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
            foreach($data as $oeuvre)
            {
                if ($oeuvre['description'] != NULL)
                {
                    echo $oeuvre['description'];
                }
            }
        }
    ?></textarea>

    <span id="msgErreurSoumision"></span>

<!-- fin section class="flex-column-left" -->
</section>
