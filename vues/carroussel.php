<?php
	$imagesURL = "";
	$longueur = count($data);
	
	//var_dump($data);
	
	/*foreach($data as $url)
	{
		//echo $url["urlPhoto"];
		$imagesURL = $imagesURL.$url["urlPhoto"]."~";
	}*/
	
	for ($i = 0 ; $i < $longueur ; $i++)
	{
		$imagesURL = $imagesURL.$data[$i]["urlPhoto"];
		if($i != ($longueur-1))
		{
			$imagesURL = $imagesURL."~";
		}
	}

?>

<script>
	window.onload = function()
	{
		var toutURL = document.getElementById("toutURL").value;
		console.log(toutURL);
		var toutURL = toutURL.split('~');
		console.log(toutURL);
		var taille = toutURL.length;
		console.log(taille);
		var compteur = 0;
		var imgSlider = document.getElementById("imgSlider");
		
		setInterval(function()
		{
			console.log("toto");
			if(((compteur + 1)%taille) != 0)
			{
				console.log(compteur+" on monte");
				imgSlider.src = toutURL[compteur];
				compteur++;
			}
			else if(((compteur + 1)%taille) == 0)
			{
				console.log(compteur+" on recommence");
				imgSlider.src = toutURL[compteur];
				compteur = 0;
			}
		}, 3000);
	}
</script>

<section id="carroussel">
	<input type = "hidden" id="toutURL" value = "<?php echo $imagesURL?>"/>
	<div id="slider">
		<img id="imgSlider" src = "<?php echo $data[0]["urlPhoto"]?>">
	</div>
</section>