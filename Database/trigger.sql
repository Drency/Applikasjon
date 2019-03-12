-- Trigger for oppretting av bibliotek for nye brukere --
DROP TRIGGER IF EXISTS Bib;
DELIMITER $$
CREATE TRIGGER Bib AFTER INSERT ON brukere
FOR EACH ROW
BEGIN
INSERT INTO bilbliotek(BibID, PersonId)
VALUES(brukere.PersonId, brukere.PersonId);
END
