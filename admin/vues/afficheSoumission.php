<!-- AFFICHE LES DÉTAILS DE LA SOUMISSION POUR CONFIRMER SES ENTRÉES -------------------------------->

<div class="soumissionOk margin100">

    <h1>SOUMISSION COMPLÉTÉE</h1>
    <h2>DÉTAILS</h2>
    
    TITRE :                     <?php echo $data['titre']?><br/>
    TITRE VARIANTE :            <?php if(isset($data['titreVariante'])) {echo $data['titreVariante'];}?><br/>
    PRÉNOM DE L'ARTISTE :       <?php if(isset($data['prenomArtiste'])) {echo $data['prenomArtiste'];}?><br/>
    NOM DE L'ARTISTE :          <?php if(isset($data['nomArtiste'])) {echo $data['nomArtiste'];}?><br/>
    COLLECTIF :                 <?php if(isset($data['collectif'])) {echo $data['collectif'];}?><br/>
    CATÉGORIE :                 <?php $modeleSoumisionAdmin = new modeleSoumission();
                                      $nomCategorieOeuvreEnSoumission = $modeleSoumisionAdmin->obtenirNomCategorie($data['idCategorie']);
                                      echo $nomCategorieOeuvreEnSoumission;?><br/>
    DATE FIN DE PRODUCTION :    <?php if(isset($data['dateFinProduction'])) {echo $data['dateFinProduction'];}?><br/>
    DATE D'ACCESSION :          <?php if(isset($data['dateAccession'])) {echo $data['dateAccession'];}?><br/>
    COLLECTION DE L'OEUVRE :    <?php if(isset($data['nomCollection'])) {echo $data['nomCollection'];}?><br/>
    MODE D'ACQUISTION :         <?php if(isset($data['modeAcquisition'])) {echo $data['modeAcquisition'];}?><br/>
    MATÉRIAUX :                 <?php if(isset($data['materiaux'])) {echo $data['materiaux'];}?><br/>
    TECHNIQUE :                 <?php if(isset($data['technique'])) {echo $data['technique'];}?><br/>
    DIMENSIONS :                <?php if(isset($data['dimensions'])) {echo $data['dimensions'];}?><br/>
    ARRONDISSEMENT :            <?php $modeleSoumisionAdmin = new modeleSoumission();
                                      $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenirNomArrondissement($data['idArrondissement']);
                                      echo $nomArrondissementOeuvreEnSoumission;?><br/>
    PARC :                      <?php if(isset($data['parc'])) {echo $data['parc'];}?><br/>
    BÂTIMENT :                  <?php if(isset($data['batiment'])) {echo $data['batiment'];}?><br/>
    ADRESSE CIVIQUE :           <?php if(isset($data['adresseCivique'])) {echo $data['adresseCivique'];}?><br/>
    LATITUDE :                  <?php if(isset($data['latitude'])) {echo $data['latitude'];}?><br/>
    LONGITUDE :                 <?php if(isset($data['longitude'])) {echo $data['longitude'];}?><br/>
    URL PHOTO :                 <?php if(isset($data['urlPhoto'])) {echo $data['urlPhoto'];}?><br/>
    DESCRIPTION :               <?php if(isset($data['description'])) {echo $data['description'];}?><br/>
    <br/>
    
    <!-- La modification d'une oeuvre sera une des tâches du sprint 2 -->
    <input type="button" value="MODIFIER" disabled />  

</div>