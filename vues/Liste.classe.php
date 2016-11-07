<?php
/**
 * Class Vue
 * Modèle de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */


class vueListe{

	/**
	 * Produit l'entête html
	 * @access public
	 * @return void
	 */
	 
	 //fonction qui affiche une liste de tous les artistes
	 //Inclue : ID dans la base de donnée,Prénom, Nom,
	 //Éventuellement divisé en pages
	public function afficheListeArtiste($rechercheResultat) {
	 
	 ?>
		<section class="liste">
			<ul>
				<?php
					foreach($rechercheResultat as $artiste)
					{
				?>
				
				<li>
					<?php echo $artiste["idArtiste"]." : ".$artiste["prenomArtiste"]." ".["nomArtiste"]?>
				</li> 
				
				<?php
					}
				?>
			</ul>
		</section>
	<?php
	}
	
	
	//fonction qui affiche une liste de toutes les oeuvres
	 //Inclue : titre, auteur, année de finde production, photo
	 //Éventuellement divisé en pages
	public function afficheListeOeuvre($rechercheResultat) {
     ?>
        <section class="liste">
			<ul>
				<?php
					foreach($rechercheResultat as $oeuvre)
					{
				?>
						<li>
							<ul class="resultatOeuvre">
								<li><img src="<?php echo $oeuvre["urlPhoto"]?>"/></li>
								<li><?php echo "Titre: "$oeuvre["titre"]?></li>
								<li><?php echo "Auteur: "$oeuvre["prenomArtiste"]." ".$oeuvre["nomArtiste"]?></li>
								<li><?php echo "Année: "$oeuvre["dateFinProduction"]?></li>
							</ul>
						</li>  
				<?php
					}
				?>
			</ul>
		</section>

	<?php
	}
		
}
?>