
	USE Dominik1169488;
	
    # Creating our table
    -- adding primary key for tracking players
    -- making columns for our data input in php
    -- FOREIGN KEY (roleId) REFERENCES another table (playerRole) in our database 
    -- all inputs are not null (required)
    CREATE TABLE valRoster(
	playerId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(100) NOT NULL,
	lastName VARCHAR(100) NOT NULL,
	alias VARCHAR(50) NOT NULL,
    roleId INT NOT NULL,
	FOREIGN KEY (roleId) REFERENCES playerRole(roleId),
	adr INT NOT NULL
	);
    
    -- altering table to increment starting from 25565 for security and privacy reasons
	ALTER TABLE valRoster AUTO_INCREMENT = 25565;
    
    -- creating another table that will be used for our dropdown menu 
    CREATE TABLE playerRole (
		roleId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		roles VARCHAR(100) NOT NULL
	);
    
    -- inserting data for our dropdown menu since these options are static and more cant be added
    INSERT INTO playerRole (
		roles
	)
	VALUES('Sentinel'),
		('Controller'),
		('Initiator'),
		('Duelist');

	 -- pre-adding data to be displayed (trial input) 
	 INSERT INTO valRoster (firstName, lastName, alias, roleId, adr) 
	 VALUES ('Tyson', 'Ngo', 'TenZ', '4', 163);      
	
    
	SELECT * FROM valRoster;
    
    SET SQL_SAFE_UPDATES=0;
    DELETE FROM valRoster;
	SET SQL_SAFE_UPDATES=1;
 -- SELECT valRoster.*,playerRole.roles AS 'playerRole' 
--  FROM valRoster 
--  INNER JOIN playerRole ON valRoster.roleId=playerRole.roleId 
--  ORDER BY valRoster.adr ASC;

#DROP TABLE valRoster;

ALTER TABLE valRoster
ADD COLUMN userId INT;

SET SQL_SAFE_UPDATES = 0;
UPDATE valRoster
SET userId = 3
WHERE userId IS NULL;
SET SQL_SAFE_UPDATES = 1;

SELECT * FROM valRoster;	
SELECT * FROM users;
    
