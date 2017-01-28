<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories -------------------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<div class=" marginDivPrincipale adminTitre"> 

    <section class="flex-row-left">
        
        <!-- AJOUTER UNE CATÉGORIE ------------------------------------------------------------------->
        <article class="espaceADroite10">
            <h1>AJOUTER UNE IMAGE AU CARROUSEL</h1>
			<form method="POST" id="carrousselAjoutForm" action="index.php?requete=ajouterImageCarroussel">

				<?php
				$nb = 0;
				foreach($data as $photo)
				{
					if($nb%4 <= 0)
					{
						?>
						<br>
						<?php
					}
					?>
					<input type="hidden" name="idOeuvre" class="idOeuvre" value="<?php echo $photo['idOeuvre']; ?>"/>
					<h3 name="carrousselAjoutTitre" id="carrousselAjoutTitre">
						<?php 
                            $modelCarroussel = new Carroussel();
                            $titrePhoto = $modelCarroussel->obtenirTitreImages($photo['idOeuvre']);
                            echo $titrePhoto;
                        ?>
                    </h3>
					
					<br>
					<label for="choixPhoto">
						<input type="radio" name="choixPhoto" class="choixPhoto" value="<?php echo $photo['idPhoto']; ?>"/>
					
						<img src="../images/<?php echo $photo["urlPhoto"]; ?>" height="60" width="110"/>
					</label>
					<br>
					<br>
					<?php
					
					$nb++;
				}
				
				?>
				<br>
				<input type="submit" class="bouton2" id="boutonAjoutCarroussel" value="AJOUTER" name="boutonAjoutCarroussel"/>
				</form>
        </article>  
    </section>
	
    
</div>