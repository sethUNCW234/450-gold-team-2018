drop trigger IF EXISTS update_history;

DELIMITER ///

    CREATE TRIGGER update_history 
    AFTER INSERT ON orderDetails
    FOR EACH ROW
    BEGIN
        insert into pizzaHistory(email,pizzaNumber,topping)
            values((select email from orders where orderId = NEW.orderId), NEW.pizzaNumber, NEW.topping);
    END ///

DELIMITER ;