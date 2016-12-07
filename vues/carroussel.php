<?php
	$compteur = count($data);
	$imagesURL = "";

	foreach($data as $url)
	{
	$imagesURL = $imagesURL + $url["urlPhoto"]) + "~";
	}

?>

<script>
	window.onload = function()
	{
		var toutURL = document.getElementById("toutURL").split('~');
		var taille = toutURL.length;
		var compteur = 0;
		var imgSlider = document.getElementById("imgSlider");
		
		setTimeout(function()
		{
			if(((compteur + 1)%taille) != 0)
			{
				imgSlider.src = toutURL[compteur];
			}
			else
			{
				
			}
		}, 3000);
	}
</script>

<section id="carroussel">
	<input type = "hidden" id="toutURL" value = "<?php echo $image?>"/>
	<div id="slider">
	<img id="imgSlider">
	</div>
</section>