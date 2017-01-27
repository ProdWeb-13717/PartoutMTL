
	<script type="text/javascript"> 
		(function()
		{
			window.addEventListener('load', function()
			{
				document.getElementById('pass').addEventListener('input', nouveauMDP);
				document.getElementById('pass2').addEventListener('input', verificationMDP);
				document.getElementById('BoutonChangeMDP').addEventListener('click', encrypte2);
			});
			var m1 = false;
			var m2 = false;
			function changementMotDePasse()
			{
				if(m1 && m2)
				{
					console.log("allloooo");
				}
			}
			
			function nouveauMDP(evt)
			{
				//console.log(evt.target.value);
				var erreur = document.getElementById('nouveauPassErreur');
				erreur.innerHTML = "";
				erreur.style.color = "red";
				//erreur.appendChild(document.createTextNode(' ' + evt.target.value)); 
				evt.target.style.color = 'red';
				
				var restriction1  = /([\w\W]{1,}[\w]{1,}[\w\W]{1,}){2,5}/g;
				var test1 = restriction1.test(evt.target.value);
				
				var restriction2  = /[A-Z]./g;
				var test2 = restriction2.test(evt.target.value);
				
				if(test1 && test2)
				{
					erreur.style.color = "green";
					erreur.innerHTML = "";
					//erreur.appendChild(document.createTextNode(' * ')); 
					evt.target.style.color = 'green';
					m1 = true;
				}
				
				
				
			}
			
			function verificationMDP(evt)
			{
				var pass = document.getElementById('pass').value;
				//console.log(evt.target.value);
				var erreur = document.getElementById('verificationPassErreur');
				erreur.innerHTML = "";
				erreur.style.color = "red";
				//erreur.appendChild(document.createTextNode(' ' + evt.target.value)); 
				
				if(pass == evt.target.value)
				{
					erreur.style.color = "green";
					erreur.innerHTML = "";
					//erreur.appendChild(document.createTextNode(' * ')); 
					evt.target.style.color = 'green';
					m2 = true;
				}	
				
			}

			function encrypte2()
			{
				var passEncrypte = md5(document.changementMDP.pass.value);		
				var usager = document.changementMDP.usager.value;			
				
				document.formEncrypte.pass.value = passEncrypte;
				document.formEncrypte.usager.value = usager;
				document.formEncrypte.submit();			
			}
		
	
	
		})();
	</script>
<div class="categorie marginDivPrincipale adminTitre"> 
    <h1>MODIFIER VOTRE MOT DE PASSE</h1>
	<div class="largeur100 margin-hauteur100">
		<form class="changementMDP" name="changementMDP" method="POST">
			<label for="pass">NOUVEAU MOT DE PASSE </label><input type="password" id="pass" name="pass"/><span id="nouveauPassErreur" ></span>	
			<br>
			<br>
			<label for="pass2">CONFIRMATION </label><input type="password" id="pass2" name="pass2"/><span id="verificationPassErreur" ></span>
			<input type="hidden" name="usager" value="<?php echo $_POST["usager"];?>"/>
			<br><br><br>
			<input type="button" value="SOUMETTRE" id="BoutonChangeMDP" class="bouton"/>
		</form>
	</div>
	<form name="formEncrypte" method="POST" action="index.php?requete=changerMotDePasse">
		<input type="hidden" name="usager"/>		
		<input type="hidden" name="pass"/>		
	</form>
	<span>* Votre mot de passe doit comprendre minimalement 6 carractères et commencer par une lettre</span>
	<br>
</div>

