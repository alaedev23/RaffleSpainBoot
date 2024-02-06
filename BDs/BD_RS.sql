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
CREATE TABLE IF NOT EXISTS `rsdb`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `surnames` VARCHAR(100) NOT NULL,
  `born` DATE NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` INT NOT NULL,
  `poblation` VARCHAR(45) NOT NULL,
  `address` VARCHAR(100) NOT NULL,
  `sex` CHAR(1) NULL DEFAULT NULL,
  `type` CHAR(1) NULL DEFAULT 0,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`facturacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`facturacion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_titular` VARCHAR(200) NOT NULL,
  `direccion_facturacion` VARCHAR(100) NOT NULL,
  `numero_tarjeta` VARCHAR(16) NOT NULL,
  `cvv` char(3) NOT NULL,
  `validez` VARCHAR(5) NOT NULL,
  `cliente_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_facturacion_cliente`
    FOREIGN KEY (`cliente_id`)
    REFERENCES `rsdb`.`client` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Deliver`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`deliver` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `date_deliver` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `client_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `client_id_UNIQUE` (`client_id` ASC) VISIBLE,
  INDEX `fk_pedido_cliente_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_cliente`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `brand` VARCHAR(45) NOT NULL,
  `modelCode` char(6) NOT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `size` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `sex` CHAR(1) NOT NULL,
  `img` VARCHAR(100) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `quantity` INT NOT NULL,
  `discount` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Deliver_has_Product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`deliver_has_product` (
  `deliver_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`deliver_id`, `product_id`),
  INDEX `fk_pedido_has_product_product1_idx` (`product_id` ASC) VISIBLE,
  INDEX `fk_pedido_has_product_pedido1_idx` (`deliver_id` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_has_product_pedido1`
    FOREIGN KEY (`deliver_id`)
    REFERENCES `rsdb`.`deliver` (`id`),
  CONSTRAINT `fk_pedido_has_product_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Raffle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`raffle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `date_end` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `product_id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_raffle_product1_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `fk_raffle_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8mb3;


-- -----------------------------------------------------
-- Table `rsdb`.`Raffle_has_Client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`raffle_has_client` (
  `raffle_id` INT NOT NULL,
  `client_id` INT NOT NULL,
  PRIMARY KEY (`raffle_id`, `client_id`),
  INDEX `fk_raffle_has_client_client1_idx` (`client_id` ASC) VISIBLE,
  INDEX `fk_raffle_has_client_raffle1_idx` (`raffle_id` ASC) VISIBLE,
  CONSTRAINT `fk_raffle_has_client_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`),
  CONSTRAINT `fk_raffle_has_client_raffle1`
    FOREIGN KEY (`raffle_id`)
    REFERENCES `rsdb`.`raffle` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;