<section class="liste">
	<Table>
		<tr>
			<th><?php echo "ID"?><th>
			<th><?php echo "Titre"?><th>
			<th><?php echo "Année"?><th>
		</tr>
		<?php
			foreach($data as $oeuvre)
			{
		?>
		<tr>
			<td><?php echo $oeuvre["noOeuvre"]?></td>
			<td><?php echo $oeuvre["titre"]?></td>
			<td><?php echo $oeuvre["dateFinProduction"]?></td>
		</tr>
		<?php
			}
		?>
	</Table>
</section>