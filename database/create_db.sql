DROP DATABASE IF EXISTS db_note;

CREATE DATABASE db_note CHARSET 'utf8';

USE db_note;

CREATE TABLE dn_note(
    n_id INT UNSIGNED AUTO_INCREMENT,
    n_creation_date DATETIME,
    n_modification_date DATETIME,
    n_content TEXT,

    PRIMARY KEY (n_id)
)
ENGINE = InnoDB;

CREATE TABLE dn_tag(
    t_name VARCHAR(500),

    PRIMARY KEY (t_name)
)
ENGINE = InnoDB;

CREATE TABLE dn_note_tag(
    nt_note_id INT UNSIGNED,
    nt_tag_name VARCHAR(500),

    PRIMARY KEY (nt_note_id, nt_tag_name),
    CONSTRAINT fk_nt_note_id_n_id
        FOREIGN KEY (nt_note_id)
            REFERENCES dn_note(n_id)
                ON DELETE CASCADE
                ON UPDATE CASCADE,
    CONSTRAINT fk_nt_tag_name_t_name
        FOREIGN KEY (nt_tag_name)
            REFERENCES dn_tag(t_name)
                ON DELETE CASCADE
                ON UPDATE CASCADE
)
ENGINE = InnoDB;