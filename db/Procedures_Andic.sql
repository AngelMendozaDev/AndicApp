use andic;

CREATE view getAllActions AS SELECT * FROM  acciones ORDER BY ano DESC;
CREATE VIEW getLastAct AS SELECT * FROM acciones ORDER BY id_accion DESC LIMIT 1;

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