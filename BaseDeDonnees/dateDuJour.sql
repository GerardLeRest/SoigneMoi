USE Soignemoi;

-- Supprimer la procédure si elle existe
DROP PROCEDURE IF EXISTS MiseAJourDesDates;

DELIMITER //

CREATE PROCEDURE MiseAJourDesDates()

BEGIN
    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 1;

    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 5;

    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 8;

    UPDATE sejours
    SET dateFin = CURRENT_DATE
    WHERE idSejour = 3;

END //

DELIMITER ; -- attention à l'espace avant le ;

call MiseAJourDesDates();