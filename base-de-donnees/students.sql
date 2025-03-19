USE university;
DROP TABLE IF EXISTS students;
CREATE TABLE students(
id INT AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(50) NOT NULL,
last_name VARCHAR (50) NOT NULL,
age INT NOT NULL
);

INSERT INTO students (first_name, last_name, age) VALUES
('Jean', 'Dupont', 23),
('Marie', 'Durand', 20),
('Luc', 'Martin', 19),
('Sophie', 'Petit', 22),
('Chloé', 'Bernard', 21),
('Étienne', 'Leroux', 18),
('Léa', 'Moreau', 17),
('Sarah', 'Laurent', 19),
('Maxime', 'Simon', 24),
('Camille', 'Lefebvre', 25),
('Yasmine', 'Alou', 20),
('Aya', 'Nakamura', 22),
('Ali', 'Ben Salem', 21),
('Tom', 'Dupont', 18), -- Nom identique à 'Jean Dupont'
('Nadia', 'Mazri', 23);