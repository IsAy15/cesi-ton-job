SET FOREIGN_KEY_CHECKS = 0;

-- Création de la base de données

DROP TABLE IF EXISTS users;
CREATE TABLE users(
   id INT AUTO_INCREMENT,
   lastname VARCHAR(50),
   firstname VARCHAR(50),
   email VARCHAR(50),
   password VARCHAR(500),
   role VARCHAR(50),
   status VARCHAR(50) NOT NULL DEFAULT 'pending',
   avatar VARCHAR(5000),
   campus VARCHAR(50),
   PRIMARY KEY(id)
);

DROP TABLE IF EXISTS companies;
CREATE TABLE companies(
   id INT AUTO_INCREMENT,
   name VARCHAR(50),
   sector VARCHAR(50),
   localization JSON,
   status VARCHAR(50) NOT NULL DEFAULT 'active',
   PRIMARY KEY(id)
);

DROP TABLE IF EXISTS abilities;
CREATE TABLE abilities(
   id INT AUTO_INCREMENT,
   title VARCHAR(50),
   description VARCHAR(50),
   PRIMARY KEY(id)
);

DROP TABLE IF EXISTS promotions;
CREATE TABLE promotions(
   id INT AUTO_INCREMENT,
   name VARCHAR(50),
   PRIMARY KEY(id)
);

DROP TABLE IF EXISTS offers;
CREATE TABLE offers(
   id INT AUTO_INCREMENT,
   title VARCHAR(50),
   description VARCHAR(1000),
   localization JSON,
   starting_date DATE,
   ending_date DATE,
   places INT,
   salary DOUBLE,
   applies_count INT DEFAULT 0,
   type VARCHAR(50),
   created_at DATE,
   updated_at DATE,
   status VARCHAR(50) NOT NULL DEFAULT 'active',
   company_id INT NOT NULL,
   promotion_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(company_id) REFERENCES companies(id),
   FOREIGN KEY(promotion_id) REFERENCES promotions(id)
);



