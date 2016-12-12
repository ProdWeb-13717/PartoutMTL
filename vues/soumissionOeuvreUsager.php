<!-- DÉBUT DE LA PAGE SOUMISSION D'UNE OEUVRE, TABLE Oeuvres ---------------------------------------->

<section class="column centre soumissionUsager">
    <h1 class="texteCentre">SUGGÉRER UNE OEUVRE</h1>
    
    <section class="soumissionUsagerFormulaire" >
        
        <label for="titreOeuvreSoumissionUsager"><span class="couleurErreurSoumission">TITRE : </span></label>
        <input type="text" name="titreOeuvreSoumission" id="titreOeuvreSoumissionUsager"/>
        
        <label for="prenomOeuvreSoumissionUsager">PRÉNOM DE L'ARTISTE : </label>
        <input type="text" name="prenomArtisteOeuvreSoumission" id="prenomOeuvreSoumissionUsager"/>

        <label for="nomArtisteOeuvreSoumissionUsager">NOM DE L'ARTISTE : </label>
        <input type="text" name="nomArtisteOeuvreSoumission" id="nomArtisteOeuvreSoumissionUsager"/>
        
        <label for="collectifOeuvreSoumissionUsager">COLLECTIF : </label>
        <input type="text" name="collectifOeuvreSoumission" id="collectifOeuvreSoumissionUsager"/>
        
        <label for="arrondissementOeuvreSoumissionUsager">ARRONDISSEMENT : </label>
        <select name="arrondissementOeuvreSoumission" id="arrondissmentOeuvreSoumissionUsager">
			<option value="#">Options</option>
            <?php
			/*-- pour toutes les datas récupérées de la table Arrondissements ------------------------------*/
			foreach($data as $arrondissement)                                       
			{
				?>
				<option value="<?php echo $arrondissement['idArrondissement']?>"> <?php echo $arrondissement["nomArrondissement"]?></option>
				<?php
			}
			?>
        </select>
        
        <label for="parcOeuvreSoumissionUsager">PARC : </label>
        <input type="text" name="parcOeuvreSoumission" id="parcOeuvreSoumissionUsager"/>
        
        <label for="adresseCiviqueOeuvreSoumissionUsager">ADRESSE CIVIQUE : </label>
        <input type="text" name="adresseCiviqueOeuvreSoumission" id="adresseCiviqueOeuvreSoumissionUsager"/>
        
        <label for="descriptionOeuvreSoumissionUsager">DESCRIPTION : </label>
        <textarea rows="4" style="margin-bottom: 10px; width: 337px;" name="descriptionOeuvreSoumission" id="descriptionOeuvreSoumissionUsager"></textarea>
        
        <label for="photoOeuvreSoumissionUsager">URL PHOTO : </label>
        <input type="text" name="photoOeuvreSoumission" id="photoOeuvreSoumissionUsager"/>
    
        <label for="courrielOeuvreSoumissionUsager"><span class="couleurErreurSoumission">COURRIEL : </span></label>
        <input type="text" name="courrielOeuvreSoumission" id="courrielOeuvreSoumissionUsager"/>

        <span id="msgErreurSoumision"></span>

    </section>
    
    <input type="button" class="boutonSoummissionUsager" id="boutonSoumission" value="SOUMETTRE" name="boutonSoumission"/>   
</section>
        
        