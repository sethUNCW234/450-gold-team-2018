use sgf8396;
drop procedure IF EXISTS discount;
drop procedure IF EXISTS fullPrice;

DELIMITER $$

CREATE PROCEDURE discount(in amount float)
BEGIN
update pizza
	set price = price * (1-amount);
update topping
	set price = price * (1-amount);
END $$

CREATE PROCEDURE fullPrice()
BEGIN
update topping
	set price = 02.00
	where tType = 'Meat';
update topping
	set price = 01.50
	where tType = 'Vegetarian';
update pizza
	set price = 14.99;
END $$


DELIMITER ;

