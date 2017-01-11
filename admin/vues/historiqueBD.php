<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>


<!-- PAGE GESTION AJOUTER UNE CATÉGORIE, TABLE Categories ------------------------------------------->

<div class="marginDivPrincipale">

	<section class="categorie adminTitre">
		<h1>HISTORIQUE D'IMPORTATION DE DONNÉS</h1>
		<section class="flex-row-left">
			<table id="tablehistorique">
				<tr>
					<th class="tetetableau">Date et temps</th>
					<th class="tetetableau">Total Oeuvres</th>
					<th class="tetetableau">Administrateur</th>
				</tr>
				<?php
					$datalength = count($data);
					for($i=0;$i<$datalength;$i++)
					{
				?>
					<tr>
						<th><?php echo $data[$i]['dateMiseAJour']?></th>
						<th><?php echo $data[$i]['nbOeuvres']?></th>
						<th><?php echo $data[$i]['nomUsagerAdmin']?></th>
					</tr>
				<?php
					}
				?>
			</table>
		</section>
	</section>
	
</div>