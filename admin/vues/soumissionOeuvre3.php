<!-- SUITE DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


    <section class="flex-row-left formulaireSoumissionAdmin">
        
        <!-- PARC ----------------------------------------------------------------------------------->
        <article class="formulaireSoumissionAdminGauche">
            <label for="parcOeuvreAjoutAdmin">Parc : </label>
            <input type="text" name="parcOeuvreAjout" id="parcOeuvreAjoutAdmin"
                <?php 
                    if(isset($_GET["idSoumissionUsager"]))                                                          // si ajout d'une soumission d'un usager, écrit le parc dans le input TEXT
                    {
                        ?>
                        value="<?php echo $data['parcSoumission']; ?>"
				        <?php
                    }

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification", écrit le parc dans le input TEXT
                    {

                        if ($data[0]["parc"]!= NULL)
                        {
                            ?>
                            value="<?php echo $data[0]["parc"]; ?>"
                            <?php
                        }
                    }
                ?> 
            />
        </article>
        
        <!-- BÂTIMENT ------------------------------------------------------------------------------->
        <article class="espaceHaut10">
            <label for="batimentOeuvreAjoutAdmin">Bâtiment : </label>
            <input type="text" name="batimentOeuvreAjout" id="batimentOeuvreAjoutAdmin"
                <?php  

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification", écrit le bâtiment dans le input TEXT
                    {                
                        if ($data[0]["batiment"]!= NULL)
                        {
                            ?>
                            value="<?php echo $data[0]["batiment"]; ?>"
                            <?php
                        }
                    }
                ?>       
            />
        </article>
    </section>

    <section class="flex-row-left formulaireSoumissionAdmin">
        
        <!-- ADRESSE CIVIQUE ------------------------------------------------------------------------>
        <article>
            <label for="adresseCiviqueOeuvreAjoutAdmin">Adresse civique : </label>
            <input type="text" name="adresseCiviqueOeuvreAjout" id="adresseCiviqueOeuvreAjoutAdmin"
                <?php 
                    if(isset($_GET["idSoumissionUsager"]))                                                          // si ajout d'une soumission d'un usager, écrit l'adresse dans le input TEXT
                    {
                        ?>
                        value="<?php echo $data['adresseCiviqueSoumission']; ?>"
                        <?php
                    }

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification", écrit l'adresse dans le input TEXT
                    {           
                        if ($data[0]["adresseCivique"]!= NULL)
                        {
                            ?>
                            value="<?php echo $data[0]["adresseCivique"]; ?>"
                            <?php
                        }  
                    }
                ?> 
            />
        </article>
    </section>

    <section class="flex-row-left formulaireSoumissionAdmin">
        
        <!-- LATITUDE ------------------------------------------------------------------------------>
        <article class="formulaireSoumissionAdminGauche">
            <label for="latitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Latitude : </span></label>
            <input type="text" name="latitudeOeuvreAjout" id="latitudeOeuvreAjoutAdmin" placeholder= "45.0000"
                <?php 

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification", écrit la latitude dans le input TEXT
                    {                               
                        if ($data[0]["latitude"]!= NULL)
                        {
                            ?>
                            value="<?php echo $data[0]["latitude"]; ?>"
                            <?php
                        } 
                    }
                ?>
            />
        </article>
    
        <article class="espaceHaut10">
            
            <!-- LONGITUDE -------------------------------------------------------------------------->
            <label for="longitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Longitude : </span></label>
            <input type="text" name="longitudeOeuvreAjout" id="longitudeOeuvreAjoutAdmin" placeholder= "-73.0000"
                <?php 

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification", écrit la longitude dans le input TEXT
                    {                       
                        if ($data[0]["longitude"]!= NULL)
                        {
                            ?>
                            value="<?php echo $data[0]["longitude"]; ?>"
                            <?php
                        } 
                    }
                ?>       
            />
        </article>
    </section>

    <!-- SECTION PHOTO ------------------------------------------------------------------------------>
    <h3 class="espaceH3">PHOTO(S)</h3>

    <section class="flex-column-left formulaireSoumissionAdmin">
        
    <?php 
        
        /*-- AJOUT D'UNE PHOTO SOUMISE PAR UN USAGER -----------------------------------------------*/
        if($_GET['requete'] == "soumission" && isset($_GET['idSoumissionUsager']))
        {
            if($data["photoSoumission"] != "" || $data["photoSoumission"] != null){
            ?> 
                <article>
                    <input type="hidden" name="urlPhotoOeuvreAjout" id="urlPhotoOeuvreAjoutAdmin" value="<?php echo $data['photoSoumission']; ?>"/>
                    <img src="../images/<?php echo $data["photoSoumission"]; ?>" height="150" width="200" class="imgAfficheSoumissionsAdmin"/>
                    <article class="flex-row-left">
                        <label for="accepterPhotoSoumise">Accepter la photo soumise</label>
                        <input type="checkbox" name="accepterPhotoSoumiseCheckbox" id="accepterPhotoSoumise" value="photoSoumise" checked>
                    </article>
                </article>  
            <?php
            }
        }

        /*-- FORMULAIRE D'AJOUT ---------------------------------------------------------------------*/
        if($_GET['requete'] == "soumission" && !isset($_GET['idSoumissionUsager']))
        {
            ?>
            <article>
                <input type="hidden" name="urlPhotoOeuvreAjout" value=""/>
                <input type="hidden" name="accepterPhotoSoumiseCheckbox">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="photoOeuvreSoumissionAdmin">Photo (.jpg) : </label>
                <input type="file" name="photoOeuvreSoumission" id="photoOeuvreSoumissionAdmin" accept="image/jpeg"/>
            </article>
            <?php
        }
   
        /*-- MODIFICATION D'UNE OEUVRE ---------------------------------------------------------------*/
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
            ?> 
            <article>
                <?php
                    foreach($data[1] as $photo)
                    {	
                        if($photo["idPhoto"] != null)
				        {	
                            ?>
                            <article class="suppressionPhoto">
                                <img src="../images/<?php echo $photo["urlPhoto"]; ?>" height="80" width="115"/>
                                Supprimer cette photo
                                <input type="checkbox" name="supprimerPhotoCheckbox" id="supprimerPhoto" value="<?php echo $photo["idPhoto"]; ?>">
                            </article>
                            <?php
                        }
                    }
				?> 
            </article>
            <article class="formulaireSoumissionAdmin">
                <input type="hidden" name="urlPhotoOeuvreAjout" value=""/>
                <input type="hidden" name="accepterPhotoSoumiseCheckbox">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <label for="nouvellePhotoOeuvreAdmin">Ajouter une photo : </label>
                <input type="file" name="nouvellePhotoOeuvre" id="nouvellePhotoOeuvreAdmin"/><br/>
            </article>
            <?php
        }
        ?> 
    </section> 

    <!-- SECTION DESCRIPTION -------------------------------------------------------------------------->
    <h3 class="espaceH3">DESCRIPTION</h3>

    <textarea rows="4" style="width: 337px;" name="descriptionOeuvreAjout" id="descriptionOeuvreAjoutAdmin"><?php
        if(isset($_GET["idSoumissionUsager"]))                                                                      // si ajout d'une soumission d'un usager, écrit la description dans le input TEXTAREA
        {
            echo $data['descriptionSoumission'];
        }
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                                         // si "modification", écrit la description dans le input TEXTAREA
        {
            if ($data[0]["description"]!= NULL)
            {
                ?>
                value="<?php echo $data[0]["description"]; ?>"
                <?php
            } 
        }
    ?></textarea>

    <span id="msgErreurSoumision"></span>

<!-- FIN DE LA SECTION DU FORMULAIRE ------------------------------------------------------------------->
</section>
