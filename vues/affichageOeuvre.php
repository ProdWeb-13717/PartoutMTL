<section id="oeuvreIndi">
	<section id="sectionImage">
        <?php
            if(count($data[1]) != 0)
            {
                foreach($data[1] as $valeur)
                {	
                ?>
                    <img src="<?php echo "./images/" . $valeur["urlPhoto"];?>">
                <?php
                }   
            }
            else
            {
            ?>
                <span>Aucune image disponible</span>
                <?php
            }
        ?>
	</section>
	<ul class="elementOeuvre">
        <?php
        //Affichage du titre de l'oeuvre
        foreach($data[0][0] as $cle => $valeur)
        {	
            if($cle == "titre")
            {
                echo "<li><span class='catElemListe'>Titre : </span>".$valeur;
                foreach($data[0][0] as $cle => $valeur)
                {
                    if($cle == "titreVariante" && $valeur != "")
                    {
                        echo "(".$valeur.")";
                        break;
                    }
                }
                echo "</li>";
            }
        }
        ?>
        <li><span class="catElemListe">Auteur(s): </span>
            <ul>
                <?php
                //Affichage du ou des auteurs de l'oeuvre
                foreach($data[0] as $auteur)
                {
                ?>
                <li>
                    <a href="./index.php?requete=listeOeuvreParAuteurId&idArtiste=<?php echo $auteur["idArtiste"]; ?>">
                        <?php 
                        if($auteur["prenomArtiste"] != "")
                        {
                            echo $auteur["prenomArtiste"];

                            if($auteur["nomArtiste"] != "")
                            {
                                echo" ".$auteur["nomArtiste"];
                            }
                        }
                        else
                        {
                            if($auteur["nomArtiste"] != "")
                            {
                                echo $auteur["nomArtiste"];
                            }
                        }

                        if($auteur["collectif"] != "")
                        {
                            if($auteur["prenomArtiste"] == "" && $auteur["nomArtiste"] == "")
                            {	
                                echo $auteur["collectif"]." (collectif)";
                            }
                        }
                        ?>
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </li>
        <?php
        //Affichage des éléments restants du de l'oeuvre (ils sont présents)
        foreach($data[0][0] as $cle => $valeur)
        {	
            switch($cle)
            {
                case "dateFinProduction":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Date fin de production : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "dateAccession":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Date d'accession : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "nomCollection":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Nom de collection : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "nomCollection":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Nom de collection : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "modeAcquisition":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Mode d'acquisition : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "materiaux":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Materiaux : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "technique":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Technique : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "dimensions":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Dimensions : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "parc":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Parc : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "batiment":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Batiment : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "adresseCivique":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Adresse civique : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "description":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Description : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "nomArrondissement":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Arrondissement : </span>".$valeur."</li>";
                    }
                    break;
                    
                case "nomCategorie":
                    if($valeur != null && $valeur != "")
                    {
                        echo "<li><span class='catElemListe'>Categorie : </span>".$valeur."</li>";
                    }
                    break;	
            }
        }
        ?>
	</ul>
</section>