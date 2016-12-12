<?php
	$imagesURL = "";
	$titreCar = "";
	$descrCar = "";
	$longueur = count($data);

	for ($i = 0 ; $i < $longueur ; $i++)
	{
		$imagesURL = $imagesURL.$data[$i]["urlPhoto"];
		if($i != ($longueur-1))
		{
			$imagesURL = $imagesURL."~";
		}
		
		$titreCar = $titreCar.$data[$i]["titre"];
		if($i != ($longueur-1))
		{
			$titreCar = $titreCar."~";
		}
		
		$descrCar = $descrCar.$data[$i]["description"];
		if($i != ($longueur-1))
		{
			$descrCar = $descrCar."~";
		}
		
	}

?>

<div id="carousel"> 
		<div id="barRechercheAccueil" style="background=url('+toutURL[compteurCar ]+') no-repeat center center fixed">
			<input type = "hidden" id="toutURL" value = "<?php echo $imagesURL?>"/>
			<input type = "hidden" id="toutTitre" value = "<?php echo $titreCar?>"/>
			<input type = "hidden" id="toutDescr" value = "<?php echo $descrCar?>"/>
			<form class="rechercheAcceuil">
				<input id='motRecherche' placeholder="Rechercher une oeuvre/ un(e) artiste" name="rechercheOeuvre" type='text'  />	
				<input type="button" id="btnRecherche" value="Rechercher"/>
			</form>
			
			<span id="descrCar"></span>
		</div>
</div>