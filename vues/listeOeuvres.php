<?php
$precendent = "";

?>

<section class="liste">
	<h1>Liste des oeuvres</h1>
		<?php
			foreach($data as $oeuvre)
			{	
				if($precendent != $oeuvre["noOeuvre"])
				{
					$precendent = $oeuvre["noOeuvre"];
		?>		
				<hr> <!--hr de noemi-->
				<div class="elemListe">
				<br>
					<input type="hidden" class="idOeuvre" value="<?php echo $oeuvre["noOeuvre"]?>"/>
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
						<li><span class="catElemListe">Titre : </span><?php echo $oeuvre["titre"]?></li>
						<li><span class="catElemListe">Année : </span><?php echo $oeuvre["dateFinProduction"]?></li>
						<li><span class="catElemListe">Auteur(s):</span>
							<ul class="listeAuteur">
							<?php
								foreach($data as $artiste)
								{	
									if($artiste["noOeuvre"] == $precendent)
									{
							?>
								<li>
							<?php
										if($artiste["prenom"] != null)
										{
											echo $artiste["prenom"];
											
											if($artiste["nom"] != null)
											{
												echo " ".$artiste["nom"];
											}
										}
										
										if($artiste["collectif"] != null && ($artiste["prenom"] == null && $artiste["nom"] == null))
										{
											echo $artiste["collectif"];
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
					<br>
				</div>
		<?php
				}
			}
		?>
</section>