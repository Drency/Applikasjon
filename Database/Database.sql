CREATE TABLE Brukere (
    PersonID int UNIQUE NOT NULL AUTO_INCREMENT,
    brukernavn varchar(100) NOT NULL,
    Email varchar(255) NOT NULL,
    Passord varchar(45) NOT NULL,
    PRIMARY KEY (PersonID)
);

CREATE TABLE Bibliotek (
    bibID int UNIQUE NOT NULL AUTO_INCREMENT,
    PersonID int,
    PRIMARY KEY (bibID),
    FOREIGN KEY (PersonID) REFERENCES Brukere(PersonID)
);

CREATE TABLE Mapper (
    mapID int UNIQUE NOT NULL AUTO_INCREMENT,
    MappeNavn varchar(45),
    bibID int, 
    PRIMARY KEY (mapID),
    FOREIGN KEY (bibID) REFERENCES Bibliotek(bibID)
);

CREATE TABLE Links (
    linkID int UNIQUE NOT NULL AUTO_INCREMENT,
    LinkNavn varchar(45),
    Linken varchar(100),
    mapID int(10),
    PRIMARY KEY (linkID),
    FOREIGN KEY (mapID) REFERENCES Mapper(mapID)
);

CREATE TABLE Filer (
    filID int UNIQUE NOT NULL AUTO_INCREMENT,
    filLink text,
    mapID int(10),
    PRIMARY KEY (filID),
    FOREIGN KEY (mapID) REFERENCES Mapper(mapID)
);

CREATE TABLE Bilder (
    bildeID int UNIQUE NOT NULL AUTO_INCREMENT,
    bildeLink text, 
    mapID int(10),
    PRIMARY KEY(bildeID),
    FOREIGN KEY (mapID) REFERENCES Mapper(mapID)
);

DELIMITER $$
CREATE TRIGGER bib
AFTER INSERT ON brukere
FOR EACH ROW
BEGIN
INSERT INTO bibliotek(PersonID)
VALUES(new.PersonID);
END$$
DELIMITER ;