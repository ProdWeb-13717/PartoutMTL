<section class="liste">
	<h1>Liste des artistes</h1>
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
					}
				?>
				</li>
			</ul>
		</div>
		<?php
			}
		?>
</section>