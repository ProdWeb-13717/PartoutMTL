<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- AFFICHE LES DÉTAILS DE LA SOUMISSION POUR CONFIRMER SES ENTRÉES -------------------------------->

<section class="soumissionOk margin100">

    <h1>SOUMISSION COMPLÉTÉE</h1>
    <h2>DÉTAILS</h2>
    <ul>
        <li>TITRE :                     <?php echo $data['titre']?>                                                     </li>
        <li>TITRE VARIANTE :            <?php if(isset($data['titreVariante'])) {echo $data['titreVariante'];}?>        </li>
        <li>PRÉNOM DE L'ARTISTE :       <?php if(isset($data['prenomArtiste'])) {echo $data['prenomArtiste'];}?>        </li>
        <li>NOM DE L'ARTISTE :          <?php if(isset($data['nomArtiste'])) {echo $data['nomArtiste'];}?>              </li>
        <li>COLLECTIF :                 <?php if(isset($data['collectif'])) {echo $data['collectif'];}?>                </li>
        <li>CATÉGORIE :                 <?php 
                                            $modeleSoumisionAdmin = new modeleSoumission();
                                            $nomCategorieOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($data['idCategorie'],'idCategorie',"Categories");
                                            echo $nomCategorieOeuvreEnSoumission['nomCategorie'];
                                        ?>                                                                              </li>
        <li>DATE FIN DE PRODUCTION :    <?php if(isset($data['dateFinProduction'])) {echo $data['dateFinProduction'];}?></li>
        <li>DATE D'ACCESSION :          <?php if(isset($data['dateAccession'])) {echo $data['dateAccession'];}?>        </li>
        <li>COLLECTION DE L'OEUVRE :    <?php if(isset($data['nomCollection'])) {echo $data['nomCollection'];}?>        </li>
        <li>MODE D'ACQUISTION :         <?php if(isset($data['modeAcquisition'])) {echo $data['modeAcquisition'];}?>    </li>
        <li>MATÉRIAUX :                 <?php if(isset($data['materiaux'])) {echo $data['materiaux'];}?>                </li>
        <li>TECHNIQUE :                 <?php if(isset($data['technique'])) {echo $data['technique'];}?>                </li>
        <li>DIMENSIONS :                <?php if(isset($data['dimensions'])) {echo $data['dimensions'];}?>              </li>
        <li>ARRONDISSEMENT :            <?php 
                                            $modeleSoumisionAdmin = new modeleSoumission();
                                            $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($data['idArrondissement'],'idArrondissement',"Arrondissements");
                                            echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                                        ?>                                                                              </li>
        <li>PARC :                      <?php if(isset($data['parc'])) {echo $data['parc'];}?>                          </li>
        <li>BÂTIMENT :                  <?php if(isset($data['batiment'])) {echo $data['batiment'];}?>                  </li>
        <li>ADRESSE CIVIQUE :           <?php if(isset($data['adresseCivique'])) {echo $data['adresseCivique'];}?>      </li>
        <li>LATITUDE :                  <?php if(isset($data['latitude'])) {echo $data['latitude'];}?>                  </li>
        <li>LONGITUDE :                 <?php if(isset($data['longitude'])) {echo $data['longitude'];}?>                </li>
        <li>URL PHOTO :                 <?php if(isset($data['urlPhoto'])) {echo $data['urlPhoto'];}?>                  </li>
        <li>DESCRIPTION :               <?php if(isset($data['description'])) {echo $data['description'];}?>            </li>
    </ul>
    <!-- La modification d'une oeuvre sera une des tâches du sprint 2 -->
    <input type="button" value="MODIFIER" disabled />  
</section>
