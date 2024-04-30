-- Establecer autoincremental a 1 para la tabla `rsdb`.`client`
ALTER TABLE `rsdb`.`client` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`deliver`
ALTER TABLE `rsdb`.`deliver` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`product`
ALTER TABLE `rsdb`.`product` AUTO_INCREMENT = 1;

-- Establecer autoincremental a 1 para la tabla `rsdb`.`raffle`
ALTER TABLE `rsdb`.`raffle` AUTO_INCREMENT = 1;

-- Inserts para la tabla `rsdb`.`client`
INSERT INTO `rsdb`.`client` (`id`, `name`, `password`, `surnames`, `born`, `email`, `phone`, `floor`, `door`, `postal_code`, `poblation`, `address`, `sex`, `type`)
VALUES
('1', 'Marc', 'Marc1234_', 'Polan', '2024-04-04', 'polanmarc19@gmail.com', '932132140', '1', '2', '08304', 'Mataro', 'Calle de los Rinocerontes', 'H', '2'),
('5', 'Alae', 'alae1234', 'Polan', '2003-07-22', 'alae@gmail.com', '612532121', NULL, NULL, '08304', 'Mataro', 'Calle d elos fLAMENCOS, 21', 'H', '1'),
('75', 'Alae', 'Alae_1234', 'Harrak', '2024-04-04', 'thos.harrak.alae@gmail.com', '932132132', NULL, NULL, '08304', 'Mataro', 'Calle d elos fLAMENCOS, 21', 'H', '1');

-- Inserts para la tabla `rsdb`.`deliver`
INSERT INTO `rsdb`.`deliver` (`client_id`, `date`, `date_deliver`)
VALUES 
(1, '2023-11-30', '2023-12-05'),
(2, '2023-11-29', '2023-12-03'),
(3, '2023-11-28', '2023-12-04'),
(4, '2023-11-27', '2023-12-02');

-- Inserts para la tabla `rsdb`.`product`
INSERT INTO `rsdb`.`product` (`name`, `brand`, `modelCode`,`price`, `size`, `color`, `sex`, `img`, `description`,`quantity`, `discount`)
VALUES 
('Go-FlyEase', 'Nike', 000001, 129.99, 42, 'Black', 'M', 'Nike_Go-FlyEase_Black.png', 'Esto es un texto de prueba para las Nike Go-FlyEase', 5, 0),
('530', 'New-Balance', 000002, 120, 44, 'White', 'H', 'New-Balance_530_White.png', 'Esto es un texto de prueba para las New-Balance - 530', 1, 10),
('530', 'New-Balance', 000002, 120, 42, 'White', 'H', 'New-Balance_530_White.png', 'Esto es un texto de prueba para las New-Balance - 530', 2, 0),
('1-High-OG-Satin-Bred', 000003, 'Jordan', 189.99, 39, 'Red-White', 'M', 'Jordan_1-High-OG-Satin-Bred_Red-White.png', 'Esto es un texto de prueba para las Jordan 1-High-OG-"Satin-Bred"', 2, 0),
('Classic-Clog-DreamWorks-Shrek', 000004, 'Crocs', 110, 42, 'Green', 'N', 'Crocs_Classic-Clog-DreamWorks-Shrek.png', 'Esto es un texto de prueba para las Crocs - Classic Clog DreamWorks Shrek', 1, 0),
('MAG-Back-to-the-Future-2011', 000005, 'Nike', 20000, 44, 'Grey', 'H', 'Nike_MAG-Back-to-the-Future-2011.png', 'Esto es un texto de prueba para las Nike - MAG Back to the Future 2011', 1, 0),
('Retro-4-Thunder-2023', 'Jordan', 000006, 330, 43, 'Yellow', 'H', 'Jordan_Retro-4-Thunder-2023.png', 'Esto es un texto de prueba para las Joradn - Retro Thunder 2023', 1, 10);


select * from product;

-- Inserts para la tabla `rsdb`.`deliver_has_product`
INSERT INTO `rsdb`.`deliver_has_product` (`deliver_id`, `product_id`, `quantity`)
VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 3, 1);

-- Inserts para la tabla `rsdb`.`raffle`
INSERT INTO `rsdb`.`raffle` (`product_id`, `date_start`, `date_end`)
VALUES 
(1, '2023-12-01 09:00:00', '2024-12-10 09:00:00'),
(2, '2023-12-02 09:00:00', '2024-12-12 09:00:00'),
(4, '2023-12-03 09:00:00', '2024-12-15 09:00:00');

select * from raffle;

-- Inserts para la tabla `rsdb`.`raffle_has_client`
INSERT INTO `rsdb`.`raffle_has_client` (`raffle_id`, `client_id`)
VALUES 
(1, 1),
(2, 2),
(3, 3);

select * from raffle_has_client;