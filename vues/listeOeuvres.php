<?php
$precendent = 0;

?>

<section class="liste">
	<h1>Liste des oeuvres</h1>
		<?php
			foreach($data[0] as $oeuvre)
			{	
				if($oeuvre["noOeuvre"] != $precendent)
				{
					$precendent = $oeuvre["noOeuvre"];
		?>		
				<hr>
				<div class="elemListe">

					<input type="hidden" class="idOeuvre" value="<?php echo $oeuvre["noOeuvre"]?>"/>
					<img src="
					<?php 
						if($oeuvre["urlPhoto"] != null)
						{
							echo $oeuvre["urlPhoto"];
						}
						else if($oeuvre["urlPhoto"] == null || $oeuvre["urlPhoto"] == "")
						{
							echo "http://galaxy.mobity.net/uploads/148/logo/1399898656.png";
						}
					?>"/>
					<ul>
						<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
						<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>
						<li><span class="catElemListe">Auteur(s):</span>
							<ul class="listeAuteur">
							<?php
								foreach($data[1] as $artiste)
								{	
									if($artiste["noOeuvre"] == $precendent)
									{
							?>
								<li>
							<?php

										if($artiste["prenom"] != "")
										{
											echo $artiste["prenom"];
											
											if($artiste["nom"] != "")

											{
												echo " ".$artiste["nom"];
											}
										}
										
										if($artiste["collectif"] != "" && ($artiste["prenom"] == "" && $artiste["nom"] == ""))
										{
											echo $artiste["collectif"]." (collectif)";
										}
							?>
								</li>
							<?php
									}
								}
							?>
							</ul>
						</li>
					</ul>
				</div>
		<?php
				}
			}
		?>
</section>