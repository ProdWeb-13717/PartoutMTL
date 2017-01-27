<!-- AFFICHAGE DU MENU ADMNISTRATEUR ---------------------------------------------------------------->


<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<?php
	$onglets = 
	[
		'oeuvresAdmin' => "",
        'affichage' => "",
		'importation'  => "", 
        'permissionAdmin' => ""
	];
	$onglets[$_SESSION['ongletActif']] = 'actif';
?>	 

<nav id="menuAdmin" class="menu">
    <ul class="row menu">
        <li class="<?php echo $onglets['oeuvresAdmin']; ?>" ><a href="index.php?requete=oeuvresAdmin">OEUVRES</a></li>
        <li class="<?php echo $onglets['affichage']; ?>" ><a href="index.php?requete=affichage">AFFICHAGE</a></li>
        <li class="<?php echo $onglets['importation']; ?>" ><a href="index.php?requete=importation">IMPORTATION</a></li> 
		<?php
            if($_SESSION["niveauAdmin"] == 1)
			{
				?>
				<li class="<?php echo $onglets['permissionAdmin']; ?>" ><a href="index.php?requete=permissionAdmin">ADMIN</a></li>
				<?php
			}
		?>
    </ul>     
</nav>


