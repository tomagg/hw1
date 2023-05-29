-- Active: 1685289891967@@127.0.0.1@3306@test
use test;
SELECT*
FROM utenti;

create table utenti
(
    id int(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(60),
    cognome VARCHAR(60),
    username VARCHAR(60),
    email VARCHAR(60),
    password VARCHAR(60),
)engine='INNODB';

select* from prodotto;
create table prodotto
(
    id_prodotto int(11) PRIMARY KEY AUTO_INCREMENT,
    immagine VARCHAR(1024),
    prezzo int (11),
    descrizione VARCHAR(1024),
    tipologia VARCHAR(1024)
)engine='INNODB';

select * from carrello;
create table carrello
(
    codice_acquisto int(11) PRIMARY KEY AUTO_INCREMENT,
    id_utente int(11),
    id_prodotto int(11),
    content json,
    index idx_utente(id_utente),
    Foreign Key (id_utente) REFERENCES utenti(id),
    index idx_prodotto(id_prodotto),
    Foreign Key (id_prodotto) REFERENCES prodotto(id_prodotto)
)engine='INNODB';

SELECT* from recensioni;
create table recensioni
(
    id_recenisone int(11) primary key AUTO_INCREMENT,
    id_utente int(11),
    descrizione varchar(1024),
    index idx_utente(id_utente),
    Foreign Key (id_utente) REFERENCES utenti(id)
)ENGINE="INNODB",