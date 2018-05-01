drop trigger IF EXISTS update_history;

DELIMITER ///

    CREATE TRIGGER update_history 
    AFTER INSERT ON orderDetails
    FOR EACH ROW
    BEGIN
        insert into pizzaHistory(emailAddr,pizzaNumber,topping)
            values((select emailAddr from orders where orderId = NEW.orderId), NEW.pizzaNumber, NEW.topping);
    END ///

DELIMITER ;