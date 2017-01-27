<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories -------------------------------------------> 


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<div class="marginDivPrincipale adminTitre"> 

	<section class="flex-column-left ">
		<h1>LES IMAGES DU CARROUSEL</h1>
		<?php
		if($data)
		{
			foreach($data as $carroussel)
			{	
				
				//$monUtilisateur = $utilisateur["idOeuvre"];
				?>
				<section id='<?php echo $carroussel["idCaroussel"]?>' class="elemListe flex-column-left espaceHaut10">
					
					<article class="">
						<h3 class="typoValeurAdmin"><?php echo $carroussel["titre"]?>  </h3>
						<img src="../images/<?php echo $carroussel["urlPhoto"]; ?>" height="220" width="345"/>
					</article>
					
					<article  class="liens espaceHaut10 flex-row-left">
						<a href="./index.php?requete=suprimerImageCarroussel&idCaroussel=<?php echo $carroussel["idCaroussel"]?>">SUPPRIMER</a>
					</article>
					
					<article>
					
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