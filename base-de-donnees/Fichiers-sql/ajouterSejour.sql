USE Soignemoi;

-- Supprimer la procédure si elle existe
DROP PROCEDURE IF EXISTS ajouterDate;

CREATE PROCEDURE ajouterSejour
    (IN dateDebut date,
     IN dateFin date,
     IN motifSejour text,
     IN specialite varchar(100),
     IN medecinSouhaite varchar(100),
     IN idPatient int)

    INSERT INTO sejours (dateDebut, dateFin, motifSejour, specialite, medecinSouhaite, idPatient)
    VALUES (dateDebut, dateFin, motifSejour, specialite, medecinSouhaite, idPatient);
