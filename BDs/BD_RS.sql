-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema rsdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema rsdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rsdb` DEFAULT CHARACTER SET utf8mb3 ;
USE `rsdb` ;

-- -----------------------------------------------------
-- Table `rsdb`.`Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `surnames` VARCHAR(100) NOT NULL,
  `born` DATE NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` INT NOT NULL,
  `sex` CHAR(1) NULL,
  `poblation` VARCHAR(45) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `Email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `Phone_UNIQUE` (`phone` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 10
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Deliver`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Deliver` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_Id` INT NOT NULL,
  `date` DATE NOT NULL,
  `date_Deliver` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `client_Id`),
  UNIQUE INDEX `Id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `Cliente_Id_UNIQUE` (`client_Id` ASC) VISIBLE,
  INDEX `fk_Pedido_Cliente_idx` (`client_Id` ASC) VISIBLE,
  CONSTRAINT `fk_Pedido_Cliente`
    FOREIGN KEY (`client_Id`)
    REFERENCES `rsdb`.`Client` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `brand` VARCHAR(45) NOT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `size` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `Id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Deliver_has_Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Deliver_has_Product` (
  `deliver_Id` INT NOT NULL,
  `product_Id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`deliver_Id`, `product_Id`),
  INDEX `fk_Pedido_has_Product_Product1_idx` (`product_Id` ASC) VISIBLE,
  INDEX `fk_Pedido_has_Product_Pedido1_idx` (`deliver_Id` ASC) VISIBLE,
  CONSTRAINT `fk_Pedido_has_Product_Pedido1`
    FOREIGN KEY (`deliver_Id`)
    REFERENCES `rsdb`.`Deliver` (`id`),
  CONSTRAINT `fk_Pedido_has_Product_Product1`
    FOREIGN KEY (`product_Id`)
    REFERENCES `rsdb`.`Product` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Raffle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Raffle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_Id` INT NOT NULL,
  `date` DATE NOT NULL,
  `date_end` DATE NULL DEFAULT NULL,
  `winner` VARCHAR(45) NULL,
  PRIMARY KEY (`id`, `product_Id`),
  UNIQUE INDEX `Id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_Raffle_Product1_idx` (`product_Id` ASC) VISIBLE,
  CONSTRAINT `fk_Raffle_Product1`
    FOREIGN KEY (`product_Id`)
    REFERENCES `rsdb`.`Product` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Raffle_has_Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`Raffle_has_Client` (
  `raffle_Id` INT NOT NULL,
  `client_Id` INT NOT NULL,
  PRIMARY KEY (`raffle_Id`, `client_Id`),
  INDEX `fk_Raffle_has_Client_Client1_idx` (`client_Id` ASC) VISIBLE,
  INDEX `fk_Raffle_has_Client_Raffle1_idx` (`raffle_Id` ASC) VISIBLE,
  CONSTRAINT `fk_Raffle_has_Client_Client1`
    FOREIGN KEY (`client_Id`)
    REFERENCES `rsdb`.`Client` (`id`),
  CONSTRAINT `fk_Raffle_has_Client_Raffle1`
    FOREIGN KEY (`raffle_Id`)
    REFERENCES `rsdb`.`Raffle` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
