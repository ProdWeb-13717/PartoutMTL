<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- FIN DE LA SOUMISSION D'UNE OEUVRE, BOUTON SOUMISSION ------------------------------------------->

    <input type="button" class="bouton" id="boutonSoumission" value="SOUMETTRE" name="boutonSoumission"/>   
</div>