<?php
    $nbrePage = 1;          // compte le nombre total de pages
    $nbreMaxElement = 20;   //nombre maximum de résultats par pages
    $elemCourant = 1;       //Rang d'un élément dans un pages
    $elemTotal = 0;         //Nombre total de résultats dans la liste

?>

<!--Script pour afficher une page quand on clique son onglet correspondant-->
<script>
	window.onload = function() {
		var secListe = document.getElementById("liste");
		secListe.addEventListener("click",function(){
			var eTarget = event.target;
			if(eTarget.nodeName == "SPAN" && eTarget.classList.contains("pageBalise"))
			{
				var idVisible = eTarget.id;
				
				var toutePages= document.querySelectorAll("div.pageListe");
				
				for(var i = 0 ; i < toutePages.length ; i++)
				{
					toutePages[i].classList.add("pageCache");
				}
				
				$pageVisible = document.getElementById("page"+idVisible);
				$pageVisible.classList.remove("pageCache");
			}
		});
	};

</script>

<section id="liste">
	<h1>Liste des artistes</h1>
    <span class="pageBalise" id="1">
    <?php
		if(count($data) <= 20)
		{
			echo "*** Résultat 1 à ".count($data[0])." ***";
		}
		else
		{
			echo "*** Résultat 1 à 20 ***";
		}
	?>
	</span>
    <br>
    <div class="pageListe" id="page1">
	<?php
	$inconnu="<span class='inconnu'>(non-applicable)</span>";
	foreach($data as $artiste)
	{
		?>
		<hr>
		<div class="elemListe">
			<input type="hidden" class="idArtiste" value="<?php echo $artiste["idArtiste"]?>">
			<div class="rondListe"></div>
			<ul>
				<li><span class="catElemListe">Prénom : </span>
					<?php
						if($artiste["prenomArtiste"] != null)
						{
							echo $artiste["prenomArtiste"];
						}
						else if($artiste["prenomArtiste"] == "")
						{
							echo $inconnu;
						}
					?>
				</li>
				<li><span class="catElemListe">Nom : </span>
					<?php
						if($artiste["nomArtiste"] != null)
						{
							echo " ".$artiste["nomArtiste"];
						}
						else if($artiste["nomArtiste"] == null)
						{
							echo $inconnu;
						}
					?>
				</li>
				<?php
				if($artiste["collectif"] != null)
				{
					?>
					<li><span class="catElemListe">Collectif : </span>
					<?php				
						echo $artiste["collectif"];
					?>
					</li>
					<?php
				}
				?>
			</ul>
		</div>
		<?php
            $elemTotal++;
			$elemCourant++;
			if($elemCourant > $nbreMaxElement)
			{
				$nbrePage++;
				$elemCourant = 1;
				?>
					</div>
					<span class="pageBalise" id="<?php echo $nbrePage;?>">
					<?php
						echo"*** Résultat ".($elemTotal+1)." à ".($elemTotal+$nbreMaxElement)." ***";
					?>
					</span>
					<br>
					<div class="pageListe pageCache" id="<?php echo "page".$nbrePage;?>">
				<?php	
			}
	}
	?>
    </div>
</section>