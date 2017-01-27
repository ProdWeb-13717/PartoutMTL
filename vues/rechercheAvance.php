<div id="barRecherche">
	<form method="POST">
        <p>Liste : </p>
        <select class="selectRechercheAvance" id="categorieRecherche"  name="categorie">
			<option value="" >Séléctionner</option>
			<option value="Artistes" >Artiste</option>
			<option value="Oeuvres"  >Oeuvre</option>
		</select>
		<label id="labelSouCategorie" style="display:none;">
			<p> : </p>
            <select class="selectRechercheAvance" name="souCategorie" id="souscategorieRecherche" ></select>
		</label>
            <input id='motRechercheAvance' class="espaceHaut30" placeholder="" name="rechercheOeuvre" type='text' disabled />
            <input type="button" class="espaceHaut30" id="btnRechercheAvance" value="Rechercher"/>
		<!--div id="boiteRecherche"></div-->
	</form>
</div>
<p id="msgResultat"><p>