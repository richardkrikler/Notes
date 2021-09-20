DROP DATABASE IF EXISTS codingnotes;
CREATE DATABASE codingnotes CHARACTER SET utf8 COLLATE utf8_general_ci;
USE codingnotes;

CREATE TABLE folders
(
    pk_folder_id INTEGER AUTO_INCREMENT NOT NULL,
    name         VARCHAR(255),
    CONSTRAINT PRIMARY KEY (pk_folder_id)
);

CREATE TABLE notes
(
    pk_note_id      INTEGER AUTO_INCREMENT NOT NULL,
    fk_pk_folder_id INTEGER                NOT NULL,
    title           VARCHAR(255),
    CONSTRAINT PRIMARY KEY (pk_note_id),
    CONSTRAINT FOREIGN KEY (fk_pk_folder_id) REFERENCES folders (pk_folder_id)
);