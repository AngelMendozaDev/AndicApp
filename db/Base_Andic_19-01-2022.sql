/**************
* Base de datos para ANDIC A.C.
* Realizada: 16-01-2022
* Creo: Mendoza Garcia Luis Angel
********************/
drop database andic;

create database andic;

use andic;

/***********Entidades Fuertes*************/

create table persona(
	id_p int auto_increment not null,
    nombre varchar(30) not null,
    app varchar(25) not null,
    apm varchar(25) not null,
    sexo char(1) not null,
    fecha_nac date not null,
    correo varchar(60) not null,
    tel varchar(10) not null,
    primary key (id_p)
);

create table acciones(
	id_accion int auto_increment not null,
    ano year not null,
    titulo varchar(60) not null,
    multimedia char(1) not null,
    media varchar(30) not null,
    texto mediumtext not null,
    primary key(id_accion)    
);

create table estado(
	id_estado int auto_increment not null,
    estado_n varchar(30) not null,
    primary key(id_estado)
);

create table evento(
	id_evento int auto_increment not null,
    titulo varchar(40) not null,
    fecha_inicio datetime default now(),
    horario varchar(30) not null,
    foto varchar(10) not null,
    registro int not null,
    descript mediumtext not null,
    primary key(id_evento)
);

CREATE TABLE apoyos(
	id_apoyo int auto_increment not null,
    apoyo varchar(25) not null,
    primary key(id_apoyo)
);

/********RAMA DE DOMICILIO********/

create table cp_col(
	n_registro int auto_increment not null,
    cp varchar(6) not null,
    col varchar(60) not null,
    mun varchar(50) not null,
    estado int not null,
    primary key(n_registro),
    foreign key(estado) references estado(id_estado)
);

create table domicilio(
	id_dom int not null,
    calle varchar(60) not null,
    cp int not null,
    primary key(id_dom),
    foreign key(cp) references cp_col(n_registro),
    foreign key(id_dom) references persona(id_p)
);

/******Grados de persona*******/

create table servicio(
	id_servicio int not null,
    escuela varchar(60) not null,
    carrera varchar(60) not null,
    semestre int not null,
    primary key(id_servicio),
    foreign key(id_servicio) references persona(id_p)
);

create table representante(
	id_rep int not null,
    primary key(id_rep),
    foreign key (id_rep) references persona(id_p)
);

create table angeles(
	id_angel int not null,
    pass varchar(20) not null,
    picture varchar(20) not null,
    perfil int not null,
    primary key(id_angel),
    foreign key(id_angel) references persona(id_p)
);

/*******ALIADOS***********/

create table aliados(
	id_aliado int auto_increment not null,
    nombre_c varchar(40) not null,
    nombre_com varchar(60) not null,
    rep int not null,
    primary key(id_aliado),
    foreign key(rep) references representante(id_rep)
);

/***************RAMA APOYOS ANGELES Y ALIADOS******************/
 create table angeles_apoyo(
	folio_apoyo int auto_increment not null,
    angel int not null,
    apoyo int not null,
    primary key(folio_apoyo),
    foreign key(angel) references angeles(id_angel),
    foreign key(apoyo) references apoyos(id_apoyo)
 );
 
 create table aliado_apoyo(
	folio_apoyo int auto_increment not null,
    aliado int not null,
    apoyo int not null,
    primary key(folio_apoyo),
    foreign key(aliado) references aliados(id_aliado),
    foreign key(apoyo) references apoyos(id_apoyo)
 );
 
 /******************* RAMA DE EVENTOS ****************************/
 
 create table registro_event(
	folio_registro int auto_increment not null,
    angel int not null,
    evento int not null,
    fecha_registro datetime default now(),
    primary key(folio_registro),
    foreign key(angel) references angeles(id_angel),
    foreign key(evento) references evento(id_evento)
 );
 
 create table asistencia_event(
	folio_asistencia int auto_increment not null,
    registro int not null,
    asistencia datetime default now(),
    primary key(folio_asistencia),
    foreign key(registro) references registro_event(folio_registro)
 );