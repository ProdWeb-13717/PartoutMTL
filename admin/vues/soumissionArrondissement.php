<!-- SECTION ARRONDISSEMENTS DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------> 

<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>
 

<!-- SECTION LIEU ----------------------------------------------------------------------------------->
<h3 class="espaceH3">LIEU</h3>

<section class="flex-row-left formulaireSoumissionAdmin">  
    <article>
        
        <!-- ARRONDISSEMENTS (OBLIGATOIRE) ---------------------------------------------------------->
        <label for="arrondissementOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Arrondissement : </span></label>
        <select name="arrondissementOeuvreAjout" id="arrondissmentOeuvreAjoutAdmin">
            <option value="#">Options</option>
            <?php
            /*-- pour toutes les datas récupérées de la table Arrondissements ----------------------*/                                        
            foreach($data as $arrondissement)                                       
            {
                if (isset($arrondissement['idArrondissement']))
                {
                ?>
                    <option value="<?php echo $arrondissement['idArrondissement']; ?>"
                    <?php       
                        if(isset($_GET["idSoumissionUsager"]))                                                          // si ajout d'une soumission d'un usager
                        {
                            if($arrondissement['idArrondissement'] == $data['choix'])                                   // sélectionne le choix de l'usager
                            {
                                ?>
                                selected
                                <?php     
                            };
                        }
                        
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification"
                        {
                            if($arrondissement['idArrondissement'] == $data['choix'])                                   // sélectionne l'arrondissement
                            {
                                ?>
                                selected
                                <?php     
                            };
                        }
                    ?>> <?php echo $arrondissement["nomArrondissement"]; ?> </option>
                <?php
                }
            }
            ?>
        </select>
    </article>
</section>
