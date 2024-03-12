DROP TABLE IF EXISTS Sejours;
DROP TABLE IF EXISTS Prescriptions;
DROP TABLE IF EXISTS Avis;
DROP TABLE IF EXISTS Patients;
DROP TABLE IF EXISTS Entrees_Sorties;
DROP TABLE IF EXISTS Medecins;

CREATE TABLE Medecins(
    idMedecin INT AUTO_INCREMENT PRIMARY KEY,
    matricule Varchar(100) NOT NULL,
    prenom Varchar(100) NOT NULL,
    nom Varchar(100) NOT NULL,
    specialite Varchar(100) NOT NULL
);

CREATE TABLE Avis(
    idAvis Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    libelle Varchar (100) NOT NULL,
    description Text NOT NULL,
    idMedecin Int NOT NULL,
    FOREIGN KEY (idMedecin) REFERENCES Medecins(idMedecin)
);

CREATE TABLE Patients(
    idPatient Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    prenom Varchar (255) NOT NULL,
    nom Varchar (100) NOT NULL,
    adresse_postale Varchar (100) NOT NULL,
    email Varchar (255) NOT NULL,
    mot_de_passe Varchar (255) NOT NULL,
    idMedecin int NOT NULL,
    FOREIGN KEY (idMedecin) REFERENCES Medecins(idMedecin)
);

CREATE TABLE Sejours(
    idSejour Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date_debut Date NOT NULL,
    date_fin Date NULL,
    motif_sejour Text NOT NULL,
    specialite Varchar (100) NOT NULL,
    medecin_souhaite Varchar (100) NOT NULL,
    idPatient Int NOT NULL,
    FOREIGN KEY (idPatient) REFERENCES Patients(idPatient)
);

CREATE TABLE Prescriptions(
    idPrescription Int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_medicament Varchar (100) NOT NULL,
    posologie Varchar(100) NOT NULL,
    date_de_debut Date NOT NULL,
    date_de_fin Date NOT NULL,
    idMedecin Int NOT NULL,
    FOREIGN KEY (idMedecin) REFERENCES Medecins(idMedecin)
);

INSERT INTO Medecins (prenom, nom, matricule, specialite) VALUES
('Jean', 'Dupont', 'M011', 'Pneumologue'),
('Marie', 'Curie', 'M092', 'Cardiologue'),
('Ahmed', 'Alami', 'M089', 'Chirurgien cardiaque'),
('Sarah', 'Bernard', 'M002', 'Neurologue'),
('Lei', 'Wang', 'M017', 'Chirurgien orthopédique'),
('Amina', 'Diallo', 'M026', 'Pneumologue'),
('Claire', 'Fontaine', 'M031', 'Gastro-entérologue');


INSERT INTO Patients (prenom, nom, adresse_postale, email, mot_de_passe, idMedecin) VALUES
('Alice', 'Durand', '10 Rue de Vitre, Chantepie', 'alice.durand@example.com', '$2y$12$9iL2CE.1b2P3PK0r0Fb8MukCHVQx7MYl5TnoB2eqJOPw1/zFt7kaG', 1),
('Ahmed', 'Al-Farsi', '25 Avenue de Bretagne, Cesson-Sévigné', 'ahmed.alfarsi@example.com', '$2y$12$KbROKz0vj3TV9/G.qF3Ic.QBp/zULFGY.UA6q2HBksUpdEv/ZFsX2', 2),
('Kofi', 'Adjoa', '8 Rue du Bocage, Vezin-le-Coquet', 'kofi.adjoa@example.com', '$2y$12$UkPLcWV5u1EXV5rNtVapQ.Y0fqCcpv6vxv21Ju6XrTYkXKrl2z30q', 4),
('Émilie', 'Martin', '32 Rue de Rennes, Saint-Grégoire', 'emilie.martin@example.com', '$2y$12$Fg.4bboJZkV8ts72cBFNY.z9lQCUa24Jx8rV/ZPQo8F56Fojl/uRy',  5),
('François', 'Girard', '47 Rue de Lorient, Montgermont', 'francois.girard@example.com', '$2y$12$ShBFHRPufyS45ymvDj5y6eyMcYGtl9zE1f0sI.GAKh41Ry7kUKi8m',2),
('Charlotte', 'Martin', '15 Chemin des Ducs, Betton', 'charlotte.martin@example.com', '$2y$12$6kUYdW.7LUed31Wtrt7TCOoOgHrz6K5mV8xXvOdF3I6xMIfWbjC82', 3);

