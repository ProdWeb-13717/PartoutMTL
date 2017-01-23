<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SUITE DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------------------------->   


<?php
    //var_dump($data);
    //var_dump($data[0]["parc"]);
    //var_dump($data[1][0]["idPhoto"]);

/*
array(2) { [0]=> array(26) { ["idOeuvre"]=> string(4) "1290" ["titre"]=> string(3) "dfg" ["titreVariante"]=> string(0) "" ["dateFinProduction"]=> NULL ["dateAccession"]=> NULL ["nomCollection"]=> string(10) "Art public" ["modeAcquisition"]=> string(0) "" ["materiaux"]=> string(0) "" ["technique"]=> string(0) "" ["dimensions"]=> string(0) "" ["parc"]=> string(0) "" ["batiment"]=> string(0) "" ["adresseCivique"]=> string(0) "" ["latitude"]=> NULL ["longitude"]=> NULL ["description"]=> string(0) "" ["numeroAccession"]=> NULL ["noInterne"]=> NULL ["idCategorie"]=> string(2) "68" ["idArrondissement"]=> string(2) "72" ["idArtiste"]=> string(3) "973" ["prenomArtiste"]=> string(3) "dfg" ["nomArtiste"]=> string(0) "" ["collectif"]=> string(0) "" ["nomArrondissement"]=> string(39) "Côte-des-Neiges–Notre-Dame-de-Grâce" ["nomCategorie"]=> string(17) "Design industriel" } 
           [1]=> array(1) { [0]=> array(3) { ["idPhoto"]=> string(3) "393" ["urlPhoto"]=> string(13) "photo_393.jpg" ["idOeuvre"]=> string(4) "1290" } } }


array(1) { [0]=> array(26) { ["idOeuvre"]=> string(4) "1290" ["titre"]=> string(3) "dfg" ["titreVariante"]=> string(0) "" ["dateFinProduction"]=> NULL ["dateAccession"]=> NULL ["nomCollection"]=> string(10) "Art public" ["modeAcquisition"]=> string(0) "" ["materiaux"]=> string(0) "" ["technique"]=> string(0) "" ["dimensions"]=> string(0) "" ["parc"]=> string(0) "" ["batiment"]=> string(0) "" ["adresseCivique"]=> string(0) "" ["latitude"]=> NULL ["longitude"]=> NULL ["description"]=> string(0) "" ["numeroAccession"]=> NULL ["noInterne"]=> NULL ["idCategorie"]=> string(2) "68" ["idArrondissement"]=> string(2) "72" ["idArtiste"]=> string(3) "973" ["prenomArtiste"]=> string(3) "dfg" ["nomArtiste"]=> string(0) "" ["collectif"]=> string(0) "" ["nomArrondissement"]=> string(39) "Côte-des-Neiges–Notre-Dame-de-Grâce" ["nomCategorie"]=> string(17) "Design industriel" } }




array(2) { [0]=> array(26) { ["idOeuvre"]=> string(4) "1280" ["titre"]=> string(6) "xcvxcv" ["titreVariante"]=> string(0) "" ["dateFinProduction"]=> NULL ["dateAccession"]=> NULL ["nomCollection"]=> string(10) "Art public" ["modeAcquisition"]=> string(0) "" ["materiaux"]=> string(0) "" ["technique"]=> string(0) "" ["dimensions"]=> string(0) "" ["parc"]=> string(0) "" ["batiment"]=> string(0) "" ["adresseCivique"]=> string(0) "" ["latitude"]=> NULL ["longitude"]=> NULL ["description"]=> string(0) "" ["numeroAccession"]=> NULL ["noInterne"]=> NULL ["idCategorie"]=> string(2) "65" ["idArrondissement"]=> string(2) "83" ["idArtiste"]=> string(4) "1021" ["prenomArtiste"]=> string(4) "xzcz" ["nomArtiste"]=> string(0) "" ["collectif"]=> string(0) "" ["nomArrondissement"]=> string(7) "LaSalle" ["nomCategorie"]=> string(21) "Bois/menuiserie d'art" } 
           [1]=> array(2) { [0]=> array(3) { ["idPhoto"]=> string(3) "381" ["urlPhoto"]=> string(13) "photo_381.jpg" ["idOeuvre"]=> string(4) "1280" } [1]=> array(3) { ["idPhoto"]=> string(3) "380" ["urlPhoto"]=> string(13) "photo_380.jpg" ["idOeuvre"]=> string(4) "1280" } } }

array(1) { [0]=> array(26) { ["idOeuvre"]=> string(4) "1280" ["titre"]=> string(6) "xcvxcv" ["titreVariante"]=> string(0) "" ["dateFinProduction"]=> NULL ["dateAccession"]=> NULL ["nomCollection"]=> string(10) "Art public" ["modeAcquisition"]=> string(0) "" ["materiaux"]=> string(0) "" ["technique"]=> string(0) "" ["dimensions"]=> string(0) "" ["parc"]=> string(0) "" ["batiment"]=> string(0) "" ["adresseCivique"]=> string(0) "" ["latitude"]=> NULL ["longitude"]=> NULL ["description"]=> string(0) "" ["numeroAccession"]=> NULL ["noInterne"]=> NULL ["idCategorie"]=> string(2) "65" ["idArrondissement"]=> string(2) "83" ["idArtiste"]=> string(4) "1021" ["prenomArtiste"]=> string(4) "xzcz" ["nomArtiste"]=> string(0) "" ["collectif"]=> string(0) "" ["nomArrondissement"]=> string(7) "LaSalle" ["nomCategorie"]=> string(21) "Bois/menuiserie d'art" } }

*/

