CREATE TABLE brukere (
    id int UNIQUE NOT NULL AUTO_INCREMENT,
    brukernavn varchar(100) NOT NULL,
    email varchar(255) NOT NULL,
    passord varchar(45) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE bibliotek (
    bibId int UNIQUE NOT NULL AUTO_INCREMENT,
    id int(10),
    PRIMARY KEY (bibId),
    FOREIGN KEY (id) REFERENCES brukere(id)
);

CREATE TABLE mapper (
    mapId int UNIQUE NOT NULL AUTO_INCREMENT,
    mappeNavn varchar(45),
    bibId int(10), 
    PRIMARY KEY (mapId),
    FOREIGN KEY (bibId) REFERENCES bibliotek(bibId)
);

CREATE TABLE links (
    linkId int UNIQUE NOT NULL AUTO_INCREMENT,
    linkNavn varchar(45),
    linkUrl varchar(100),
    mapId int(10),
    PRIMARY KEY (linkId),
    FOREIGN KEY (mapId) REFERENCES Mapper(mapId)
);

CREATE TABLE filer (
    filId int UNIQUE NOT NULL AUTO_INCREMENT,
    filLink text,
    mapId int(10),
    PRIMARY KEY (filId),
    FOREIGN KEY (mapId) REFERENCES Mapper(mapId)
);

CREATE TABLE bilder (
    bildeID int UNIQUE NOT NULL AUTO_INCREMENT,
    bildeLink text, 
    mapId int(10),
    PRIMARY KEY(bildeID),
    FOREIGN KEY (mapId) REFERENCES Mapper(mapId)
);

DELIMITER $$
CREATE TRIGGER bib
AFTER INSERT ON brukere
FOR EACH ROW
BEGIN
INSERT INTO bibliotek(id)
VALUES(new.id);
END$$
DELIMITER ;
