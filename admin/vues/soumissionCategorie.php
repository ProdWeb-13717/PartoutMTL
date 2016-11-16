    <label for="categorieOeuvreAjoutAdmin">CATÉGORIE : </label>
    <select name="categorieOeuvreAjout" id="categorieOeuvreAjoutAdmin">
    <?php
    foreach($data as $categorie)
    {
    ?>
        <option value="<?= $categorie['idCategorie']?>"> <?= $categorie["nomCategorie"]?> </option>
    <?php
    }
    ?>
    </select>
    <br/>