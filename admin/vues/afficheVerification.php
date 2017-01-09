 <?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<div class="verificationBD marginDivPrincipale adminTitre">
    <h1>BASE DE DONNÉES</h1>
    <section class="flex-row-left">
        <ul>
            <li>Quantité de nouveaux artistes : <?php echo $data["Artistes"]?> </li>
            <li>Quantité de nouvelles oeuvres : <?php echo $data["Oeuvres"]?></li>
            <li>Quantité de nouveaux arrondissements : <?php echo $data["Arrondissements"]?></li>
            <li>Quantité de nouvelles catégories : <?php echo $data["Categories"]?></li>
        </ul>
        <article class="liens droit">
            <a href="index.php?requete=importation">RETOUR VERS IMPORTATION</a>
        </article>
    </section>
</div>

