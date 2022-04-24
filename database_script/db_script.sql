create database CGGraneros;

use CGGraneros;

create table CGTipo_usuario(
id_tip int not null auto_increment primary key,
nom_tip int not null
);

create table CGuser(
id_usu int not null auto_increment primary key,
nom_usu varchar(30) not null,
ape_usu varchar(30) not null,
correo varchar(60) not null,
log_usu varchar(30) not null,
pas_usu varchar(64) not null,
id_tip int not null references CGTipo_usuario(id_tip),
toten varchar(64) not null,
modify timestamp not null
);

create table CGUbicacion(
id_ubi int not null auto_increment primary key,
nom_ubi varchar(30) not null
);

create table CGDocente(
id_doc int not null auto_increment primary key,
nom_doc varchar(30) not null
);