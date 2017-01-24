<!-- FIN DE LA MODIFICATION D'UNE OEUVRE, BOUTON MODIFICATION ---------------------------------------->


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


    <!-- BOUTON LORSQUE MODIFICATION ----------------------------------------------------------------->
    <input type="hidden" name="idSoumissionUsager" value=""/>
    <input type="button" class="bouton" id="boutonModification" value="MODIFIER" name="boutonSoumission"/>
    <article  class="liens">
        <a href="./index.php?requete=listeOeuvresAdmin">LISTE DES OEUVRES</a>
    </article>

<!-- FIN DE LA DIVISION GLOBALE ---------------------------------------------------------------------->
</div>