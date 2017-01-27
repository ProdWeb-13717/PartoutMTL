<?php	
	if(!isset($_SESSION["grainDeSel"]))
	{
		$_SESSION["grainDeSel"] = rand(1, 10000);
	}
?>	
	<script type="text/javascript"> 
		(function()
		{
			window.addEventListener('load', function()
			{
				document.getElementById('BoutonEncrypte').addEventListener('click', encrypte);
			});
	
		})();
	</script>
		
	<div class="largeur100 margin-hauteur100">
		<form class="autentificationForm" name="autentificationForm" method="POST">
			<label for="usager">
				<input type="text" name="usager"/>
				<br>
				NOM USAGER
			</label>
			<br><br>
			<label for="pass">
				<input type="password" name="pass"/>	
				<br>
				MOT DE PASSE
			</label>
			<input type="hidden" name="grainSel" value="<?php echo $_SESSION["grainDeSel"];?>"/>
			<br><br><br>
			<input type="button" value="SOUMETTRE" id="BoutonEncrypte" class="bouton"/>
		</form>
	</div>
	<form name="formEncrypte" method="POST" action="index.php?requete=AutentificationAdmin">
		<input type="hidden" name="usager"/>		
		<input type="hidden" name="pass"/>		
	</form>
	<br>
