<br>
<div class="optionBDContainer">
	<form class ="form" id="forMisaJour" method="GET">
		<fieldset>
		<legend> Verification</legend>
		<label>Verifier s'il existe des oeuvres non mis à jour</label>
		<br>
		<input type="hidden" name="requete" value="verification"/>
		<input class ="bouton" type="submit" name="Verification" value="Verification"/><br/><br/>
		</fieldset>
	</form>
	<br>
	<form class ="form" id="formVerification" method="GET">
		<fieldset>
		<legend> Mis a Jour</legend>
		<label>Importer la BD au complet du site des données publics de Montréal</label>
		<br>
		<input type="hidden" name="requete" value="importationok"/>
		<input class ="bouton" type="submit" name="Importer" value="Mis à jour"/><br/><br/>
		</fieldset>
	</form>
</div>
<br>