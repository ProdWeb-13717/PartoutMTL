<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->

<div class="soumissionUsager">
    <h1>SUGGÉRER UNE OEUVRE</h1>
    <section class="soumissionUsagerFormulaire">
        <label for="titreOeuvreSoumissionUsager"><span class="couleurErreurSoumission">TITRE : </span></label>
        <input type="text" name="titreOeuvreSoumission" id="titreOeuvreSoumissionUsager"/><br/>
        
        <label for="prenomOeuvreSoumissionUsager">PRÉNOM DE L'ARTISTE : </label>
        <input type="text" name="prenomArtisteOeuvreSoumission" id="prenomOeuvreSoumissionUsager"/><br/>

        <label for="nomArtisteOeuvreSoumissionUsager">NOM DE L'ARTISTE : </label>
        <input type="text" name="nomArtisteOeuvreSoumission" id="nomArtisteOeuvreSoumissionUsager"/><br/>
        
        <label for="collectifOeuvreSoumissionUsager">COLLECTIF : </label>
        <input type="text" name="collectifOeuvreSoumission" id="collectifOeuvreSoumissionUsager"/><br/>
        
        <label for="arrondissementOeuvreSoumissionUsager">ARRONDISSEMENT : </label>
        <select name="arrondissementOeuvreSoumission" id="arrondissmentOeuvreSoumissionUsager">
			<?php
			/*-- pour toutes les datas récupérées de la table Arrondissements ------------------------------*/
			foreach($data as $arrondissement)                                       
			{
				?>
				<option value="<?php echo $arrondissement['idArrondissement']?>"> <?php echo $arrondissement["nomArrondissement"]?></option>
				<?php
			}
			?>
        </select><br/>
        
        <label for="parcOeuvreSoumissionUsager">PARC : </label>
        <input type="text" name="parcOeuvreSoumission" id="parcOeuvreSoumissionUsager"/><br/>
        
        <label for="adresseCiviqueOeuvreSoumissionUsager">ADRESSE CIVIQUE : </label>
        <input type="text" name="adresseCiviqueOeuvreSoumission" id="adresseCiviqueOeuvreSoumissionUsager"/><br/>
        
        <label for="descriptionOeuvreSoumissionUsager">DESCRIPTION : </label>
        <textarea rows="4" cols="40" name="descriptionOeuvreSoumission" id="descriptionOeuvreSoumissionUsager"></textarea><br/>
        
        <label for="photoOeuvreSoumissionUsager">URL PHOTO : </label>
        <input type="text" name="photoOeuvreSoumission" id="photoOeuvreSoumissionUsager"/><br/>
    
        <label for="courrielOeuvreSoumissionUsager"><span class="couleurErreurSoumission">COURRIEL : </span></label>
        <input type="text" name="courrielOeuvreSoumission" id="courrielOeuvreSoumissionUsager"/><br/>
        <br/>
        <span id="msgErreurSoumision"></span>
        <br/>

    </section>
    
    <input type="button" class="bouton" id="boutonSoumission" value="SOUMETTRE" name="boutonSoumission"/>   
</div>
        
        