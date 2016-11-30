<!-- SECTION ARRONDISSEMENTS DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------->    
    
        <label for="arrondissementOeuvreAjoutAdmin">ARRONDISSEMENT : </label>
        <select name="arrondissementOeuvreAjout" id="arrondissmentOeuvreAjoutAdmin">
			<option value="#">Options</option>
            <?php
			/*-- pour toutes les datas récupérées de la table Arrondissements ------------------------------*/
			foreach($data as $arrondissement)                                       
			{
				?>
				<option value="<?php echo $arrondissement['idArrondissement']?>"> <?php echo $arrondissement["nomArrondissement"]?> </option>
				<?php
			}
			?>
        </select>
        <br/>