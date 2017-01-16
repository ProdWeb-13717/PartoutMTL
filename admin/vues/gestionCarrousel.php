 <?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<div class="marginDivPrincipale adminTitre"> 
    <h1>CARROUSEL</h1>

    
</div>