DROP TABLE IF EXISTS applications;
CREATE TABLE applications(
   offer_id INT,
   user_id INT,
   cv VARCHAR(5000),
   letter VARCHAR(5000),
   PRIMARY KEY(offer_id, user_id),
   FOREIGN KEY(offer_id) REFERENCES offers(id),
   FOREIGN KEY(user_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS student_abilities;
CREATE TABLE student_abilities(
   user_id INT,
   ability_id INT,
   PRIMARY KEY(user_id, ability_id),
   FOREIGN KEY(user_id) REFERENCES users(id),
   FOREIGN KEY(ability_id) REFERENCES abilities(id)
);

DROP TABLE IF EXISTS grades;
CREATE TABLE grades(
   user_id INT,
   company_id INT,
   value DOUBLE,
   PRIMARY KEY(user_id, company_id),
   FOREIGN KEY(user_id) REFERENCES users(id),
   FOREIGN KEY(company_id) REFERENCES companies(id)
);

DROP TABLE IF EXISTS levels;
CREATE TABLE levels(
   id INT AUTO_INCREMENT,
   title VARCHAR(50),
   PRIMARY KEY(id)
);

-- Supprimez la table user_levels existante
DROP TABLE IF EXISTS user_levels;

-- Recréez la table user_levels avec une clé primaire composite sur user_id et level_id
CREATE TABLE user_levels (
   user_id INT,
   level_id INT,
   PRIMARY KEY(user_id, level_id),
   FOREIGN KEY(user_id) REFERENCES users(id),
   FOREIGN KEY(level_id) REFERENCES levels(id)
);


DROP TABLE IF EXISTS offer_levels;
CREATE TABLE offer_levels (
   offer_id INT,
   level_id INT,
   PRIMARY KEY(offer_id),
   FOREIGN KEY(offer_id) REFERENCES offers(id),
   FOREIGN KEY(level_id) REFERENCES levels(id)
);

DROP TABLE IF EXISTS user_promotions;
CREATE TABLE user_promotions(
   user_id INT,
   promotion_id INT,
   PRIMARY KEY(user_id, promotion_id),
   FOREIGN KEY(user_id) REFERENCES users(id),
   FOREIGN KEY(promotion_id) REFERENCES promotions(id)
);

DROP TABLE IF EXISTS user_offer;
CREATE TABLE user_offer(
   offer_id INT,
   user_id INT,
   PRIMARY KEY(offer_id, user_id),
   FOREIGN KEY(offer_id) REFERENCES offers(id),
   FOREIGN KEY(user_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS user_wishlist;
CREATE TABLE user_wishlist(
   offer_id INT,
   user_id INT,
   PRIMARY KEY(offer_id, user_id),
   FOREIGN KEY(offer_id) REFERENCES offers(id),
   FOREIGN KEY(user_id) REFERENCES users(id)
);

DROP TABLE IF EXISTS offer_requirements;
CREATE TABLE offer_requirements(
   of_id INT,
   ab_id INT,
   PRIMARY KEY(of_id, ab_id),
   FOREIGN KEY(of_id) REFERENCES offers(id),
   FOREIGN KEY(ab_id) REFERENCES abilities(id)
);



-- Remplissage de la base de données

-- Remplissage de la table users
DELETE FROM `users`;

INSERT INTO `users` (`id`, `lastname`, `firstname`, `email`, `password`, `role`, `status`,`avatar`, `campus`) VALUES
(1, 'admin', 'admin', 'admin@ctj.fr', MD5('admin'), 'admin', 'approved', 'admin.jpg','Toulouse'),
(2, 'user', 'user', 'user@ctj.fr', MD5('user'), 'user', 'approved', 'user.jpg', 'Bordeaux'),
(3, 'user2', 'user2', 'user2@ctj.fr', MD5('user2'), 'user', 'approved', 'user.jpg', 'Montpellier'),
(4, 'user3', 'user3', 'user3@ctj.fr', MD5('user3'), 'user', 'approved', 'user.jpg', 'Pau'),
(5, 'pilote', 'pilote', 'pilote@ctj.fr', MD5('pilote'), 'pilote', 'approved', 'pilote.jpg', 'Bordeaux'),
(6, 'pilote2', 'pilote2', 'pilote2@ctj.fr', MD5('pilote2'), 'pilote', 'approved', 'pilote.jpg', 'Angoulême'),
(7, 'pilote3', 'pilote3', 'pilote3@ctj.fr', MD5('pilote3'), 'pilote', 'approved', 'pilote.jpg', 'Arras'),
(8, 'pilote4', 'pilote4', 'pilote4@ctj.fr', MD5('pilote4'), 'pilote', 'approved', 'pilote.jpg', 'Caen'),
(9, 'pilote5', 'pilote5', 'pilote5@ctj.fr', MD5('pilote5'), 'pilote', 'approved', 'pilote.jpg', 'Dijon');

-- Remplissage de la table companies
DELETE FROM companies;

INSERT INTO `companies` (`id`, `name`, `sector`, `localization`, `status`) VALUES
(1, 'Dassault Systèmes', 'Informatique', '[{\"nom\": \"Vélizy-Villacoublay\", \"code\": \"78640\", \"cp\": \"78140\", \"dep\": \"78\"}]', 'active'),
(2, 'Capgemini', 'Informatique', '[{\"nom\": \"Paris\", \"code\": \"75056\", \"cp\": \"75001\", \"dep\": \"75\"}]', 'active'),
(3, 'Thales', 'Informatique', '[{\"nom\": \"Courbevoie\", \"code\": \"92026\", \"cp\": \"92400\", \"dep\": \"92\"}]','active'),
(4, 'Airbus', 'Aéronautique', '[{\"nom\": \"Labège\", \"code\": \"31000\", \"cp\": \"31670\", \"dep\": \"31\"}]', 'active'),
(5, 'Atos', 'Informatique', '[{\"nom\": \"Bezons\", \"code\": \"95063\", \"cp\": \"95870\", \"dep\": \"95\"}]', 'active'),
(6, 'Sopra Steria', 'Informatique', '[{\"nom\": \"Paris\", \"code\": \"75056\", \"cp\": \"75001\", \"dep\": \"75\"}]', 'active'),
(7, 'Ubisoft', 'Informatique', '[{\"nom\": \"Montreuil\", \"code\": \"93048\", \"cp\": \"93100\", \"dep\": \"93\"}]', 'active'),
(8, 'OVHcloud', 'Informatique', '[{\"nom\": \"Roubaix\", \"code\": \"59512\", \"cp\": \"59100\", \"dep\": \"59\"}]', 'active'),
(9, 'Société Générale', 'Banque', '[{\"nom\": \"La Défense\", \"code\": \"92062\", \"cp\": \"92400\", \"dep\": \"92\"}]', 'active'),
(10, 'Inetum', 'Informatique', '[{\"nom\":\"Labège\",\"code\":\"31254\",\"cp\":\"31670\",\"dep\":\"31\"},{\"nom\":\"Toulouse\",\"code\":\"31555\",\"cp\":\"31000\",\"dep\":\"31\"}]','hidden');

-- Remplissage de la table levels
DELETE FROM levels;

INSERT INTO levels (title) VALUES
('A1'),
('A2'),
('A3'),
('A4'),
('A5');


DELETE FROM user_levels;
INSERT INTO user_levels (user_id, level_id) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 1),
(5, 2),
(6, 5),
(7, 1),
(8, 1),
(8, 2),
(8, 3),
(9, 3);

DELETE FROM offer_levels;

INSERT INTO offer_levels (offer_id, level_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 1),
(7, 2),
(8, 3),
(9, 4);




-- Remplissage de la table abilities
DELETE FROM `abilities`;

INSERT INTO `abilities` (`title`, `description`) VALUES
('HTML', 'Langage de balisage'),
('CSS', 'Langage de style'),
('JavaScript', 'Langage de programmation'),
('PHP', 'Langage de programmation'),
('Java', 'Langage de programmation'),
('C++', 'Langage de programmation'),
('Python', 'Langage de programmation'),
('SQL', 'Langage de requête'),
('NoSQL', 'Langage de requête'),
('MongoDB', 'Base de données'),
('MySQL', 'Base de données'),
('PostgreSQL', 'Base de données'),
('Oracle', 'Base de données'),
('SQL Server', 'Base de données'),
('React', 'Bibliothèque JavaScript'),
('Angular', 'Framework JavaScript'),
('Vue.js', 'Framework JavaScript'),
('Symfony', 'Framework PHP'),
('Laravel', 'Framework PHP'),
('Spring', 'Framework Java'),
('Hibernate', 'Framework Java');

-- Remplissage de la table promotions
DELETE FROM promotions;

INSERT INTO `promotions` (`name`) VALUES ('Informatique'), ('S3E'), ('Générale'), ('BTP');

-- Remplissage de la table offers
DELETE FROM `offers`;

INSERT INTO `offers` (`title`, `description`, `localization`, `starting_date`, `ending_date`, `places`, `salary`, `applies_count`, `type`, `created_at`, `updated_at`, `status`, `company_id`, `promotion_id`) VALUES
('Développeur Front-end', 'Nous recherchons un développeur front-end pour rejoindre notre équipe.', '{\"nom\": \"Vélizy-Villacoublay\", \"code\": \"78640\", \"cp\": \"78140\", \"dep\": \"78\"}', '2025-01-01', '2025-12-31', 5, 30000, 0, 'Stage', NULL, NULL, 'active', 1, 1),
('Développeur Back-end', 'Nous recherchons un développeur back-end pour rejoindre notre équipe.', '{\"nom\":\"Vélizy-Villacoublay\",\"code\":\"78640\",\"cp\":\"78140\",\"dep\":\"78\"}', '2024-01-01', '2024-12-31', 5, 30000, NULL, 'Alternance', NULL, NULL, 'hidden', 1, 1),
('Développeur Full-stack', 'Nous recherchons un développeur full-stack pour rejoindre notre équipe.', '{\"nom\": \"Vélizy-Villacoublay\", \"code\": \"78640\", \"cp\": \"78140\", \"dep\": \"78\"}', '2025-01-01', '2025-12-31', 5, 30000, 0, 'Stage', NULL, NULL, 'active', 1, 1),
('Développeur Front-end', 'Nous recherchons un développeur front-end pour rejoindre notre équipe.', '{\"nom\": \"Paris\", \"code\": \"75056\", \"cp\": \"75001\", \"dep\": \"75\"}', '2024-01-01', '2024-12-31', 5, 30000, 0, 'Alternance', NULL, NULL, 'hidden', 2, 2),
('Développeur Back-end', 'Nous recherchons un développeur back-end pour rejoindre notre équipe.', '{\"nom\":\"Paris\",\"code\":\"75056\",\"cp\":\"75001\",\"dep\":\"75\"}', '2025-01-01', '2025-12-31', 5, 30000, NULL, 'Stage', NULL, NULL, 'active', 2, 2),
('Développeur Full-stack', 'Nous recherchons un développeur full-stack pour rejoindre notre équipe.', '{\"nom\":\"Paris\",\"code\":\"75056\",\"cp\":\"75001\",\"dep\":\"75\"}', '2025-01-01', '2025-12-31', 5, 30000, NULL, 'Stage', NULL, NULL, 'active', 2, 2),
('Développeur Front-end', 'Nous recherchons un développeur front-end pour rejoindre notre équipe.', '{\"nom\":\"Courbevoie\",\"code\":\"92026\",\"cp\":\"92400\",\"dep\":\"92\"}', '2025-01-01', '2025-12-31', 5, 30000, NULL, 'Alternance', NULL, NULL, 'active', 3, 3),
('Développeur Back-end', 'Nous recherchons un développeur back-end pour rejoindre notre équipe.', '{\"nom\":\"Courbevoie\",\"code\":\"92026\",\"cp\":\"92400\",\"dep\":\"92\"}', '2025-01-01', '2025-12-31', 5, 30000, NULL, 'Stage', NULL, NULL, 'active', 3, 3),
('Développeur Full-stack', 'Nous recherchons un développeur full-stack pour rejoindre notre équipe.', '{\"nom\":\"Courbevoie\",\"code\":\"92026\",\"cp\":\"92400\",\"dep\":\"92\"}', '2025-01-01', '2025-12-31', 5, 30000, NULL, 'Alternance', NULL, NULL, 'active', 3, 3),
('Développeur Mobile', 'Nous recherchons un développeur mobile pour rejoindre notre équipe.', '{\"nom\":\"Labège\",\"code\":\"31000\",\"cp\":\"31670\",\"dep\":\"31\"}', '2022-01-01', '2022-12-31', 3, 35000, NULL, 'Stage', NULL, NULL, 'hidden', 4, 1),
('Développeur Python', 'Nous recherchons un développeur Python pour un projet innovant.', '{\"nom\":\"Paris\",\"code\":\"75056\",\"cp\":\"75001\",\"dep\":\"75\"}', '2022-01-01', '2022-12-31', 3, 37000, NULL, 'Stage', NULL, NULL, 'hidden', 2, 2);

-- Remplissage de la table applications
DELETE FROM `applications`;

INSERT INTO `applications` (`offer_id`,`user_id`,`cv`,`letter`) VALUES
(1, 2, 'cv.pdf', 'lettre.pdf'),
(1, 3, 'cv.pdf', 'lettre.pdf'),
(1, 4, 'cv.pdf', 'lettre.pdf'),
(2, 2, 'cv.pdf', 'lettre.pdf'),
(2, 3, 'cv.pdf', 'lettre.pdf'),
(2, 4, 'cv.pdf', 'lettre.pdf'),
(3, 2, 'cv.pdf', 'lettre.pdf'),
(3, 3, 'cv.pdf', 'lettre.pdf'),
(3, 4, 'cv.pdf', 'lettre.pdf');

-- Remplissage de la table student_abilities
DELETE FROM `student_abilities`;

INSERT INTO `student_abilities` (`user_id`, `ability_id`) VALUES
(2,1),
(2,2),
(2,3),
(2,4),
(2,5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(2, 20),
(2, 21),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(4,1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21);

-- Remplissage de la table grades
DELETE FROM `grades`;

INSERT INTO `grades` (`user_id`,`company_id`,`value`) VALUES
(1, 1, 4),
(1, 2, 3),
(1, 3, 4),
(1, 4, 4),
(1, 5, 4),
(2, 1, 4),
(2, 2, 3),
(2, 3, 4),
(2, 4, 4),
(2, 5, 4),
(3, 1, 4),
(3, 2, 3),
(3, 3, 4),
(3, 4, 4),
(3, 5, 4),
(4, 1, 4),
(4, 2, 3),
(4, 3, 4),
(4, 4, 4),
(4, 5, 4),
(5, 1, 4),
(5, 2, 3),
(5, 3, 4),
(5, 4, 4),
(5, 5, 4),
(6, 1, 4),
(6, 2, 3),
(6, 3, 4),
(6, 4, 4),
(6, 5, 4),
(7, 1, 4),
(7, 2, 3),
(7, 3, 4),
(7, 4, 4),
(7, 5, 4),
(8, 1, 4),
(8, 2, 3),
(8, 3, 4),
(8, 4, 4),
(8, 5, 4),
(9, 1, 4),
(9, 2, 3),
(9, 3, 4),
(9, 4, 4),
(9, 5, 4);

-- Remplissage de la table user_promotions
DELETE FROM `user_promotions`;

INSERT INTO `user_promotions` (`user_id`, `promotion_id`) VALUES
(2, 1),
(3, 1),
(4, 3),
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 1);

-- Remplissage de la table user_offer
DELETE FROM `user_offer`;

INSERT INTO `user_offer` (`user_id`, `offer_id`) VALUES
(5, 1),
(6, 2),
(7, 3),
(8, 4),
(9, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9);

-- Remplissage de la table user_wishlist
DELETE FROM `user_wishlist`;

INSERT INTO `user_wishlist` (`offer_id`, `user_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4);

-- Remplissage de la table offer_requirements
DELETE FROM offer_requirements;

INSERT INTO offer_requirements (of_id, ab_id) VALUES
(1, 1), (1, 2), (1, 3),
(2, 4), (2, 5), (2, 6), (2, 9), (2, 14), (2, 15), (2, 16),
(3, 1), (3, 2), (3, 3), (3, 14), (3, 15), (3, 16),
(4, 1), (4, 2), (4, 3), (4, 5), (4, 9), (4, 14), (4, 15), (4, 16),
(5, 4), (5, 5), (5, 6), (5, 9), (5, 13), (5, 14), (5, 15), (5, 16),
(6, 4), (6, 5), (6, 6), (6, 9), (6, 13), (6, 14), (6, 15), (6, 16),
(7, 1), (7, 2), (7, 3), (7, 13), (7, 14), (7, 15), (7, 16),
(8, 4), (8, 5), (8, 6), (8, 13), (8, 14), (8, 15), (8, 16);

