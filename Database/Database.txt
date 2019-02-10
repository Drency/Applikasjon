CREATE TABLE Brukere (
    PersonID int UNIQUE NOT NULL AUTO_INCREMENT,
    Email varchar(255),
    Passord varchar(45),
    PRIMARY KEY (PersonID)
);

CREATE TABLE Bilbliotek (
    bibID int UNIQUE NOT NULL,
    bibNavn varchar(45),
    PersonID int,
    PRIMARY KEY (bibID),
    FOREIGN KEY (PersonID) REFERENCES Brukere(PersonID)
);

CREATE TABLE Mapper (
    mapID int UNIQUE NOT NULL,
    MappeNavn varchar(45),
    bibID int, 
    PRIMARY KEY (mapID),
    FOREIGN KEY (bibID) REFERENCES Bilbliotek(bibID)
);

CREATE TABLE Links (
    LinkNavn varchar(45),
    mapID int(10),
    PRIMARY KEY (mapID),
    FOREIGN KEY (mapID) REFERENCES Mapper(mapID)
);

CREATE TABLE Filer (
    filID int UNIQUE NOT NULL AUTO_INCREMENT,
    filLink text,
    mapID int(10),
    PRIMARY KEY (mapID),
    FOREIGN KEY (mapID) REFERENCES Mapper(mapID)
);

CREATE TABLE Bilder (
    bildeID int UNIQUE NOT NULL AUTO_INCREMENT,
    bildeLink text, 
    mapID int(10),
    bibID int(10),
    PRIMARY KEY(bibID),
    FOREIGN KEY (bibID) REFERENCES Mapper(mapID)
);