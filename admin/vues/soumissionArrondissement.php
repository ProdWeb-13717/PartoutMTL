    <label for="arrondissementOeuvreAjoutAdmin">ARRONDISSEMENT : </label>
    <select name="arrondissementOeuvreAjout" id="arrondissmentOeuvreAjoutAdmin">
    <?php
    foreach($data as $arrondissement)
    {
    ?>
        <option value="<?= $arrondissement['idArrondissement']?>"> <?= $arrondissement["nomArrondissement"]?> </option>
    <?php
    }
    ?>
    </select>
    <br/>