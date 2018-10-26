CREATE DATABASE projetoDw3 COLLATE 'utf8_unicode_ci';

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    username VARCHAR(255) NOT NULL ,
    pwd CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE public_agencies (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    agency_name VARCHAR(255) NOT NULL ,
    pwd CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;

CREATE TABLE biddings (
    id INT NOT NULL AUTO_INCREMENT ,
    title VARCHAR(255) NOT NULL ,
    description VARCHAR(255) NOT NULL ,
    institutionId INT NOT NULL ,
    value DECIMAL NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (institutionId) REFERENCES public_agencies(id)
)
ENGINE = InnoDB;

CREATE TABLE user_bid (
    id INT NOT NULL AUTO_INCREMENT ,
    biddingId INT NOT NULL ,
    userId INT NOT NULL ,
    value DECIMAL NOT NULL ,
    PRIMARY KEY (id),
    FOREIGN KEY (userId) REFERENCES users(id),
    FOREIGN KEY (biddingId) REFERENCES biddings(id)
)
ENGINE = InnoDB;