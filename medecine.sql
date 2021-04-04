CREATE TABLE IF NOT EXISTS medic (
    id INT AUTO_INCREMENT,
    username VARCHAR(255),
    password VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    ville VARCHAR(255),
    adresse VARCHAR(255),
    adresse_clinique VARCHAR(255),
    photo_de_profile VARCHAR(255),
    moyene_de_payement VARCHAR(255),
    PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS expertise (
    medic_id INT,
    id INT AUTO_INCREMENT,
    val VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);
CREATE TABLE IF NOT EXISTS Contacts (
    medic_id INT,
    id INT AUTO_INCREMENT,
    label VARCHAR(255),
    val VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);
CREATE TABLE IF NOT EXISTS diplome (
    medic_id INT,
    id INT AUTO_INCREMENT,
    dat_val VARCHAR(255),
    title VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);
CREATE TABLE IF NOT EXISTS tarifs (
    medic_id INT,
    id INT AUTO_INCREMENT,
    price INT,
    label VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);
CREATE TABLE IF NOT EXISTS horaire (
    medic_id INT,
    id INT AUTO_INCREMENT,
    label VARCHAR(255),
    val VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);
CREATE TABLE IF NOT EXISTS lang (
    medic_id INT,
    id INT AUTO_INCREMENT,
    val VARCHAR(255),
    PRIMARY KEY (id),
    FOREIGN KEY (medic_id) REFERENCES medic(id)
);