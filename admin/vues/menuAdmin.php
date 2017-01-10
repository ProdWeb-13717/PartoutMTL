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
		'gestion' => "",
		'ajoutOeuvre'  => "", 
		'soumission'  => "", 
		'importation'  => "", 
        'listeOeuvresAdmin' => "",
        'permissionAdmin' => ""
	];
	$onglets[$_SESSION['ongletActif']] = 'actif';
?>	 

<nav id="menuAdmin" class="menu">
    <ul class="row menu">
        <li class="<?php echo $onglets['gestion']; ?>" ><a href="index.php?requete=gestion">GESTION</a></li>
        <li class="<?php echo $onglets['ajoutOeuvre']; ?>" ><a href="index.php?requete=soumission">AJOUT D'OEUVRE</a></li>
        <li class="<?php echo $onglets['soumission']; ?>" ><a href="index.php?requete=soumissionsDesUsagers">SOUMISSIONS</a></li>
        <li class="<?php echo $onglets['importation']; ?>" ><a href="index.php?requete=importation">IMPORTATION</a></li> 
        <li class="<?php echo $onglets['listeOeuvresAdmin']; ?>" ><a href="index.php?requete=listeOeuvresAdmin">OEUVRES</a></li>
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


