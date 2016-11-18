<section class="liste">
	<section class="liste">
	<h1>Liste des oeuvres</h1>
		<?php
			foreach($data as $oeuvre)
			{
		?>
		<div class="elemListe">
			<img src="
			<?php 
				if($oeuvre["urlPhoto"] != null)
				{
					echo $oeuvre["urlPhoto"];
				}
				else if($oeuvre["urlPhoto"] == null)
				{
					echo "http://galaxy.mobity.net/uploads/148/logo/1399898656.png";
				}
			?>"/>
			<ul>
				<li><span class="catElemListe">ID : </span><?php echo $oeuvre["noOeuvre"]?></li>
				<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
				<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>

			</ul>
		</div>
		<?php
			}
		?>
</section>
	
