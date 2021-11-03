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

DROP TABLE IF EXISTS value_settings;
DROP TABLE IF EXISTS options_state_settings;
DROP TABLE IF EXISTS state_settings;
DROP TABLE IF EXISTS boolean_settings;
DROP TABLE IF EXISTS settings;

CREATE TABLE settings
(
    pk_setting_id INTEGER NOT NULL,
    title         VARCHAR(255),
    PRIMARY KEY (pk_setting_id)
);

CREATE TABLE value_settings
(
    pk_value_setting_id INTEGER NOT NULL,
    value               VARCHAR(255),
    CONSTRAINT PRIMARY KEY (pk_value_setting_id),
    CONSTRAINT FOREIGN KEY (pk_value_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

CREATE TABLE state_settings
(
    pk_state_setting_id INTEGER NOT NULL,
    CONSTRAINT PRIMARY KEY (pk_state_setting_id),
    CONSTRAINT FOREIGN KEY (pk_state_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

CREATE TABLE options_state_settings
(
    pk_state_option_setting_id INTEGER NOT NULL,
    fk_pk_state_setting_id     INTEGER NOT NULL,
    option_number              INTEGER NOT NULL,
    option_value               VARCHAR(255),
    active_state               BOOLEAN NOT NULL,
    CONSTRAINT PRIMARY KEY (pk_state_option_setting_id),
    CONSTRAINT FOREIGN KEY (fk_pk_state_setting_id) REFERENCES state_settings (pk_state_setting_id) ON DELETE CASCADE
);

CREATE TABLE boolean_settings
(
    pk_boolean_setting_id INTEGER NOT NULL,
    bool                  BOOLEAN,
    CONSTRAINT PRIMARY KEY (pk_boolean_setting_id),
    CONSTRAINT FOREIGN KEY (pk_boolean_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

CREATE TABLE files
(
    pk_file_id INTEGER      NOT NULL AUTO_INCREMENT,
    name       VARCHAR(255) NOT NULL UNIQUE,
    data       LONGBLOB     NOT NULL,
    CONSTRAINT PRIMARY KEY (pk_file_id)
);


/* Insert Settings */
INSERT INTO settings (pk_setting_id, title)
VALUES (1, 'Theme Mode');

INSERT INTO state_settings (pk_state_setting_id)
VALUES (1);

INSERT INTO options_state_settings (pk_state_option_setting_id, fk_pk_state_setting_id, option_number, option_value,
                                    active_state)
VALUES (1, 1, 1, 'Light', true),
       (2, 1, 2, 'Dark', false),
       (3, 1, 3, 'Sync with System', false);


/* Select Settings */
SELECT pk_setting_id, title, value, pk_state_option_setting_id, bool
FROM settings
         LEFT JOIN value_settings ON pk_value_setting_id = settings.pk_setting_id
         LEFT JOIN state_settings ON pk_state_setting_id = settings.pk_setting_id
         LEFT JOIN boolean_settings ON pk_boolean_setting_id = settings.pk_setting_id
         LEFT JOIN options_state_settings
                   ON state_settings.pk_state_setting_id = options_state_settings.fk_pk_state_setting_id
WHERE active_state IS NULL
   OR active_state = true;

SELECT option_number
FROM options_state_settings
WHERE fk_pk_state_setting_id = 1
  AND active_state = true;

UPDATE options_state_settings
SET active_state = false
WHERE fk_pk_state_setting_id = 1;

UPDATE options_state_settings
SET active_state = true
WHERE fk_pk_state_setting_id = 1
  AND option_number = 1;
