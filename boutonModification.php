<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- FIN DE LA MODIFICATION D'UNE OEUVRE, BOUTON MODIFICATION ------------------------------------------->

    <input type="button" class="bouton" id="boutonSoumission" value="MODIFIER" name="boutonSoumission"/>
    
</div>