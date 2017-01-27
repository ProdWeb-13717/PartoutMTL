<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- DIVISION GLOBALE ------------------------------------------------------------------------------>
<div class="soumissionAdmin marginDivPrincipale adminTitre">
    
    <!-- VÉRIFIE L'URL, LE FORMULAIRE EST UTILISÉ POUR L'AJOUT ET LA MODIFICATION D'OEUVRE --------->
    <?php
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                                     // si "modification"
        {
           echo "<h1>MODIFIER UNE OEUVRE</h1>";
        }
        else                                                                                                    // si "ajout"
        {
            echo "<h1>AJOUTER UNE OEUVRE</h1>";
        }
    ?>
    
    <!-- SECTION DU FORMULAIRE --------------------------------------------------------------------->
    <section class="flex-column-left">
        <!-- SECTION OEUVRE ------------------------------------------------------------------------>
        <h3>OEUVRE</h3>
        
        <!-- ID ------------------------------------------------------------------------------------>
        <input type="hidden" name="idOeuvreAModifie" id="idOeuvreAModifieAdmin"
            <?php
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                             // si "modification"
                {
                    foreach($data as $oeuvre)                                                                   // récupère id de l'oeuvre
                    {
                    ?>
                        value="<?php echo $oeuvre['idOeuvre']; ?>"                                              
                    <?php
                    }
                }
            ?>
        /> 
        
        <section class="flex-row-left formulaireSoumissionAdmin">    
            
            <!-- TITRE (OBLIGATOIRE) --------------------------------------------------------------->
            <article class="formulaireSoumissionAdminGauche">
                <label for="titreOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Titre : </span></label>
                <input type="text" name="titreOeuvreAjout" id="titreOeuvreAjoutAdmin" 
                    <?php 
                        if(isset($_GET["idSoumissionUsager"]))                                                  // si ajout d'une soumission d'un usager, écrit le titre dans le input TEXT
                        {
                            ?>
                            value="<?php echo $data['titreSoumission']; ?>"
                            <?php
                        }
                    
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                     // si "modification", écrit le titre de l'oeuvre dans le input TEXT
                        {
                            foreach($data as $oeuvre)
                            {
                                ?>
                                value="<?php echo $oeuvre['titre']; ?>"
                                <?php
                            }
                        }
                    ?>  
                />
            </article>
            
            <!-- TITRE VARIANTE -------------------------------------------------------------------->
            <article class="espaceHaut10">
                <label for="titreVarianteOeuvreAjoutAdmin">Titre variante : </label>
                <input type="text" name="titreVarianteOeuvreAjout" id="titreVarianteOeuvreAjoutAdmin"
                    <?php                   
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))                     // si "modification"
                        {
                            foreach($data as $oeuvre)
                            {
                                if ($oeuvre['titreVariante'] != NULL){                                          // s'il y a un titre variante, écrit le titre variante dans le input TEXT
                                    ?>
                                    value="<?php echo $oeuvre['titreVariante']; ?>"
                                    <?php
                                }
                            }
                        }
                    ?>          
                />
            </article>
        </section>
        
        
        