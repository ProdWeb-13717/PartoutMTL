<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- SECTION CATÉGORIES DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres -------------------------------->    

        <label for="categorieOeuvreAjoutAdmin">CATÉGORIE : </label>
        <select name="categorieOeuvreAjout" id="categorieOeuvreAjoutAdmin">
			<option value="#">Options</option>
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