INSERT INTO Sejours (date_debut, date_fin, motif_sejour, specialite, medecin_souhaite, idPatient) VALUES
('2023-02-15', '2023-03-01', 'Opération du genou suite à un accident sportif. Reconstruction des ligaments avec réhabilitation post-opératoire intensive.', 'Chirurgien orthopédique', 'Lei Wang', 1),
('2024-03-15', '2024-04-05', 'Opération du cœur nécessitant une intervention chirurgicale complexe par un spécialiste en chirurgie cardiaque', 'Chirurgien cardiaque', 'Ahmed Alami', 1),
('2024-05-20', '2024-06-10', 'Suivi de maladie cardiaque impliquant un examen complet et la gestion des risques cardiaques', 'Cardiologue', 'Marie Curie', 2),
('2024-06-10', '2024-06-24', 'Traitement spécialisé d''une infection bactérienne résistante aux antibiotiques. Administration d''antibiotiques à spectre étendu et surveillance médicale constante.', 'Médecine générale', 'Jean Dupont', 2),
('2024-07-01', NULL, 'Traitement d''une pneumonie sévère nécessitant une hospitalisation pour surveillance et administration de traitements intraveineux', 'Pneumologue', 'Jean Dupont', 3),
('2024-08-12', NULL, 'Gestion et réhabilitation d''arthrose avancée nécessitant une approche multidisciplinaire, incluant la chirurgie orthopédique', 'Chirurgien orthopédique', 'Lei Wang', 4),
('2024-09-05', '2024-10-05', 'Prise en charge d''une bronchite chronique exacerbée, nécessitant un suivi spécialisé et des soins pneumologiques avancés', 'Pneumologue', 'Amina Diallo', 5),
('2024-10-15', NULL, 'Programme intensif de rééducation après AVC, visant à restaurer autant que possible les fonctions motrices et cognitives', 'Neurologue', 'Sarah Bernard', 6),
('2024-12-05', '2024-12-20', 'Intervention chirurgicale planifiée pour une prothèse de genou due à l''arthrose avancée. Rééducation post-opératoire pour retour à la marche sans douleur.', 'Chirurgien orthopédique', 'Lei Wang', 1);


INSERT INTO Prescriptions (nom_medicament, posologie, date_de_debut, date_de_fin, idmedecin) VALUES
('Amoxicilline', '500 mg toutes les 8 heures pendant 7 jours', '2024-09-05', '2024-09-12', 3),
('Ibuprofène', '400 mg toutes les 8 heures au besoin pour la douleur et la fièvre', '2024-09-05', '2024-09-12', 3),
('Salbutamol inhalateur', '2 inhalations toutes les 4 heures au besoin pour le soulagement des symptômes', '2024-09-05', '2024-09-19', 3),
('Prednisolone', '30 mg une fois par jour pendant 5 jours', '2024-09-05', '2024-09-10', 3),
('Acétylcystéine', '600 mg une fois par jour pour fluidifier les mucosités', '2024-09-05', '2024-09-19', 3)

INSERT INTO Avis (date, libelle, description, idMedecin) VALUES
('2024-03-25', 'Suivi opération cœur', 'Le patient montre des signes de récupération satisfaisants après l''opération. Les fonctions cardiaques sont stables et la cicatrisation se déroule comme prévu.', 3),
('2024-06-05', 'Contrôle maladie cardiaque', 'Les résultats des derniers examens montrent une amélioration notable. Le traitement en cours semble efficace, et nous recommandons de le poursuivre selon le plan établi.', 2),
('2024-07-10', 'Pneumonie sévère', 'Le patient répond bien au traitement antibiotique, mais doit rester hospitalisé pour une surveillance continue. Les séances de physiothérapie respiratoire sont également bénéfiques.', 1),
('2024-08-20', 'Consultation arthrose', 'Après évaluation, une intervention chirurgicale semble être la meilleure option pour améliorer la mobilité et réduire la douleur. Une préparation pré-opératoire sera nécessaire.', 5),
('2024-09-15', 'Suivi bronchite chronique', 'Malgré le traitement, des symptômes persistent. Il est conseillé d''ajuster les médicaments et d''envisager des séances de réhabilitation respiratoire.', 6),
('2024-10-20', 'Rééducation après AVC', 'Le programme de rééducation est ajusté pour se concentrer davantage sur la récupération de la motricité fine. Des progrès sont observés, mais des efforts supplémentaires sont nécessaires.', 4),
('2023-03-02', 'Réévaluation post-opératoire', 'La patiente montre des signes de récupération satisfaisante après son opération du genou. La mobilité s''améliore progressivement, et la douleur est bien gérée avec le traitement prescrit. Des séances supplémentaires de physiothérapie sont recommandées pour accélérer la réhabilitation.', 5),
('2024-06-25', 'Bilan de fin de traitement', 'Le patient a terminé son cycle de traitement pour la maladie infectieuse. Les tests confirment l''éradication de l''infection. Aucun signe de résistance aux médicaments n''a été observé. Un suivi dans un mois est prévu pour s''assurer de la stabilité de l''état de santé.', 1);

