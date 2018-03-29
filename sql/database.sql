CREATE DATABASE registration;
USE registration;
CREATE TABLE Users (
    ID int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(100),
    company varchar(100),
    date datetime,
    PRIMARY KEY (ID)
);