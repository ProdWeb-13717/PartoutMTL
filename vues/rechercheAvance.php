<div id="barRecherche">
	<form method="POST">
		Liste: <select class="selectRechercheAvance" id="categorieRecherche"  name="categorie">
			<option value="" >Séléctioner</option>
			<option value="Artistes" >Artiste</option>
			<option value="Oeuvres"  >Oeuvre</option>
		</select>
		<label id="labelSouCategorie" style="display:none;">
			: <select class="selectRechercheAvance" name="souCategorie" id="souscategorieRecherche" ></select>
		</label>
		<input id='motRechercheAvance' placeholder="" name="rechercheOeuvre" type='text' disabled />
		
		<input type="button" id="btnRechercheAvance" value="Rechercher"/>
		<!--div id="boiteRecherche"></div-->
	</form>
</div>
<p id="msgResultat"><p>