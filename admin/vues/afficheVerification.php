 <?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<br>
<ul>

	<li>Quantité des artistes pendant la mise à jour: <?php echo $data["Artistes"]?> </li>
	<li>Quantité des arrondissements pendant la mise à jour: <?php echo $data["Arrondissements"]?></li>
	<li>Quantité des catégories pendant la mise à jour: <?php echo $data["Categories"]?></li>
	<li>Quantité des oeuvres pendant la mise à jour: <?php echo $data["Oeuvres"]?></li>
	
</ul>
<br>