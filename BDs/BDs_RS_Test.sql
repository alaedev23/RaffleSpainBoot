use rsdb;
-- Inserting dummy data into Client table
INSERT INTO `rsdb`.`Client` (`Name`, `Password`, `Surnames`, `Born`, `Email`, `Phone`)
VALUES 
('John', 'password123', 'Doe', '1990-01-01', 'john.doe@example.com', 123456789),
('Alice', 'alicepass', 'Smith', '1985-03-15', 'alice.smith@example.com', 987654321),
('Jane', 'janepass', 'Doe', '1992-05-20', 'jane.doe@example.com', 111223344),
('Bob', 'bob123', 'Johnson', '1988-09-10', 'bob.johnson@example.com', 554433221);

-- Inserting dummy data into Deliver table
INSERT INTO `rsdb`.`Deliver` (`Client_Id`, `Date`, `Date_Deliver`)
VALUES 
(1, '2023-11-30', '2023-12-05'),
(2, '2023-11-29', '2023-12-03'),
(3, '2023-11-28', '2023-12-04'),
(4, '2023-11-27', '2023-12-02');

-- Inserting dummy data into Product table
INSERT INTO `rsdb`.`Product` (`Name`, `Brand`, `Price`, `Talla`, `Color`)
VALUES 
('VAMBA1', 'VAMBA', 29.99, 1, 'Red'),
('VAMBA2', 'VAMBA', 39.99, 2, 'Blue'),
('VAMBA3', 'VAMBA', 19.99, 3, 'Green'),
('VAMBA4', 'VAMBA', 49.99, 4, 'Yellow');

-- Inserting dummy data into Deliver_has_Product table
INSERT INTO `rsdb`.`Deliver_has_Product` (`Deliver_Id`, `Product_Id`, `Quantitat`)
VALUES 
(1, 1, 2),
(2, 2, 1),
(3, 3, 1),
(4, 4, 2);

-- Inserting dummy data into Raffle table
INSERT INTO `rsdb`.`Raffle` (`Product_Id`, `Date`, `Date_end`)
VALUES 
(1, '2023-12-01', '2023-12-10'),
(2, '2023-12-02', '2023-12-12'),
(3, '2023-12-03', '2023-12-15'),
(4, '2023-12-05', '2023-12-18');

-- Inserting dummy data into Raffle_has_Client table
INSERT INTO `rsdb`.`Raffle_has_Client` (`Raffle_Id`, `Client_Id`)
VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4);