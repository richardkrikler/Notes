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
DROP TABLE IF EXISTS state_settings;
DROP TABLE IF EXISTS boolean_settings;
DROP TABLE IF EXISTS settings;

CREATE TABLE settings
(
    pk_setting_id INTEGER NOT NULL,
    title          VARCHAR(255),
    PRIMARY KEY (pk_setting_id)
);

CREATE TABLE value_settings
(
    pk_value_setting_id INTEGER NOT NULL,
    value               VARCHAR(255),
    CONSTRAINT PRIMARY KEY (pk_value_setting_id),
    CONSTRAINT fk_value_setting FOREIGN KEY (pk_value_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

CREATE TABLE state_settings
(
    pk_state_setting_id INTEGER NOT NULL,
    state               INTEGER(2),
    CONSTRAINT PRIMARY KEY (pk_state_setting_id),
    CONSTRAINT fk_state_setting FOREIGN KEY (pk_state_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

CREATE TABLE boolean_settings
(
    pk_boolean_setting_id INTEGER NOT NULL,
    bool                  BOOLEAN,
    CONSTRAINT PRIMARY KEY (pk_boolean_setting_id),
    CONSTRAINT fk_checkbox_setting FOREIGN KEY (pk_boolean_setting_id) REFERENCES settings (pk_setting_id) ON DELETE CASCADE
);

/* Insert Settings */
INSERT INTO settings
VALUES (1, 'Theme Mode');

INSERT INTO state_settings
VALUES (1, 1);

/* Select Settings */
SELECT pk_setting_id, title, value, state, bool
FROM settings
         LEFT JOIN value_settings ON pk_value_setting_id = settings.pk_setting_id
         LEFT JOIN state_settings ON pk_state_setting_id = settings.pk_setting_id
         LEFT JOIN boolean_settings ON pk_boolean_setting_id = settings.pk_setting_id

