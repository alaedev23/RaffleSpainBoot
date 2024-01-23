-- Establecer autoincremental a 1 para la tabla `rsdb`.`client`
ALTER TABLE `rsdb`.`client` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`deliver`
ALTER TABLE `rsdb`.`deliver` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`product`
ALTER TABLE `rsdb`.`product` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`raffle`
ALTER TABLE `rsdb`.`raffle` AUTO_INCREMENT = 1;

-- Inserts para la tabla `rsdb`.`client`
INSERT INTO `rsdb`.`client` (`name`, `password`, `surnames`, `born`, `email`, `phone`, `poblation`, `address`, `sex`)
VALUES 
('John', 'password123', 'Doe', '1990-01-01', 'john.doe@example.com', 123456789, 'City1', 'Address1', 'H'),
('Alice', 'alicepass', 'Smith', '1985-03-15', 'alice.smith@example.com', 987654321, 'City2', 'Address2', 'O'),
('Jane', 'janepass', 'Doe', '1992-05-20', 'jane.doe@example.com', 111223344, 'City3', 'Address3', 'D'),
('Bob', 'bob123', 'Johnson', '1988-09-10', 'bob.johnson@example.com', 554433221, 'City4', 'Address4', 'H');

-- Inserts para la tabla `rsdb`.`deliver`
INSERT INTO `rsdb`.`deliver` (`client_id`, `date`, `date_deliver`)
VALUES 
(1, '2023-11-30', '2023-12-05'),
(2, '2023-11-29', '2023-12-03'),
(3, '2023-11-28', '2023-12-04'),
(4, '2023-11-27', '2023-12-02');

-- Inserts para la tabla `rsdb`.`product`
INSERT INTO `rsdb`.`product` (`name`, `brand`, `price`, `talla`, `color`, `sex`)
VALUES 
('VAMBA1', 'Jordan', 29.99, 1, 'Red', 'H'),
('VAMBA2', 'Jordan', 39.99, 2, 'Blue', 'D'),
('Nike Go FlyEase', 'Nike', 129,99, 42, 'Black', 'M'),
('530', 'New Balance', 120, 44, 'White', 'H'),
('530', 'New Balance', 120, 42, 'White', 'H');

select * from product;
delete from product;

-- Inserts para la tabla `rsdb`.`deliver_has_product`
INSERT INTO `rsdb`.`deliver_has_product` (`deliver_id`, `product_id`, `quantity`)
VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 3, 1),
(4, 4, 2);

-- Inserts para la tabla `rsdb`.`raffle`
INSERT INTO `rsdb`.`raffle` (`product_id`, `date`, `date_end`)
VALUES 
(1, '2023-12-01', '2023-12-10'),
(2, '2023-12-02', '2023-12-12'),
(3, '2023-12-03', '2023-12-15'),
(4, '2023-12-05', '2023-12-18');

-- Inserts para la tabla `rsdb`.`raffle_has_client`
INSERT INTO `rsdb`.`raffle_has_client` (`raffle_id`, `client_id`)
VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4);