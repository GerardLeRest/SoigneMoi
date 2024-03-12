SELECT prenom, nom, adresse_postale FROM Patients WHERE nom = "Martin";
SELECT prenom, nom,specialite FROM Medecins ORDER BY specialite;
SELECT Medecins.nom, Avis.date, Avis.libelle, Avis.description FROM Avis LEFT JOIN Medecins ON Avis.idAvis=Medecins.idMedecin WHERE Medecins.nom = "Wang";
SELECT prenom, nom FROM Patients WHERE date_sortie IS NULL;
SELECT Patients.prenom, Patients.prenom, Prescriptions.nom_medicament, Prescriptions.posologie FROM Patients LEFT JOIN Medecins ON Patients.idMedecin = Medecins.idMedecin LEFT JOIN Prescriptions ON Medecins.idMedecin = Prescriptions.idPrescription WHERE Patients.nom = "Girard";
