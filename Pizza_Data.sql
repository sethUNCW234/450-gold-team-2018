delete from user;
delete from payment;
delete from pizza;
delete from orders;
delete from topping;
delete from orderInfo;
delete from pizzaHistory;

insert into user values('JakePeralta@gmail.com', 'NoicePizza', 'Jake', 'Peralta', '791 Lexington Ave');
insert into user values('Amy_Santiago@gmail.com', 'H0ltIsTheBest', 'Amy', 'Santiago', '791 Lexington Ave');
insert into user values('DetectiveRD@gmail.com', 'K33pOut', 'Rosa', 'Diaz', '2449 Ocean Ave #3C');
insert into user values('ScaryTerry@gmail.com', '3Angels', 'Terry', 'Jeffords', '675 Sackett St #206');
insert into user values('RaymondJHolt@gmail.com', 'Chedd4r', 'Ray', 'Holt', '675 Sackett St #107');
insert into user values('BoylingFood@gmail.com', '8thBestTbh', 'Charles', 'Boyle', '3979 Nostrand Ave');

insert into payment values(4718760344435678, 'JakePeralta@gmail.com', 123, '2021-03-01');
insert into payment values(4718760342883356, 'Amy_Santiago@gmail.com', 321, '2022-06-01');
insert into payment values(4718760323345667, 'DetectiveRD@gmail.com', 657, '2021-10-01');
insert into payment values(4718760378890453, 'ScaryTerry@gmail.com', 835, '2022-02-01');
insert into payment values(4718760322222866, 'RaymondJHolt@gmail.com', 159, '2022-07-01');
insert into payment values(4718760325798642, 'BoylingFood@gmail.com', 131, '2021-08-01');

insert into pizza values('Deluxe', 14.99);
insert into pizza values('Meal Lovers', 13.99);
insert into pizza values('Vegetarian', 12.99);
insert into pizza values('Hawaiian', 12.99);
insert into pizza values('BBQ Chicken', 13.99);

insert into orders values(1111, 'JakePeralta@gmail.com');
insert into orders values(1112, 'Amy_Santiago@gmail.com');
insert into orders values(1113, 'DetectiveRD@gmail.com');
insert into orders values(1114, 'ScaryTerry@gmail.com');
insert into orders values(1115, 'RaymondJHolt@gmail.com');
insert into orders values(1116, 'BoylingFood@gmail.com');

insert into topping values('Pepperoni', 01.50);
insert into topping values('Ham', 01.50);
insert into topping values('Bacon', 02.00);
insert into topping values('Chicken', 01.50);
insert into topping values('Pineapple', 01.00);
insert into topping values('Green Pepper', 01.00);
insert into topping values('Jalapeno Pepper', 02.00);
insert into topping values('Asiago Cheese', 01.00);
insert into topping values('Mushroom', 01.50);
insert into topping values('Onion', 01.50);

insert into orderInfo values(1111, 'Meat Lovers', Null, Null, Null, 2);
insert into orderInfo values(1112, 'Hawaiian', Null, Null, Null, 1);
insert into orderInfo values(1113, Null, 'Ham', 'Jalapeno Pepper', 'Asiago Cheese', 1);
insert into orderInfo values(1114, 'Meat Lovers', Null, Null, Null, 4);
insert into orderInfo values(1115, Null, 'Mushroom', 'Green Pepper', Null, 1);
insert into orderInfo values(1116, Null, 'Pepperoni', Null, Null, 2);

insert into pizzaHistory values(Null, 'Pepperoni', 'Bacon', 'Chicken', 'JakePeralta@gmail.com');
insert into pizzaHistory values('Hawaiian', Null, Null, Null, 'Amy_Santiago@gmail.com');
insert into pizzaHistory values(Null, 'Ham', 'Jalapeno Pepper', Null, 'DetectiveRD@gmail.com');
insert into pizzaHistory values('Meat Lovers', Null, Null, Null, 'ScaryTerry@gmail.com');
insert into pizzaHistory values(Null, 'Green Pepper', 'Mushroom', 'Onion', 'RaymondJHolt@gmail.com');
insert into pizzaHistory values(Null, 'Pepperoni', Null, Null, 'BoylingFood@gmail.com');