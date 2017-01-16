<!--Variables pour se retrouver dans le dénombrement des résultats de la variable $data-->
<?php
$precendent = 0;        // permettra de savoir l'ID de l'oeuvre traité précédemment

$nbreMaxElement = 20;   //nombre maximum de résultats par pages

$nbrePages = 1; //Nombre total de pages

$elemCourant = 1;       //Rang d'un élément dans un pages
$tableauAllOeuvres = []; 	//tableau associatif qui contiendra toutes les oeuvres pour ensuite les ordonner en ordre alphabétique
$sansTitreIndex = 1;

//On construit le tableau de toutes les oeuvres qu'on mettra en ordre alphabétique après
foreach($data[0] as $photo)
{	
	$precendent = $photo["idOeuvre"];
	$listeAuteur = []; 		//tableau qui contiendra tous les auteurs
	$titreConstruit = "";	//titre en voie de construction
	
	//on crée un tableau vide dans $tableauAllOeuvres qui a le titre de l'oeuvre comme clé (pour les ordonner alphabétiquement plus tard)
	
	if($photo["titre"] == "Sans titre")
	{
		$titreConstruit = $photo["titre"].$sansTitreIndex;
		$sansTitreIndex++;
	}
	else
	{
		$titreConstruit = $photo["titre"];
	}
	
	$tableauAllOeuvres[$titreConstruit] = [];
	
	if(array_key_exists ( "titre" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["titre"] = $photo["titre"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "id" on la crée et on y l'id l'oeuvre
	if(array_key_exists ( "idOeuvre" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["idOeuvre"] = $photo["idOeuvre"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "url" on la crée et on y l'URL de la photo de l'oeuvre
	if(array_key_exists ( "urlPhoto" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["urlPhoto"] = $photo["urlPhoto"];
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "annee" on la crée et on y insère l'année de création de l'oeuvre
	if(array_key_exists ( "dateFinProduction" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["dateFinProduction"] = $photo["dateFinProduction"];
	}
	
	//On construit la liste des auteurs
	foreach($data[1] as $oeuvre)
	{
		if($oeuvre["idOeuvre"] == $precendent)
		{

			$nom = ""; //nom à rentrer dans la liste d'auteur
			
			if($oeuvre["prenomArtiste"] != "")
			{
				$nom = $oeuvre["prenomArtiste"];
				
				if($oeuvre["nomArtiste"] != "")
				{
					$nom = $nom." ".$oeuvre["nomArtiste"];
				}
			}
			
			else if($oeuvre["nomArtiste"] != "")
			{
				$nom = $oeuvre["nomArtiste"];
			}
			
			else if($oeuvre["collectif"] != "" && ($oeuvre["prenomArtiste"] == "" && $oeuvre["nomArtiste"] == ""))
			{
				$nom = $oeuvre["collectif"]." (collectif)";
			}
			
			array_push($listeAuteur,$nom);
		}
		
	}
	
	// si le tableau  qui a le titre de l'oeuvre comme clé ne contient pas le clé "auteur" on la crée et on y l'URL de la photo de l'oeuvre
	if(array_key_exists ( "auteur" , $tableauAllOeuvres[$titreConstruit]) == false)
	{
		$tableauAllOeuvres[$titreConstruit]["auteur"] = $listeAuteur;
	}
}
ksort($tableauAllOeuvres);
//print_r($tableauAllOeuvres);
//print_r($data[0]);
?>

<!--Construire la liste en divisant les résultats en page de 20 résultats-->
<section id="liste">
	<h1 id="oeuvres" >Liste des oeuvres</h1> <!-- id pour recherche -->

	<div class="pageListe" id="page1">
	<?php
		foreach($tableauAllOeuvres as $oeuvre)
		{
			?>
				<div class="elemListe">
					<a href="./index.php?requete=afficheOeuvre&idOeuvre=<?php echo $oeuvre["idOeuvre"]?>">
                        
                        <article class="photoOeuvre">
                            <?php 
                                if($oeuvre["urlPhoto"] != null)
                                {	
                                    ?>
                                    <img src="./admin/images/<?php echo $oeuvre["urlPhoto"]; ?>" height="80" width="115"/>
                                    <?php
                                }
                                else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
                                {	
                                    ?>
                                    <img src="./admin/images/image_default_oeuvre_4.jpg" alt="image default" height="80">
                                    <?php
                                }
						  ?>
                        </article>
                    
						<ul>
							<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
							<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>
							<li><span class="catElemListe">Auteur(s):</span>
								<ul class="listeAuteur">
									<?php
									foreach($oeuvre["auteur"] as $artiste)
									{	
										?>
											<li><?php echo $artiste ?></li>
										<?php
									}
									?>
								</ul>
							</li>
						</ul>
					</a>
				</div>
			<?php
			
			$elemCourant++;
			if($elemCourant > $nbreMaxElement)
			{
				$nbrePages++;
				$elemCourant = 1;
				?>
					</div>
					<div class="pageListe pageCache" id="<?php echo "page".$nbrePages;?>">
				<?php	
			}
		}
	?>
	
</section>
<section id="secPagination">	
	<?php
		for($i = 1 ; $i <= $nbrePages ; $i++)
		{	
			?>
				<span id="<?php echo $i;?>" class="pageBalise
					<?php
						if($i == 1)
						{
							echo " pageSelect";
						}
					
					?>
				"> <?php echo $i; ?> </span>
			<?php
		}
	?>
</section>
