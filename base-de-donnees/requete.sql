SELECT patients.prenom, patients.nom FROM patients LEFT JOIN sejours ON patients.idPatient=sejours.IdPatient WHERE sejours.dateFin IS NULL;
