<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories ------------------------------------------->

<div class="gestionAdmin">
    <section class="gestionAdminCategorie">
        <h1>AJOUTER UNE CATÉGORIE</h1>
        <label for="AjoutCategorieAdmin">NOM : </label>
        <input type="text" name="categorieAjout" id="AjoutCategorieAdmin"/><br/>
        <input type="button" class="bouton" id="boutonAjoutCategorie" value="AJOUTER" name="boutonAjoutCategorie"/> 
        
        <h1>SUPPRIMER UNE CATÉGORIE</h1>
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
        <hr/>
    </section>
</div>