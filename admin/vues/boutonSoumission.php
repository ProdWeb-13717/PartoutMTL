<!-- FIN DE LA SOUMISSION D'UNE OEUVRE, BOUTON SOUMISSION ------------------------------------------->

<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<?php
    /*-- BOUTON LORSQUE AJOUT D'UNE SOUMISSION -----------------------------------------------------*/
    
    if($_GET['requete'] == "soumission" && !isset($_GET['idSoumissionUsager']))
    {
        ?>
        <input type="hidden" name="idSoumissionUsager" value=""/>
        <input type="button" class="bouton" id="boutonAjout" value="SOUMETTRE" name="boutonAjout"/>
        <?php
    }
    
    /*-- BOUTON LORSQUE AJOUT D'UNE SOUMISSION D'UN USAGER -----------------------------------------*/
    if($_GET['requete'] == "soumission" && isset($_GET['idSoumissionUsager']))
    {
        ?>
        <input type="hidden" name="idSoumissionUsager" value="<?php echo $_GET['idSoumissionUsager']?>"/>
        <input type="button" class="bouton" id="boutonSoumission" value="SOUMETTRE" name="boutonSoumission"/>
        <?php
    }
?>

<!-- FIN DE LA DIVISION GLOBALE ---------------------------------------------------------------------->
</div>


