DROP DATABASE IF EXISTS CodingNotes;
CREATE DATABASE CodingNotes CHARACTER SET utf8 COLLATE utf8_general_ci;
USE CodingNotes;

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
    content         LONGTEXT,
    CONSTRAINT PRIMARY KEY (pk_note_id),
    CONSTRAINT FOREIGN KEY (fk_pk_folder_id) REFERENCES folders (pk_folder_id)
);


/* Insert Folders */
INSERT INTO folders (name)
VALUES ('SEW-4BI-HTL'),
       ('MEDT-WEBT-4BI-HTL');

/* Insert Notes */
INSERT INTO notes (fk_pk_folder_id, title, content)
VALUES (1, '2.SÜ: Einführung JS - 15.09.2021', '# 2.SÜ: Einführung JS - 15.09.2021');

/* Get all Notes of a Folder */
SELECT pk_note_id, title
FROM notes
WHERE fk_pk_folder_id = 1;

