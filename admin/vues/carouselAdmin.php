<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories -------------------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<div class="categorie marginDivPrincipale adminTitre"> 
    <h1>CARROUSEL</h1>
    <section class="flex-row-left">
        
        <!-- AJOUTER UNE CATÉGORIE ------------------------------------------------------------------->
        <article class="espaceADroite10">
            <h3>AJOUTER UNE IMAGE</h3>
            <label for="AjoutImageCarrousel" class="labelCategorie">Nom : </label>
            <input type="text" name="categorieAjout" id="AjoutCategorieAdmin"/>
            <input type="button" class="bouton2" id="boutonAjoutCategorie" value="AJOUTER" name="boutonAjoutCategorie"/>
        </article>
    
        <!-- SUPPRIMER UNE CATÉGORIE ----------------------------------------------------------------->
        
    </section>
    <span id="msgErreurCarrousel"></span>
	
	<section class="flex-column-left listeAdministateur">
		<h1>LES IMAGES DU CARROUSEL</h1>
		<br>
		<?php
		if($data)
		{
			foreach($data as $carrousel)
			{	
				
				//$monUtilisateur = $utilisateur["idOeuvre"];
				?>
				<section class="elemListe flex-row-space espaceHaut10">
				
					<article class="photoOeuvre">
						 <img src="../images/<?php echo $carrousel["urlPhoto"]; ?>" height="80" width="115"/>
					</article>
					
					<article class="informationOeuvre">
						<ul>
							<li><span class="catElemListe">titre :   </span><span class="typoValeurAdmin"><?php echo $carrousel["titre"]?>  </span></li>
							<li><span class="catElemListe">lien (url) :      </span><span class="typoValeurAdmin"><?php echo $carrousel["urlLien"]?>&nbsp;<?php echo $utilisateur["nomAdmin"]?></span></li>
							<li><span class="catElemListe">description :      </span><span class="typoValeurAdmin"><?php echo $carrousel["description"]?></span></li>
						</ul>
					</article>
					
					<article  class="liens espaceHaut10 flex-row-left">
						<a href="./index.php?requete=supprimeImageCarrousel&idCaroussel=<?php echo $carrousel["idCaroussel"]?>">SUPPRIMER</a>
					</article>
					
				</section>
				<?php
				
			}
		}
		else
		{
			?>
			<span>le carrousel ne coutien aucune image présentement</span>
			<?php
		}
		?>
    </section>
    
</div>