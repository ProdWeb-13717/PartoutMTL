<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
	
	/// *** SECURITE DE LA PAGE 2 *** /////////////////////////
	if($_SESSION["niveauAdmin"] != 1)
	{
		header('Location: ./index.php');
	}
	///////////////////////////////////////////////////////////
?>

<div class="permissionAdmin marginDivPrincipale adminTitre">
    <h1>ADMINISTRATION</h1>
    
    
    
</div>