
	USE Dominik1169488;
	
    CREATE TABLE valRoster(
	playerId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	lastName VARCHAR(100) NOT NULL,
	alias VARCHAR(50) NOT NULL,
    roleId INT NOT NULL,
	FOREIGN KEY (roleId) REFERENCES playerRole(roleId),
	adr INT NOT NULL
	);
    
	ALTER TABLE valRoster AUTO_INCREMENT = 25565;
    
    CREATE TABLE playerRole (
		roleId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		roles VARCHAR(100) NOT NULL
	);
    
    INSERT INTO playerRole (
		roles
	)
	VALUES('Sentinel'),
		('Controller'),
		('Initiator'),
		('Duelist');

	
    #DROP TABLE valRoster;
	

    
