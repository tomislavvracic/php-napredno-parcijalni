CREATE TABLE 
messages ( 
    id INT NOT NULL AUTO_INCREMENT, 
    ownerId INT NOT NULL, 
    text VARCHAR(255) NOT NULL, 
    PRIMARY KEY (id), 
    FOREIGN KEY (ownerId) REFERENCES users(id) 
);

CREATE TABLE users
(
	id INT NOT NULL AUTO_INCREMENT,
	username VARCHAR(50) NOT NULL UNIQUE,
	hash VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO `users` (`id`, `username`, `hash`) VALUES ('1', 'tvracic', 'klokan21');