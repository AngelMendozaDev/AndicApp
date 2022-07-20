use andic;

CREATE view getAllActions AS SELECT * FROM  acciones ORDER BY ano DESC;
CREATE VIEW getLastAct AS SELECT * FROM acciones ORDER BY id_accion DESC LIMIT 1;
CREATE VIEW getEvents AS select * from evento where fecha_inicio >= now();
CREATE VIEW getAllEvents AS select * from evento order by fecha_inicio DESC;
CREATE VIEW getLastEvent AS SELECT * FROM evento ORDER BY id_evento DESC LIMIT 1;
CREATE VIEW getAllPerson AS SELECT * FROM persona ORDER BY id_p DESC;

DELIMITER $$
	CREATE PROCEDURE newAction(
		in años year,
        in myTitle varchar(60),
        in mult char(1),
        in media varchar(30),
        in texts mediumtext
        )
    BEGIN
		INSERT INTO acciones(ano, titulo,multimedia, media, texto) VALUES (años, myTitle, mult, media, texts);
    END;
$$

DELIMITER $$
	CREATE PROCEDURE updateAction(
		in años year,
        in myTitle varchar(60),
        in mult char(1),
        in media varchar(30),
        in texts mediumtext,
        in idac int
        )
    BEGIN
		UPDATE acciones SET ano = años, titulo = myTitle ,multimedia = mult, media = media, texto = texts WHERE id_accion = idac;
    END;
$$

/***********
* EVENTOS
************************************************/

DELIMITER $$
	CREATE PROCEDURE newEvent(
		in title varchar(40),
        in fechai datetime,
        in horarios varchar(40),
        in foto varchar(10),
        in register int,
        in descrip mediumtext
        )
    BEGIN
		INSERT INTO evento (titulo, fecha_inicio, horario, foto, registro, descript) values(title, fechai, horarios, foto, register, descrip);
    END;
$$

DELIMITER $$
	CREATE PROCEDURE updateEvent(
		in title varchar(40),
        in fechai datetime,
        in horarios varchar(40),
        in picture varchar(10),
        in register int,
        in descrip mediumtext,
        in myEvent int
        )
    BEGIN
		UPDATE evento SET titulo=title, fecha_inicio=fechai, horario=horarios, foto=picture, registro=register, descript=descrip WHERE id_evento = myEvent;
    END;
$$

DELIMITER $$
	CREATE PROCEDURE newPerson(
		in name_p varchar(30),
        in app_p varchar(25),
        in apm_p varchar(25),
        in sex char(1),
        in date_p date,
        in mail varchar(60),
        in phone varchar(10),
        
        in street varchar(60),
        in codep int,
        
        in pass_p varchar(20),
        in perfil_p int
    )
    begin
		declare lastID int default 0;
		INSERT INTO persona (nombre,app,apm,sexo,fecha_nac,correo,tel) VALUES (name_p, app_p, apm_p, sex, date_p, mail, phone);
		SET lastID = LAST_INSERT_ID();
        IF lastID > 0 then
			INSERT INTO domicilio(id_dom, calle, cp) VALUES (lastID, street, codep);
			INSERT INTO angeles(id_angel,pass,picture,perfil) VALUES (lastID,pass_p,'noImg.png',perfil_p);
			commit;
		else
        rollback;
        end if;
    end
$$