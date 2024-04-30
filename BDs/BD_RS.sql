-- MySQL Script generado por MySQL Workbench
-- Mon Feb 19 21:19:09 2024
-- Modelo: rsdb_1    Versión: 1.0
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
CREATE SCHEMA IF NOT EXISTS `rsdb` DEFAULT CHARACTER SET utf8mb3 ;
USE `rsdb` ;

-- -----------------------------------------------------
-- Table `rsdb`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`client` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `surnames` VARCHAR(100) NOT NULL,
  `born` DATE NULL DEFAULT NULL,
  `email` VARCHAR(45) NOT NULL,
  `phone` INT NOT NULL,
  `floor` VARCHAR(45) NULL,
  `door` VARCHAR(45) NULL,
  `postal_code` VARCHAR(5) NULL,
  `poblation` varchar(45) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sex` CHAR(1) NULL,
  `type` CHAR(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `phone_UNIQUE` (`phone` ASC) VISIBLE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`deliver`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`deliver` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `date` DATE NOT NULL,
  `date_deliver` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_pedido_cliente_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_pedido_cliente`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `brand` VARCHAR(45) NOT NULL,
  `modelCode` INT NOT NULL,
  `price` FLOAT NULL DEFAULT NULL,
  `size` INT NOT NULL,
  `color` VARCHAR(45) NOT NULL,
  `sex` CHAR(1) NOT NULL,
  `img` VARCHAR(255) NULL DEFAULT NULL,
  `description` VARCHAR(500) NULL DEFAULT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `discount` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`deliver_has_product`
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
-- Table `rsdb`.`raffle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`raffle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `product_id` INT NOT NULL,
  `date_start` DATE NOT NULL,
  `date_end` DATE NULL DEFAULT NULL,
  `type` INT NOT NULL DEFAULT 0,
  `winner` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_raffle_product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_raffle_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`),
  CONSTRAINT `fk_raffle_winner`
    FOREIGN KEY (`winner`)
    REFERENCES `rsdb`.`client` (`id`)
) ENGINE=InnoDB
AUTO_INCREMENT=5
DEFAULT CHARACTER SET=utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`raffle_has_client`
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

-- -----------------------------------------------------
-- Table `rsdb`.`carreto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`carreto` (
  `client_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `talla` INT NOT NULL,
  PRIMARY KEY (`client_id`, `product_id`),
  INDEX `fk_client_has_product_product1_idx` (`product_id` ASC) VISIBLE,
  INDEX `fk_client_has_product_client1_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_client_has_product_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_has_product_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`favoritos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`favoritos` (
  `client_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`client_id`, `product_id`),
  INDEX `fk_client_has_product_product2_idx` (`product_id` ASC) VISIBLE,
  INDEX `fk_client_has_product_client2_idx` (`client_id` ASC) VISIBLE,
  CONSTRAINT `fk_client_has_product_client2`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_client_has_product_product2`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

-- -----------------------------------------------------
-- Table `rsdb`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rsdb`.`comment` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `client_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `title` VARCHAR(50) NOT NULL,
  `comment` VARCHAR(1000) NOT NULL,
  `value` INT NOT NULL DEFAULT 5,
  `date` DATE NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comments_client1_idx` (`client_id` ASC) VISIBLE,
  INDEX `fk_comments_product1_idx` (`product_id` ASC) VISIBLE,
  CONSTRAINT `fk_comments_client1`
    FOREIGN KEY (`client_id`)
    REFERENCES `rsdb`.`client` (`id`),
  CONSTRAINT `fk_comments_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `rsdb`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb3;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;