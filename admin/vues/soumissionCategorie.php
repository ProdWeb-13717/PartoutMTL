<!-- SECTION CATÉGORIES DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres -------------------------------->    

        <label for="categorieOeuvreAjoutAdmin">CATÉGORIE : </label>
        <select name="categorieOeuvreAjout" id="categorieOeuvreAjoutAdmin">
			<?php
			/*-- pour toutes les datas récupérées de la table Catégories -----------------------------------*/
			foreach($data as $categorie)
			{
				?>
				<option value="<?php echo $categorie['idCategorie']?>"> <?php echo $categorie["nomCategorie"]?> </option>
				<?php
			}
			?>
        </select>
        <br/>