<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SECTION ARRONDISSEMENTS DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------->    

<h3 class="espaceH3">LIEU</h3>

<section class="flex-row-left formulaireSoumissionAdmin">  
    <article>
        <label for="arrondissementOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Arrondissement : </span></label>
        <select name="arrondissementOeuvreAjout" id="arrondissmentOeuvreAjoutAdmin">
            <option value="#">Options</option>
            <?php
            /*-- pour toutes les datas récupérées de la table Arrondissements ------------------------------*/                                     
                
            foreach($data as $arrondissement)                                       
            {
                if (isset($arrondissement['idArrondissement']))
                {
                ?>
                    <option value="<?php echo $arrondissement['idArrondissement']; ?>"
                    <?php       
                        if(isset($_GET["idSoumissionUsager"]))
                        {
                            if($arrondissement['idArrondissement'] == $data['choix'])
                            {
                                ?>
                                selected
                                <?php     
                            };
                        }
                        
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                        {
                            if($arrondissement['idArrondissement'] == $data['choix'])
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
