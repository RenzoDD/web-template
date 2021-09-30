/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Basic SQL functions
 */

DELIMITER //

-- Hash + Salt SHA256 function
-- 64 char long hex string
DROP FUNCTION IF EXISTS HashSalt //
CREATE FUNCTION HashSalt (DATA TEXT, SALT TEXT) 
RETURNS TEXT
BEGIN
	DECLARE result TEXT;
	SET result = CAST(SHA2( CONCAT(DATA, SALT) , 256 ) AS CHAR);
	RETURN result;
END //

-- Nonce generator function
-- 32 char long hex string
DROP FUNCTION IF EXISTS Nonce //
CREATE FUNCTION Nonce() 
RETURNS TEXT
BEGIN
	RETURN MD5(CAST(FLOOR(RAND()*(999999999999)) AS CHAR));
END //

-- Same our according user local-time independent from the server
-- Use your local datetime
DROP FUNCTION IF EXISTS LocalDateTime //
CREATE FUNCTION LocalDateTime()
RETURNS DATETIME
BEGIN
	RETURN CONVERT_TZ(NOW(), 'SYSTEM', '-05:00');
END //