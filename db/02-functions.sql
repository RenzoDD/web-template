/*
 * Copyright 2021 (c) Renzo Diaz
 * Licensed under MIT License
 * Basic SQL functions
 */

DELIMITER //

-- Nonce generator function
-- 32 char long hex string
DROP FUNCTION IF EXISTS Nonce //
CREATE FUNCTION Nonce() 
RETURNS TEXT
BEGIN
	RETURN MD5(CAST(FLOOR(RAND()*(999999999999)) AS CHAR));
END //

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

-- Get local date independent from the server
-- Set the desired timezone
DROP FUNCTION IF EXISTS LocalDateTime //
CREATE FUNCTION LocalDateTime()
RETURNS DATETIME
BEGIN
	RETURN CONVERT_TZ(NOW(), 'SYSTEM', '+00:00');
END //

-- Get datetime from unix timestamp
-- Set the desired timezone
DROP FUNCTION IF EXISTS UnixToDate //
CREATE FUNCTION UnixToDate(unix_time INTEGER) RETURNS DATETIME
BEGIN
	RETURN CONVERT_TZ(FROM_UNIXTIME(unix_time), 'SYSTEM', '+00:00');
END //