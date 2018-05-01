use sgf8396;
source drop_all.sql

CREATE TABLE pizza_users (firstName char(20),
				   lastName char(20),
				   emailAddr char(40),
				   pw char(20),
				   address char(40),
				   PRIMARY KEY (emailAddr)) ENGINE=INNODB;

CREATE TABLE admin_users (firstName char(20),
					lastName char(20),
					adminEmail char(40),
					pw char(20),
					PRIMARY KEY (adminEmail)) ENGINE=INNODB;

CREATE TABLE payment (cardNumber char(16),
					  emailAddr char(40),
					  cvc int,
					  expDate date,
					  PRIMARY KEY (cardNumber),
					  FOREIGN KEY (emailAddr)
					  REFERENCES pizza_users(emailAddr)) ENGINE = INNODB;

CREATE TABLE pizza (pizzaName char(20),
				    price decimal(4,2),
				    PRIMARY KEY (pizzaName)) ENGINE = INNODB;

CREATE TABLE topping (tName char(20),
					  price decimal(4,2),
					  tType char(20),
					  PRIMARY KEY (tName)) ENGINE = INNODB;	

CREATE TABLE orders (orderId int,
					 dateReceived date,
					 emailAddr char(40)
					 totalPrice int(6),
					 isComplete boolean NOT NULL DEFAULT 0,
					 PRIMARY KEY (orderId),
					 FOREIGN KEY (emailAddr)
					 REFERENCES pizza_users(emailAddr)) ENGINE = INNODB;

CREATE TABLE orderDetails (orderId int,
					 		pizzaNumber int,
					 		topping char(30),
					 		PRIMARY KEY (orderId,pizzaNumber,topping),
					 		FOREIGN KEY (topping)
					 		REFERENCES topping(tName),
					 		FOREIGN KEY (orderId)
					 		REFERENCES orders(orderId)) ENGINE = INNODB;

CREATE TABLE pizzaHistory (emailAddr char(40),
						   pizzaNumber int,
						   topping char(30),
						   PRIMARY KEY (emailAddr,pizzaNumber,topping),
						   FOREIGN KEY (emailAddr) 
						   REFERENCES pizza_users(emailAddr),
						   FOREIGN KEY (topping)
						   REFERENCES topping(tName)) ENGINE = INNODB;

CREATE VIEW userInfo AS 
	select firstName, lastName, emailAddr, address
	FROM pizza_users;