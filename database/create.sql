DROP TABLE IF EXISTS users;
CREATE TABLE users(
   id INT AUTO_INCREMENT,
   lastname VARCHAR(50),
   firstname VARCHAR(50),
   email VARCHAR(50),
   password VARCHAR(50),
   role VARCHAR(50),
   PRIMARY KEY(id)
);

DROP TABLE IF EXISTS companies;
CREATE TABLE companies(
   id INT AUTO_INCREMENT,
   name VARCHAR(50),
   sector VARCHAR(50),
   localization VARCHAR(50),
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
   localization TEXT,
   starting_date DATE,
   ending_date DATE,
   places INT,
   salary DOUBLE,
   applies_count INT,
   type VARCHAR(50),
   created_at DATE,
   updated_at DATE,
   company_id INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(company_id) REFERENCES companies(id)
);

DROP TABLE IF EXISTS applications;
CREATE TABLE applications(
   offer_id INT,
   user_id INT,
   cv VARCHAR(50),
   letter VARCHAR(50),
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
