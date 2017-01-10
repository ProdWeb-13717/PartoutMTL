/* NOM DE LA BASE DE DONNER : PartoutMTL */



CREATE TABLE IF NOT EXISTS Administrateurs(
    nomUsagerAdmin VARCHAR(50) NOT NULL,
    motPasseAdmin VARCHAR(50) NOT NULL,
    courrielAdmin VARCHAR(200) NOT NULL,
    niveauAdmin int NOT NULL,
    prenomAdmin VARCHAR(50), 
    nomAdmin VARCHAR(50),
    PRIMARY KEY (nomUsagerAdmin)

);


CREATE TABLE IF NOT EXISTS MiseAJours(
    idMiseAJour int AUTO_INCREMENT NOT NULL,
    dateMiseAJour DATETIME, 
    nbOeuvres int,
    nomUsagerAdmin  VARCHAR(50),
    PRIMARY KEY (idMiseAJour),
    FOREIGN KEY (nomUsagerAdmin) REFERENCES Administrateurs(nomUsagerAdmin)
);


CREATE TABLE IF NOT EXISTS Soumissions(
    idSoumission int AUTO_INCREMENT NOT NULL,
	titreSoumission VARCHAR(100),
    prenomArtisteSoumission VARCHAR(50),
    nomArtisteSoumission VARCHAR(50),
    collectifSoumission VARCHAR(100),
    idArrondissementSoumission int,
    parcSoumission VARCHAR(200), 
    adresseCiviqueSoumission VARCHAR(200),
    descriptionSoumission TEXT,
    photoSoumission TEXT,
    courrielSoumission VARCHAR(200) NOT NULL,
    PRIMARY KEY (idSoumission)
);

CREATE TABLE IF NOT EXISTS Categories(
    idCategorie int AUTO_INCREMENT NOT NULL,
    nomCategorie VARCHAR(60),
    PRIMARY KEY (idCategorie)
);

CREATE TABLE IF NOT EXISTS Arrondissements(
    idArrondissement int AUTO_INCREMENT NOT NULL,
    nomArrondissement VARCHAR(100),
    PRIMARY KEY (idArrondissement)
);

CREATE TABLE IF NOT EXISTS Artistes(
    idArtiste int AUTO_INCREMENT NOT NULL,
    prenomArtiste VARCHAR(50),
    nomArtiste VARCHAR(50),
    collectif VARCHAR(100),
    PRIMARY KEY (idArtiste)
);

CREATE TABLE IF NOT EXISTS Oeuvres(
    idOeuvre int AUTO_INCREMENT NOT NULL,
    titre VARCHAR(200) NOT NULL,
    titreVariante VARCHAR(200),
    dateFinProduction DATE,
    dateAccession DATE,
    nomCollection VARCHAR(200),
    modeAcquisition VARCHAR(200),
    materiaux VARCHAR(200),
    technique VARCHAR(200),
    dimensions VARCHAR(200),
    parc VARCHAR(200),
    batiment VARCHAR(200),
    adresseCivique VARCHAR(200),
    latitude float,
    longitude float,
    description TEXT,
    numeroAccession VARCHAR(200),
    noInterne int,
    idCategorie int,
    idArrondissement int,
    PRIMARY KEY (idOeuvre),
    FOREIGN KEY (idCategorie) REFERENCES Categories(idCategorie),
    FOREIGN KEY (idArrondissement) REFERENCES Arrondissements(idArrondissement)
);


CREATE TABLE IF NOT EXISTS Photos(
    idPhoto int AUTO_INCREMENT NOT NULL,
	urlPhoto TEXT,
	idOeuvre int,
    PRIMARY KEY (idPhoto),
    FOREIGN KEY (idOeuvre) REFERENCES Oeuvres(idOeuvre)
);


CREATE TABLE IF NOT EXISTS ArtistesOeuvres(
    idArtiste int NOT NULL,
    idOeuvre int NOT NULL,
    PRIMARY KEY (idArtiste,idOeuvre),
    FOREIGN KEY (idArtiste) REFERENCES Artistes(idArtiste),
    FOREIGN KEY (idOeuvre) REFERENCES Oeuvres(idOeuvre)
);

CREATE TABLE IF NOT EXISTS Carroussel(
    idCaroussel int AUTO_INCREMENT NOT NULL,
	urlPhoto TEXT,
	urlLien TEXT,
	titre VARCHAR(200),
    description TEXT,
    position int,
    PRIMARY KEY (idCaroussel)
);


INSERT into Categories (nomCategorie) VALUES 
			("Sculpture"),
			("Installation"),
			("Vitrail"),
			("Peinture"),
			("Mosaique")
			;
            
INSERT into Arrondissements (nomArrondissement) VALUES 
			("Côte-des-Neiges–Notre-Dame-de-Grâce"),
			("Ville-Marie"),
			("Rosemont–La Petite-Patrie"),
			("Le Plateau-Mont-Royal"),
			("Le Sud-Ouest")
			;

INSERT into Soumissions (titreSoumission,
                         prenomArtisteSoumission,
                         nomArtisteSoumission,
                         collectifSoumission,
                         idArrondissementSoumission,
                         parcSoumission, 
                         adresseCiviqueSoumission,
                         descriptionSoumission,
                         photoSoumission,
                         courrielSoumission
                        ) VALUES ("titre #1",
                                  "prénom #1",
			                      "nom #1",
			                      "collectif #1",
			                      19,
                                  "parc #1",
                                  "adresse #1",
                                  "description #1",
                                  "photo #1",
                                  "courriel1@gmail.com"
                                  ),
                                 ("titre #2",
                                  "prénom #2",
                                  "nom #2",
                                  "collectif #2",
                                  20,
                                  "parc #2",
                                  "adresse #2",
                                  "description #2",
                                  "photo #2",
                                  "courriel2@gmail.com"
                                 ),
                                 ("titre #3",
                                  "prénom #3",
                                  "nom #3",
                                  "collectif #3",
                                  21,
                                  "parc #3",
                                  "adresse #3",
                                  "description #3",
                                  "photo #3",
                                  "courriel3@gmail.com")
			                     ;

INSERT INTO Administrateurs(nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin) VALUE ("NL", MD5("NL123"), "nl@hotmail.com", 1);


INSERT INTO Administrateurs(nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin) VALUE ("1", MD5("1"), "un@hotmail.com", 1);
INSERT INTO Administrateurs(nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin) VALUE ("2", MD5("2"), "nl2@hotmail.com", 2);
INSERT INTO Administrateurs(nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin) VALUE ("NoemiLegault", MD5("NL"), "NoemiLegault@hotmail.com", 1);
INSERT INTO Administrateurs(nomUsagerAdmin, motPasseAdmin, courrielAdmin, niveauAdmin) VALUE ("SCB", MD5("SCB"), "SCoteBouchard@hotmail.com", 2);

INSERT INTO Carroussel(urlPhoto) 
VALUE("./images/Acceuil_1"),
("./images/Acceuil_4"),
("./images/image_default_oeuvre_1.jpg"),
("./images/image_default_oeuvre_2.jpg"),
("./images/image_default_oeuvre_3.jpg"),
("./images/image_default_oeuvre_4.jpg");

