<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->

<div class="soumissionAdmin marginDivPrincipale adminTitre">
    <?php
        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
        {
           echo "<h1>MODIFIER UNE OEUVRE</h1>";
        }
        else
        {
            echo "<h1>AJOUTER UNE OEUVRE</h1>";
        }
    ?>
    <section class="flex-column-left">
        <h3>OEUVRE</h3>
        
        <input type="hidden" name="idOeuvreAModifie" id="idOeuvreAModifieAdmin"
            <?php
                if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                {
                    foreach($data as $oeuvre)
                    {
                    ?>
                        value="<?php echo $oeuvre['idOeuvre']; ?>"
                    <?php
                    }
                }
            ?>
        /> 
        
        <section class="flex-row-left formulaireSoumissionAdmin">  
            <article class="formulaireSoumissionAdminGauche">
                <label for="titreOeuvreAjoutAdmin"><span class="couleurErreurSoumission">Titre : </span></label>
                <input type="text" name="titreOeuvreAjout" id="titreOeuvreAjoutAdmin" 
                    <?php 
                        if(isset($_GET["idSoumissionUsager"]))
                        {
                            ?>
                            value="<?php echo $data['titreSoumission']; ?>"
                            <?php
                        }
                    
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
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
            
            <article class="espaceHaut10">
                <label for="titreVarianteOeuvreAjoutAdmin">Titre variante : </label>
                <input type="text" name="titreVarianteOeuvreAjout" id="titreVarianteOeuvreAjoutAdmin"
                    <?php                   
                        if($_GET['requete'] == "modifieOeuvre" && isset($_GET['idOeuvre']))
                        {
                            foreach($data as $oeuvre)
                            {
                                if ($oeuvre['titreVariante'] != NULL){
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
        
        
        