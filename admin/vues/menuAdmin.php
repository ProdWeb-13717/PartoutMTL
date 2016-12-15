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
				'carroussel'  => "",
                'listeOeuvresAdmin' => ""
			];
			$onglets[$_SESSION['ongletActif']] = 'actif';
		?>	 
		
		
		<nav id="menuAdmin" class="menu">
            <ul class="row menu">
                <li class="<?php echo $onglets['gestion']; ?>" ><a href="index.php?requete=gestion">GESTION</a></li>
                <li class="<?php echo $onglets['ajoutOeuvre']; ?>" ><a href="index.php?requete=soumission">AJOUT D'OEUVRE</a></li>
                <li class="<?php echo $onglets['soumission']; ?>" ><a href="index.php?requete=soumissionsDesUsagers">SOUMISSIONS USAGER</a></li>
                <li class="<?php echo $onglets['importation']; ?>" ><a href="index.php?requete=importation">importation BD</a></li> 
                <li class="<?php echo $onglets['carroussel']; ?>" ><a href="index.php?requete=carroussel">CARROUSSEL</a></li>
                <li class="<?php echo $onglets['listeOeuvresAdmin']; ?>" ><a href="index.php?requete=listeOeuvresAdmin">LISTE</a></li>
            </ul>     
        </nav>

