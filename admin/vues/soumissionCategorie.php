<!-- SECTION CATÉGORIES DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SECTION DÉTAILS -------------------------------------------------------------------------------->
<h3 class="espaceH3">DÉTAILS</h3>

<section class="flex-row-left formulaireSoumissionAdmin">
    
    <!-- CATÉGORIES (OBLIGATOIRE) ------------------------------------------------------------------->
    <article class="formulaireSoumissionAdminGauche">
        <label for="categorieOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Catégorie : </span></label>
        <select name="categorieOeuvreAjout" id="categorieOeuvreAjoutAdmin">
            <option value="#">Options</option>
            <?php
            /*-- pour toutes les datas récupérées de la table Catégories ---------------------------*/
            foreach($data as $categorie)
            {
                if (isset($categorie['idCategorie']))
                {
                ?>
                    <option value="<?php echo $categorie['idCategorie']?>"
                    <?php       
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                         // si "modification"
                        {
                            if($categorie['idCategorie'] == $data['choix'])                                         // sélectionne la catégorie
                            {
                                ?>
                                selected
                                <?php     
                            };
                        }
                    ?>> <?php echo $categorie["nomCategorie"]?> </option>
                    <?php
                }
            }
            ?>
        </select>
    </article>
    

