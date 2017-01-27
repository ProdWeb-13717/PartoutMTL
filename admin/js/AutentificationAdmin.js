
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
		
	