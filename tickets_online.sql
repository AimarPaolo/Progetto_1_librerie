DROP DATABASE IF EXISTS tickets_online;

-- Creare il database
CREATE DATABASE tickets_online;

-- Utilizzare il database appena creato
USE tickets_online;

-- Eliminare la tabella se esiste già
DROP TABLE IF EXISTS utenti;

-- Creazione della tabella utenti
CREATE TABLE utenti (
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Inserimento di 3 utenti con email e password
INSERT INTO utenti (email, password) VALUES
('maria.rosaria@gmail.com', 'MariaRosy06@#'), -- password: user1
('roberto.verdi@studenti.polito.it', 'GreenRob01@'), -- password: user2
('annabianchi02@gmail.com', 'AnnaWhite01##'); -- password: user3

/*utilizzo questo script per creare la tabella users che verrà utilizzata per salvare le registrazioni degli utenti nel database*/