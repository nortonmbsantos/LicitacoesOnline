CREATE DATABASE app0 COLLATE 'utf8_unicode_ci';

CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT ,
    email VARCHAR(255) NOT NULL ,
    username VARCHAR(255) NOT NULL ,
    pwd CHAR(60) NOT NULL ,
    PRIMARY KEY (id)
)
ENGINE = InnoDB;
