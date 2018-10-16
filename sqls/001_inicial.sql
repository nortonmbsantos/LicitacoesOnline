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
