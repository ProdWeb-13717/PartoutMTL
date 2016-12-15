<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<br>
<div class="optionBDContainer">
	<form class ="form" id="forMisaJour" method="GET">
		<fieldset>
		<legend> Verification</legend>
		<label>Verifier s'il existe des oeuvres non mise à jour</label>
		<br>
		<input type="hidden" name="requete" value="verification"/>
		<input class ="bouton" type="submit" name="Verification" value="Verification"/><br/><br/>
		</fieldset>
	</form>
	<br>
	<form class ="form" id="formVerification" method="GET">
		<fieldset>
		<legend> Mise a Jour</legend>
		<label>Importer la BD au complet du site des données publics de Montréal</label>
		<br>
		<input type="hidden" name="requete" value="importationok"/>
		<input class ="bouton" type="submit" name="Importer" value="Mise à jour"/><br/><br/>
		</fieldset>
	</form>
</div>
<br>