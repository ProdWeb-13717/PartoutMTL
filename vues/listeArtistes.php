<section class="liste">
	<h1>Liste Artistes</h1>
		<?php
			foreach($data as $artiste)
			{
		?>
		<div class="elemListe">
			<ul>
				<li><span class="catElemListe">ID : </span><?php echo $artiste["idArtiste"]?></li>
				<?php
					if($artiste["prenomArtiste"] != "")
					{
				?>
					<li><span class="catElemListe">Nom : </span>
				<?php
					echo $artiste["prenomArtiste"];
					}
		
					if($artiste["nomArtiste"] != null)
					{
						echo " ".$artiste["nomArtiste"];
					}
				?>
					</li>
				<?php
					if($artiste["collectif"] != null)
					{
						if($artiste["prenomArtiste"] != null && $artiste["nomArtiste"] != null)
						{
				?>
					<li><span class="catElemListe">Membre du collectif : </span>
				<?php				
							echo $artiste["collectif"];
							
						}
						else if ($artiste["prenomArtiste"] == null && $artiste["nomArtiste"] == null)
						{
				?>
					<li><span class="catElemListe">Nom (collectif) : </span>
				<?php
							echo $artiste["collectif"];
						}
					}
					
				?>
			</ul>
		</div>
		<?php
			}
		?>
</section>