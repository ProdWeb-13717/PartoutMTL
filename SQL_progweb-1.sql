/* NOM DE LA BASE DE DONNER : PartoutMTL */



CREATE TABLE IF NOT EXISTS Administrateurs(
    idAdmin int AUTO_INCREMENT NOT NULL,
    prenomAdmin VARCHAR(50), 
    nomAdmin VARCHAR(50),
    nomUsagerAdmin VARCHAR(50) NOT NULL,
    motPasseAdmin VARCHAR(50) NOT NULL,
    courrielAdmin VARCHAR(200) NOT NULL,
    niveauAdmin int NOT NULL,
    PRIMARY KEY (idAdmin)
);


CREATE TABLE IF NOT EXISTS MiseAJours(
    idMiseAJour int AUTO_INCREMENT NOT NULL,
    dateMiseAJour DATETIME, 
    nbOeuvres int,
    idAdmin int,
    PRIMARY KEY (idMiseAJour),
    FOREIGN KEY (idAdmin) REFERENCES Administrateurs(idAdmin)
);


CREATE TABLE IF NOT EXISTS Soumissions(
    idSoumission int AUTO_INCREMENT NOT NULL,
    parc VARCHAR(200), 
    adresseCivique VARCHAR(200),
    descritpion TEXT,
    urlPhoto TEXT,
    courriel VARCHAR(200) NOT NULL,
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
    noInterne int, 
    prenomArtiste VARCHAR(50),
    nomArtiste VARCHAR(50),
    collectif VARCHAR(100),
    PRIMARY KEY (idArtiste)
);

CREATE TABLE IF NOT EXISTS Oeuvres(
    idOeuvre int AUTO_INCREMENT NOT NULL,
    titre VARCHAR(50) NOT NULL,
    titreVariante VARCHAR(50),
    dateFinProduction DATETIME,
    dateAquisition DATETIME,
    nomCollection VARCHAR(50),
    modeAquisition VARCHAR(50),
    materiaux VARCHAR(200),
    technique VARCHAR(100),
    dimensions VARCHAR(50),
    parc VARCHAR(100),
    batiment VARCHAR(100),
    adresseCivique VARCHAR(200),
    latitude int,
    longitude int,
    description TEXT,
    urlPhoto TEXT,
    idCategorie int,
    idArrondissement int,
    numeroAccession VARCHAR(30),
	noInterne int,
    PRIMARY KEY (idOeuvre),
    FOREIGN KEY (idCategorie) REFERENCES Categories(idCategorie),
    FOREIGN KEY (idArrondissement) REFERENCES Arrondissements(idArrondissement)
);

CREATE TABLE IF NOT EXISTS ArtistesOeuvres(
    idArtiste int NOT NULL,
    idOeuvre int NOT NULL,
    PRIMARY KEY (idArtiste,idOeuvre),
    FOREIGN KEY (idArtiste) REFERENCES Artistes(idArtiste),
    FOREIGN KEY (idOeuvre) REFERENCES Oeuvres(idOeuvre)
);

CREATE TABLE IF NOT EXISTS ImagesCarroussel(
    idImgCaroussel int AUTO_INCREMENT NOT NULL,
    position int,
    idOeuvre int NOT NULL,
    PRIMARY KEY (idImgCaroussel),
    FOREIGN KEY (idOeuvre) REFERENCES Oeuvres(idOeuvre)
);