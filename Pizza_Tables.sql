use sgf8396;
source drop_all.sql

CREATE TABLE pizza_users (
				`firstName` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  				`lastName` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  				`emailAddr` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
  				`pw` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  				PRIMARY KEY (`emailAddr`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE payment (cardNumber char(16),
					  emailAddr char(60),
					  cvc int,
					  expDate date,
					  PRIMARY KEY (cardNumber),
					  FOREIGN KEY (emailAddr)
					  REFERENCES user(emailAddr)) ENGINE = INNODB;

CREATE TABLE pizza (pizzaName char(20),
				  price decimal(4, 2),
				  PRIMARY KEY (pizzaName)) ENGINE = INNODB;

CREATE TABLE orders (orderId int,
					 emailAddr char(60),
					 PRIMARY KEY (orderId),
					 FOREIGN KEY (emailAddr)
					 REFERENCES user(emailAddr)) ENGINE = INNODB;

CREATE TABLE topping (tName char(20),
					  price decimal(4, 2),
					  PRIMARY KEY (tName)) ENGINE = INNODB;

CREATE TABLE orderInfo (orderId int,
						pizzaName char(20),
						topping1 char(20),
						topping2 char(20),
						topping3 char(20),
						quantity int,
						PRIMARY KEY (orderId,pizzaName,topping1,topping2,topping3),
						FOREIGN KEY (orderId)
						REFERENCES orders(orderId),
						FOREIGN KEY (pizzaName)
						REFERENCES pizza(pizzaName),
						FOREIGN KEY (topping1)
						REFERENCES topping(tName),
						FOREIGN KEY (topping2)
						REFERENCES topping(tName),
						FOREIGN KEY (topping3)
						REFERENCES topping(tName)) ENGINE = INNODB;

CREATE TABLE pizzaHistory (pizzaName char(30),
						   topping1 char(20),
						   topping2 char(20),
						   topping3 char(20),
						   emailAddr char(60),
						   PRIMARY KEY (pizzaName,topping1,topping2,topping3,emailAddr),
						   FOREIGN KEY (pizzaName)
						   REFERENCES pizza(pizzaName),
						   FOREIGN KEY (emailAddr) 
						   REFERENCES user(emailAddr)) ENGINE = INNODB;