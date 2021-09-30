/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Table + Procedure Template
 */
 
DELIMITER //

DROP TABLE IF EXISTS TableTemplate //
CREATE TABLE TableTemplate (
	ClassID 		INTEGER 	AUTO_INCREMENT,

	ClassAtribute1	VARCHAR(50) NOT NULL    UNIQUE,
	ClassAtribute2	TEXT		NOT NULL,
	ClassAtribute3	TEXT,
	
	PRIMARY KEY (ClassID)
) //

DROP PROCEDURE IF EXISTS Class_Create //
CREATE PROCEDURE Class_Create ( IN ClassAtribute1 VARCHAR(50), IN ClassAtribute2 DATETIME )
BEGIN
	SET @salt = Nonce();

	INSERT INTO TableTemplate (ClassAtribute1, ClassAtribute2, ClassAtribute3)
	VALUES 	(ClassAtribute1, HashSalt( ClassAtribute2, @salt ), @salt);

	SELECT  T.*
	FROM 	TableTemplate AS T
	WHERE 	T.ClassAtribute1 = ClassAtribute1
			AND T.ClassAtribute2 = HashSalt( ClassAtribute2, @salt )
			AND T.ClassAtribute3 = @salt;
END //

DROP PROCEDURE IF EXISTS Class_Read_All //
CREATE PROCEDURE Class_Read_All (  )
BEGIN
	SELECT  T.*
	FROM 	TableTemplate AS T;
END //

DROP PROCEDURE IF EXISTS Class_Read_ClassID //
CREATE PROCEDURE Class_Read_ClassID ( IN ClassID INTEGER )
BEGIN
	SELECT  T.*
	FROM 	TableTemplate AS T
	WHERE 	T.ClassID = ClassID;
END //

DROP PROCEDURE IF EXISTS Class_Modify_ClassAtribute1 //
CREATE PROCEDURE Class_Modify_ClassAtribute1 ( IN ClassID INTEGER, IN ClassAtribute1 VARCHAR(50) )
BEGIN
	UPDATE	TableTemplate AS T
	SET		T.ClassAtribute1 = ClassAtribute1
	WHERE 	T.ClassID = ClassID;

	SELECT  T.*
	FROM 	TableTemplate AS T
	WHERE 	T.ClassID = ClassID
			AND T.ClassAtribute1 = ClassAtribute1;
END //

DROP PROCEDURE IF EXISTS Class_Delete_ClassID //
CREATE PROCEDURE Class_Delete_ClassID ( IN ClassID INTEGER )
BEGIN
	DELETE 	T 
	FROM	TableTemplate AS T
	WHERE T.ClassID = ClassID;

	SELECT  T.*
	FROM 	TableTemplate AS T
	WHERE 	T.ClassID = ClassID;
END //