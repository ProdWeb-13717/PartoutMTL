<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- AFFICHE LES DÉTAILS DE LA SOUMISSION POUR CONFIRMER SES ENTRÉES -------------------------------->


<div class="afficheSoumissionsAdmin adminTitre">    
    <?php
        if($_GET['requete'] == "updateModification")
        {
           echo "<h1>MODIFICATION COMPLÉTÉE</h1>";
        }
        else
        {
            echo "<h1>SOUMISSION COMPLÉTÉE</h1>";
        }
    ?>

    <section class="flex-column-left">
        <h3>DÉTAILS</h3>
        <ul>
            <li>                        <span  class="typoValeurAdmin"><?php 
                                            if(isset($data['urlPhoto']) && $data['urlPhoto'] != "")
                                            {
                                                ?> 
                                                <img src="../images/<?php echo $data["urlPhoto"]; ?>" height="150" width="200" class="imgAfficheSoumissionsAdmin"/>
                                                <?php
                                            }
                                        ?>                                                                                                              </span></li> 
            
            <li>Titre :                 <span  class="typoValeurAdmin"><?php echo $data['titre']?>                                                      </span></li>
            <li>Titre variante :        <span  class="typoValeurAdmin"><?php if(isset($data['titreVariante'])) {echo $data['titreVariante'];}?>         </span></li>
            <li>Prénom :                <span  class="typoValeurAdmin"><?php if(isset($data['prenomArtiste'])) {echo $data['prenomArtiste'];}?>         </span></li>
            <li>Nom :                   <span  class="typoValeurAdmin"><?php if(isset($data['nomArtiste'])) {echo $data['nomArtiste'];}?>               </span></li>
            <li>Collectif :             <span  class="typoValeurAdmin"><?php if(isset($data['collectif'])) {echo $data['collectif'];}?>                 </span></li>
            <li>Catégorie :             <span  class="typoValeurAdmin">
                                        <?php 
                                            $modeleSoumisionAdmin = new modeleSoumission();
                                            $nomCategorieOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($data['idCategorie'],'idCategorie',"Categories");
                                            echo $nomCategorieOeuvreEnSoumission['nomCategorie'];
                                        ?>                                                                                                              </span></li>
            <li>Fin de production :     <span  class="typoValeurAdmin"><?php if(isset($data['dateFinProduction'])) {echo $data['dateFinProduction'];}?> </span></li>
            <li>Date d'accession :      <span  class="typoValeurAdmin"><?php if(isset($data['dateAccession'])) {echo $data['dateAccession'];}?>         </span></li>
            <li>Collection :            <span  class="typoValeurAdmin"><?php if(isset($data['nomCollection'])) {echo $data['nomCollection'];}?>         </span></li>
            <li>Mode d'acquisition :    <span  class="typoValeurAdmin"><?php if(isset($data['modeAcquisition'])) {echo $data['modeAcquisition'];}?>     </span></li>
            <li>Matériaux :             <span  class="typoValeurAdmin"><?php if(isset($data['materiaux'])) {echo $data['materiaux'];}?>                 </span></li>
            <li>Technique :             <span  class="typoValeurAdmin"><?php if(isset($data['technique'])) {echo $data['technique'];}?>                 </span></li>
            <li>Dimensions :            <span  class="typoValeurAdmin"><?php if(isset($data['dimensions'])) {echo $data['dimensions'];}?>               </span></li>
            <li>Arrondissement :        <span  class="typoValeurAdmin">
                                        <?php 
                                            $modeleSoumisionAdmin = new modeleSoumission();
                                            $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($data['idArrondissement'],'idArrondissement',"Arrondissements");
                                            echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                                        ?>                                                                                                              </span></li>
            <li>Parc :                  <span  class="typoValeurAdmin"><?php if(isset($data['parc'])) {echo $data['parc'];}?>                           </span></li>
            <li>Bâtiment :              <span  class="typoValeurAdmin"><?php if(isset($data['batiment'])) {echo $data['batiment'];}?>                   </span></li>
            <li>Adresse civique :       <span  class="typoValeurAdmin"><?php if(isset($data['adresseCivique'])) {echo $data['adresseCivique'];}?>       </span></li>
            <li>Latitude :              <span  class="typoValeurAdmin"><?php if(isset($data['latitude'])) {echo $data['latitude'];}?>                   </span></li>
            <li>Longitude :             <span  class="typoValeurAdmin"><?php if(isset($data['longitude'])) {echo $data['longitude'];}?>                 </span></li>
            
            
            <li>Description :           <span  class="typoValeurAdmin"><?php if(isset($data['description'])) {echo $data['description'];}?>             </span></li>
        </ul> 
    </section>
        
    <article  class="liens">
        <a href="./index.php?requete=listeOeuvresAdmin">LISTE DES OEUVRES</a>
    </article>
</div>