?>


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
                        //foreach($data as $oeuvre)
                        //foreach($data as $oeuvres => $oeuvre)    
                        //foreach($data[0] as $oeuvre)
                        //foreach ($data as $oeuvres) 
                        //{
/*
                            foreach ($data[0] as $oeuvre)
                            {
                                if ($oeuvre['parc'] != NULL)
                                {
                                    ?>
                                    value="<?php echo $oeuvre['parc']; ?>"
                                    <?php
                                }
                            }
*/
                        //}

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
    
        <article class="espaceHaut10">
            <label for="batimentOeuvreAjoutAdmin">Bâtiment : </label>
            <input type="text" name="batimentOeuvreAjout" id="batimentOeuvreAjoutAdmin"
                <?php  

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
/*
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['batiment'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['batiment']; ?>"
                                <?php
                            }
                        }
 */                   
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
/*
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['adresseCivique'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['adresseCivique']; ?>"
                                <?php
                            }
                        }
*/                         
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
        <article class="formulaireSoumissionAdminGauche">
            <label for="latitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Latitude : </span></label>
            <input type="text" name="latitudeOeuvreAjout" id="latitudeOeuvreAjoutAdmin" placeholder= "45.0000"
                <?php 

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
/*
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['latitude'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['latitude']; ?>"
                                <?php
                            }
                        }
*/                                  
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
            <label for="longitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Longitude : </span></label>
            <input type="text" name="longitudeOeuvreAjout" id="longitudeOeuvreAjoutAdmin" placeholder= "-73.0000"
                <?php 

                    if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                    {
/*
                        foreach($data as $oeuvre)
                        {
                            if ($oeuvre['longitude'] != NULL){
                                ?>
                                value="<?php echo $oeuvre['longitude']; ?>"
                                <?php
                            }
                        }
 */                       
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

    <h3 class="espaceH3">PHOTO(S)</h3>

    <section class="flex-column-left formulaireSoumissionAdmin">
        
    <?php  
        if($_GET['requete'] == "soumission" && isset($_GET['idSoumissionUsager']))
        {
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

    <h3 class="espaceH3">DESCRIPTION</h3>

    <textarea rows="4" style="width: 337px;" name="descriptionOeuvreAjout" id="descriptionOeuvreAjoutAdmin"><?php
        if(isset($_GET["idSoumissionUsager"]))
        {
            echo $data['descriptionSoumission'];
        }
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
/*
            foreach($data as $oeuvre)
            {
                if ($oeuvre['description'] != NULL)
                {
                    echo $oeuvre['description'];
                }
            }
*/
            if ($data[0]["description"]!= NULL)
            {
                ?>
                value="<?php echo $data[0]["description"]; ?>"
                <?php
            } 
        }
    ?></textarea>

    <span id="msgErreurSoumision"></span>

<!-- fin section class="flex-column-left" -->
</section>
