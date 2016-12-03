<?php
/**
 * Class Vue
 * Modèle de classe Vue. Dupliquer et modifier pour votre usage.
 * 
 * @author Jonathan Martel
 * @version 1.1
 * @update 2013-12-11
 * @update 2016-01-22 : Adaptation du code aux standards de codage du département de TIM
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 * 
 */


class Vueimportation 
{
	public function afficheAccueil() 
	{
		?>
		<div>
		<a href="index.php?requete=importation">Allez ver l'importation de donnés</a>
		</div>
		<?php
	}

	public function affichePied()
	{
				?>
				<div id="footer">
						Certains droits réservés @ Jonathan Martel (2013)<br>
						Sous licence Creative Commons (BY-NC 3.0)
					</div>
				</div>	
			</body>
		</html>
		<?php
	}
	
}

?>