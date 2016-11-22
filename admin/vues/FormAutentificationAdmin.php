<?php
	$message = "";
	/*
	if(isset($_SESSION["authentifie"]))
	{
		 unset($_SESSION["authentifie"]);
		 $_SESSION["action"] = "";
		 header("Location: index.php");
	}
	*/
		
	if(!isset($_SESSION["grainDeSel"]))
	{
		$_SESSION["grainDeSel"] = rand(1, 10000);
	}
	/*
	if(isset($_POST["usager"]) && isset($_POST["pass"]))
	{
		$motDePasseMD5 = MotDePasse($_POST["usager"]);
		$motDePasseGrainSel = md5($motDePasseMD5 . $_SESSION["grainDeSel"]);
	
		if($motDePasseGrainSel == $_POST["pass"])
		{
			$_SESSION["authentifie"] = $_POST["usager"];
			echo $_SESSION["authentifie"];
			$location = "register";
			$_SESSION["action"] = "register";
			header("Location: index.php");
			//echo "SESSION['authentifie']";
		}
		else
			$message = "Mauvaise combinaison usager/pass";
	}
	*/
?>	
	<script type="text/javascript" src="./js/md5.js"></script>
	<script type="text/javascript"> 
		(function()
		{
			window.addEventListener('load', function()
			{
				document.getElementById('BoutonEncrypte').addEventListener('click', encrypte);
			});
	
		})();
		
		function encrypte()
		{
			if((document.autentificationForm.pass.value != "" && document.autentificationForm.pass.value != null) && (document.autentificationForm.usager.value != "" && document.autentificationForm.usager.value != null))
			{
				var passEncrypte = md5(document.autentificationForm.pass.value);
				var grainSel = document.autentificationForm.grainSel.value;
				var passPlusGrainSel = md5(passEncrypte + grainSel);
							
				var usager = document.autentificationForm.usager.value;			
				
				document.formEncrypte.pass.value = passPlusGrainSel;
				document.formEncrypte.usager.value = usager;
				document.formEncrypte.submit();			
			}
		}
		
		
	</script>
	<div class="largeur100 flex-column margin-hauteur100">
		<form name="autentificationForm" method="POST">
			NOM USAGER : <input type="text" name="usager"/>	
			<br><br>
			MOT DE PASSE :  <input type="password" name="pass"/>	
			<input type="hidden" name="grainSel" value="<?php echo $_SESSION["grainDeSel"];?>"/>
			<br><br><br>
			<input type="button" value="soumettre" id="BoutonEncrypte" class="bouton"/>
		</form>
	</div>
	<form name="formEncrypte" method="POST" action="index.php?requete=AutentificationAdmin">
		<input type="hidden" name="usager"/>		
		<input type="hidden" name="pass"/>		
	</form>
	<span><?php echo $message;?></span>
	<br>
