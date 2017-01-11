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
    <h1>AJOUTER UN ADMINISTRATEUR</h1>
    <section class="flex-column-left ajoutAdministateur">
		<article class="espaceADroite10">
			<br>
			<div class="formGestionAdministrateurs espaceDroite10">
				<h4>INFORMATION DE L'UTILISATEUR</h4>
				<div class=" formAjoutAdminInfo flex-row-left">
					<div class="espaceHaut10">
						<label for="AjoutAdminPrenom" class="labelAjoutAdmin">
							<input type="text" name="AjoutAdminPrenom" id="AjoutAdminPrenom"/>
							prenom
						</label>
						<label for="AjoutAdminNom" class="labelAjoutAdmin">
							<input type="text" name="AjoutAdminNom" id="AjoutAdminNom"/>
							nom 
						</label>
						<label for="AjoutAdminUsager" class="labelAjoutAdmin">
							<input type="text" name="AjoutAdminUsager" id="AjoutAdminUsager"/>
							nom d'usager
						</label>
						<label for="AjoutAdminPass" class="labelAjoutAdmin">
							<input type="password" name="AjoutAdminPass" id="AjoutAdminPass"/>
							mot de passe
						</label>
						<label for="AjoutAdminCourriel" class="labelAjoutAdmin">
							<input type="text" name="AjoutAdminCourriel" id="AjoutAdminCourriel"/>
							courriel 
						</label>
					</div>
					<div class="espaceHaut10">
						<span>
							<h4>NIVEAU D'UTILISATEUR</h4>
							<label for="AjoutAdminNiveau" class="labelAjoutAdmin niveau">
								<input type="radio" name="AjoutAdminNiveau" checked id="AjoutAdminNiveau2" value="2"/> 
								<span>UTILISATEUR</span>
							</label>
							<label for="AjoutAdminNiveau" class="labelAjoutAdmin niveau">
								<input type="radio" name="AjoutAdminNiveau" id="AjoutAdminNiveau1" value="1"/>
								<span>GESTIONNAIRE</span>
							</label>
						</span>
					</div>
				</div>
				
				<input type="button" class="bouton" id="boutonAjoutAdmin" value="AJOUTER" name="boutonAjoutAdmin"/>
			</div>
        </article>
	</section>
    <section class="flex-column-left listeAdministateur">
		<h1>LES ADMINISTRATEURS</h1>
		<br>
		<?php
		if($data)
		{
			foreach($data as $utilisateur)
			{	
				
				//$monUtilisateur = $utilisateur["idOeuvre"];
				?>
				<section class="elemListe flex-row-space espaceHaut10">
					
					<article class="informationAdmin">
						<ul>
							<li><span class="catElemListe">usager :   </span><span class="typoValeurAdmin"><?php echo $utilisateur["nomUsagerAdmin"]?>  </span></li>
							<li><span class="catElemListe">nom :      </span><span class="typoValeurAdmin"><?php echo $utilisateur["prenomAdmin"]?>&nbsp;<?php echo $utilisateur["nomAdmin"]?></span></li>
							<li><span class="catElemListe">courriel :      </span><span class="typoValeurAdmin"><?php echo $utilisateur["courrielAdmin"]?>     </span></li>
						</ul>
					</article>
					
					<article  class="liens espaceHaut10 flex-row-left">
						<a class="flex-row-center" href="./index.php?requete=innitialisationPasse&nomUsagerAdmin=<?php echo $utilisateur["nomUsagerAdmin"]?>">MOT DE PASSE &nbsp;<span class="police-demi">(RÉINITIALISER)</span></a>
						<a href="./index.php?requete=supprimeAdmin&nomUsagerAdmin=<?php echo $utilisateur["nomUsagerAdmin"]?>">SUPPRIMER</a>
						<a class="niveauAdmin" href="./index.php?requete=modifieNiveauAdmin&niveauAdmin=<?php echo $utilisateur["niveauAdmin"]?>&nomUsagerAdmin=<?php echo $utilisateur["nomUsagerAdmin"]?>">
							<?php
							 if($utilisateur["niveauAdmin"] == 1)
							 {
								?>GESTIONNAIRE<?php
							 }
							 else
							 {
								?>UTILISATEUR<?php
							 }
							?>
						</a> 
					</article>
				</section>
				<?php
				
			}
		}
		?>
    </section>
    
</div>