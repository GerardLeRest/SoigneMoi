USE Soignemoi;

--supprimer la procédure si elle existe
DROP PROCEDURE IF EXISTS CreationDateSejour;

DELIMITER //

CREATE PROCEDURE CreationDateSejour(
    IN dateDebut DATE,
    IN dateFin DATE,
    IN motifSejour TEXT,
    IN specialite VARCHAR(100),
    IN medecinSouhaite VARCHAR(100),
    IN idPatient INT
    )

BEGIN
    INSERT INTO sejours (dateDebut, dateFin, motifSejour, specialite, medecinSouhaite, idPatient)
    VALUES (dateDebut, dateFin, motifSejour, specialite, medecinSouhaite, idPatient);
END //

DELIMITER ;

CALL CreationDateSejour('2024-09-01', CURRENT_DATE, CONCAT(
                                                        'Observation et traitement d’une ',
                                                        'hypertension sévère nécessitant une surveillance constante ',
                                                        'et un ajustement médicamenteux.'),
                                                        'Cardiologue', 'Marie Curie', 2);