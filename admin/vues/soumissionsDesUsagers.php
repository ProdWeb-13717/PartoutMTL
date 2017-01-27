<!-- AFFICHAGE DES SOUMISSIONS DES USAGERS, TABLE Soumissions --------------------------------------->


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>    


<div class="soumissionsUsager marginDivPrincipale adminTitre">
    <h1>SOUMISSIONS DES USAGERS</h1>
	<section class="afficheSoumissionsUsagers">
        <ul>
            <?php
            /*-- LISTES DES OEUVRES SOUMISES ------------------------------------------------------*/
            foreach($data as $soumission)
            {
                ?>
                <ul class='soumissionDesUsagers' name='soumissionDunUsager' id="<?php echo $soumission['idSoumission']?>">
                    <section class="flex-row-left">       
                        
                        <!-- PHOTOS DES OEUVRES SOUMISES ------------------------------------------->
                        <article class="photoOeuvreSoumission">
				            <?php 
				                if($soumission["photoSoumission"] != null)
				                {	?>
				                	<img src="../images/<?php echo $soumission["photoSoumission"]; ?>" height="80" width="115"/>
				                	<?php
				                }
                                
				                else if($soumission["photoSoumission"] == null || $soumission["photoSoumission"] == "")
				                {	
				                	?>
				                	<img src="../images/image_default_oeuvre_4.jpg" alt="image default" height="80">
				                	<?php
				                }
				            ?>
                        </article>
                        
                        <!-- DÉTAILS DES OEUVRES SOUMISES, S'AFFICHE SI EXISTANTE ------------------>
                        <article class="soumissionDesUsagersListe">
                            
                            <!-- NUMÉRO DE LA SOUMISSION ------------------------------------------->
                            <li>
				                <span  class="numeroSoumission">
				                	SOUMISSION # <?php echo $soumission["idSoumission"]?>         
				                </span>
				            </li>
				            
                            <!-- TITRE (OBLIGATOIRE) ----------------------------------------------->
                            <li>Titre : <span  class="typoValeurAdmin"><?php echo $soumission["titreSoumission"]?></span></li>
                
                            <?php
                                /*-- PRÉNOM -------------------------------------------------------*/
                                if($soumission["prenomArtisteSoumission"])
                                {
                                    ?>
                                    <li>Prénom artiste : <span  class="typoValeurAdmin"><?php echo $soumission["prenomArtisteSoumission"]?></span></li>
                                    <?php   
                                }
                
                                /*-- NOM ----------------------------------------------------------*/
                                if($soumission["nomArtisteSoumission"])
                                {
                                    ?>
                                    <li>Nom artiste : <span  class="typoValeurAdmin"><?php echo $soumission["nomArtisteSoumission"]?></span></li>
                                    <?php   
                                }

                                /*-- COLLECTIF ----------------------------------------------------*/
                                if($soumission["collectifSoumission"])
                                {
                                    ?>
                                    <li>Collectif : <span  class="typoValeurAdmin"><?php echo $soumission["collectifSoumission"]?></span></li>
                                    <?php   
                                }
                
                                /*-- COLLECTIF ----------------------------------------------------*/
                                if($soumission["idArrondissementSoumission"])
                                {
                                    ?>
                                    <li>Arrondissements :   
				                    	<span  class="typoValeurAdmin">
                                            <?php 
                                                $modeleSoumisionAdmin = new modeleSoumission();
                                                $nomArrondissementOeuvreEnSoumission = $modeleSoumisionAdmin->obtenir($soumission['idArrondissementSoumission'],'idArrondissement',"Arrondissements");
                                                echo $nomArrondissementOeuvreEnSoumission['nomArrondissement'];
                                            ?> 
                                        </span>
				                    </li>
                                    <?php   
                                }

                                /*-- PARC ----------------------------------------------------------*/
                                if($soumission["parcSoumission"])
                                {
                                    ?>
                                    <li>Parc : <span  class="typoValeurAdmin"><?php echo $soumission["parcSoumission"]?></span></li>
                                    <?php   
                                }

                                /*-- ADRESSE CIVIQUE -----------------------------------------------*/
                                if($soumission["adresseCiviqueSoumission"])
                                {
                                    ?>
                                    <li>Adresse civique : <span  class="typoValeurAdmin"><?php echo $soumission["adresseCiviqueSoumission"]?></span></li>
                                    <?php   
                                }

                                /*-- DESCRIPTION ---------------------------------------------------*/
                                if($soumission["descriptionSoumission"])
                                {
                                    ?>
                                    <li>Description : <span  class="typoValeurAdmin"><?php echo $soumission["descriptionSoumission"]?></span></li>
                                    <?php   
                                }

                                /*-- PHOTO ---------------------------------------------------------*/
                                if($soumission["photoSoumission"])
                                {
                                    ?>
                                    <li>Photo : <span  class="typoValeurAdmin"><?php echo $soumission["photoSoumission"]?></span></li>
                                    <?php   
                                }
                            ?>
                    
                            <!-- COURRIEL (OBLIGATOIRE) --------------------------------------------->
                            <li>Courriel : <span  class="typoValeurAdmin"><?php echo $soumission["courrielSoumission"]?></span></li>
            
                        </article>
                        
                        <!-- OPTIONS DE GESTION POUR CHAQUE OEUVRE ---------------------------------->
                        <article  class="liens">
                            <a href="./index.php?requete=soumission&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">AJOUTER</a>
                            <a href="./index.php?requete=supprimeSoumissionUsager&idSoumissionUsager=<?php echo $soumission["idSoumission"]?>">SUPPRIMER</a>
                        </article>
                    </section>     
                </ul>
                <?php
            }
            ?>
        </ul>			
    </section>
</div>