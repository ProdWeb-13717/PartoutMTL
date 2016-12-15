<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories ------------------------------------------->

<section class="gestionAdmin">
    <section class="gestionAdminCategorie">
        <h1>CATÉGORIE</h1>
        <h3>AJOUTER UNE CATÉGORIE</h3>
        <label for="AjoutCategorieAdmin">NOM : </label>
        <input type="text" name="categorieAjout" id="AjoutCategorieAdmin"/><br/>
        <input type="button" class="bouton" id="boutonAjoutCategorie" value="AJOUTER" name="boutonAjoutCategorie"/> 
    </section>
    <section>
        <h3>SUPPRIMER UNE CATÉGORIE</h3>
        <select name="categorieSuppression" id="SuppressionCategorieAdmin">
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
        </select><br/>
        <input type="button" class="bouton" id="boutonSuppressionCategorie" value="SUPPRIMER" name="boutonSuppressionCategorie"/> 
    </section>
</section>