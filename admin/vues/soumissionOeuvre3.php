<!-- SUITE DE LA SOUMISSION D'UNE OEUVRE, TABLE Oeuvres --------------------------------------------->   

		 <label for="parcOeuvreAjoutAdmin">PARC : </label>
		 <input type="text" name="parcOeuvreAjout" id="parcOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
                    value="<?php echo $data['parcSoumission']; ?>"
				    <?php
                }
            ?> 
         />
		 
		 <label for="batimentOeuvreAjoutAdmin">BÂTIMENT : </label>
		 <input type="text" name="batimentOeuvreAjout" id="batimentOeuvreAjoutAdmin"/>
		 
		 <label for="adresseCiviqueOeuvreAjoutAdmin">ADRESSE CIVIQUE : </label>
		 <input type="text" name="adresseCiviqueOeuvreAjout" id="adresseCiviqueOeuvreAjoutAdmin"
            <?php 
                if(isset($_GET["idSoumissionUsager"]))
                {
                    ?>
                    value="<?php echo $data['adresseCiviqueSoumission']; ?>"
                    <?php
			    }
            ?> 
         />
		 
		 <label for="latitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">LATITUDE : </span></label>
		 <input type="text" name="latitudeOeuvreAjout" id="latitudeOeuvreAjoutAdmin" placeholder= "45.0000"/>
		 
		 <label for="longitudeOeuvreAjoutAdmin"><span class="couleurErreurSoumission">LONGITUDE : </span></label>
		 <input type="text" name="longitudeOeuvreAjout" id="longitudeOeuvreAjoutAdmin" placeholder= "-73.0000"/>
		 
		 <label for="urlPhotoOeuvreAjoutAdmin">URL PHOTO : </label>
		 <input type="text" name="urlPhotoOeuvreAjout" id="urlPhotoOeuvreAjoutAdmin"/>
		 
		 <label for="descriptionOeuvreAjoutAdmin">DESCRIPTION : </label>
		 <textarea rows="4" style="width: 337px;" name="descriptionOeuvreAjout" id="descriptionOeuvreAjoutAdmin"
            ><?php 
                 if(isset($_GET["idSoumissionUsager"]))
                 {
				    echo $data['descriptionSoumission'];
			     }
             ?>
         </textarea>

		 <span id="msgErreurSoumision"></span>

	 </section>