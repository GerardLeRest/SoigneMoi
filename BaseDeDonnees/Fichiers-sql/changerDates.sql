USE Soignemoi;

-- Supprimer la procédure si elle existe
DROP PROCEDURE IF EXISTS changerDates;

DELIMITER //

CREATE PROCEDURE changerDates()

BEGIN
    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 1;

    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 3;

    UPDATE sejours
    SET dateDebut = CURRENT_DATE
    WHERE idSejour = 7;

    UPDATE sejours
    SET dateFin = CURRENT_DATE
    WHERE idSejour = 5;
END //

DELIMITER ;
