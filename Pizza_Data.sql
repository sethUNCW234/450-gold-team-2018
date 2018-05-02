use pizza;

set sql_safe_updates=0;

delete from payment;
delete from pizza;
delete from orders;
delete from topping;
delete from orderDetails;
delete from pizzaHistory;
delete from pizza_users;
delete from admin_users;

insert into pizza_users values('Jake', 'Peralta', 'JakePeralta@gmail.com', 'NoicePizza', '791 Lexington Ave');
insert into pizza_users values('Amy', 'Santiago', 'Amy_Santiago@gmail.com', 'H0ltIsTheBest', '791 Lexington Ave');
insert into pizza_users values('Rosa', 'Diaz', 'DetectiveRD@gmail.com', 'K33pOut', '2449 Ocean Ave #3C');
insert into pizza_users values('Terry', 'Jeffords', 'ScaryTerry@gmail.com', '3Angels', '675 Sackett St #206');
insert into pizza_users values('Ray', 'Holt', 'RaymondJHolt@gmail.com', 'Chedd4r', '675 Sackett St #107');
insert into pizza_users values('Charles', 'Boyle', 'BoylingFood@gmail.com', '8thBestTbh', '3979 Nostrand Ave');

insert into admin_users values('Samuel', 'Falcon', 'samfalc@gmail.com', 'abc');

insert into payment values(4718760344435678, 'JakePeralta@gmail.com', 123, '2021-03-01');
insert into payment values(4718760342883356, 'Amy_Santiago@gmail.com', 321, '2022-06-01');
insert into payment values(4718760323345667, 'DetectiveRD@gmail.com', 657, '2021-10-01');
insert into payment values(4718760378890453, 'ScaryTerry@gmail.com', 835, '2022-02-01');
insert into payment values(4718760322222866, 'RaymondJHolt@gmail.com', 159, '2022-07-01');
insert into payment values(4718760325798642, 'BoylingFood@gmail.com', 131, '2021-08-01');

insert into pizza values('Deluxe', 14.99);
insert into pizza values('Meat Lovers', 14.99);
insert into pizza values('Vegetarian', 14.99);
insert into pizza values('Hawaiian', 14.99);
insert into pizza values('BBQ Chicken', 14.99);

insert into topping values('Pepperoni', 02.00,'Meat');
insert into topping values('Ham', 02.00,'Meat');
insert into topping values('Bacon', 02.00,'Meat');
insert into topping values('Chicken', 02.00,'Meat');
insert into topping values('Pineapple', 01.50,'Vegetarian');
insert into topping values('Green Pepper', 01.50,'Vegetarian');
insert into topping values('Jalapeno Pepper', 01.50,'Vegetarian');
insert into topping values('Asiago Cheese', 01.50,'Vegetarian');
insert into topping values('Mushroom', 01.50,'Vegetarian');
insert into topping values('Onion', 01.50,'Vegetarian');

insert into orders (orderId,dateReceived,emailAddr,totalPrice,isComplete) values(11111, '2018-04-16', 'JakePeralta@gmail.com',15,0);
insert into orders (orderId,dateReceived,emailAddr,totalPrice,isComplete) values(22222, '2018-04-15', 'Amy_Santiago@gmail.com',20,0);
insert into orders (orderId,dateReceived,emailAddr,totalPrice,isComplete) values(33333, '2018-04-14', 'DetectiveRD@gmail.com',36,0);

insert into orderDetails values(11111, 1, 'Pepperoni');
insert into orderDetails values (22222, 1, 'Pepperoni');
insert into orderDetails values (22222, 1, 'Ham');
insert into orderDetails values (22222, 1, 'Mushroom');
insert into orderDetails values (33333, 1, 'Pepperoni');
insert into orderDetails values (33333, 1, 'Pineapple');
insert into orderDetails values (33333, 2, 'Onion');
insert into orderDetails values (33333, 2, 'Mushroom');
insert into orderDetails values (33333, 2, 'Green Pepper');


set sql_safe_updates = 1;