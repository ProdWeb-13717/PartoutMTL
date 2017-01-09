<?php
	/// *** SECURITE DE LA PAGE *** ///////////////////////////
	if(!isset($_SESSION['authentifie']))
	{
		header('Location: ../index.php');
	}
	///////////////////////////////////////////////////////////
?>

<div class="marginDivPrincipale">
    <section class="optionBDContainer adminTitre">
        <h1>BASE DE DONNÉES</h1>
        <section class="flex-row-left">
            <article class="espaceADroite10">
                <form class ="form" id="forMisaJour" method="GET">
                    <fieldset>
                        <h3>VÉRIFICATION</h3>
                        Des oeuvres non mise à jour
                        <input type="hidden" name="requete" value="verification"/>
                        <input class ="bouton2" type="submit" name="Verification" value="VÉRIFIER"/> 
                    </fieldset>
                </form>
            </article>
            
            <article class="espaceHaut30">
                <form class ="form" id="formVerification" method="GET">
                    <fieldset>
                        <h3>MISE À JOUR</h3>
                        De la base de données
                        <input type="hidden" name="requete" value="importationok"/>
                        <input class ="bouton2" type="submit" name="Importer" value="MISE À JOUR"/>
                    </fieldset>
                </form>
            </article>
        </section>
    </section>
</div>

