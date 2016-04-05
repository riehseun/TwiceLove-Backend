SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `efa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `efa` ;

-- -----------------------------------------------------
-- Table `efa`.`admin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_admin` (
    	`admin_id` INT NOT NULL AUTO_INCREMENT ,
    	`email` VARCHAR(64) NOT NULL ,
	`password` VARCHAR(16) NOT NULL ,
	`daily_coin` INT NOT NULL,
	`is_deleted` INT NOT NULL, 
 	PRIMARY KEY (`admin_id`) ,    	
	UNIQUE INDEX `admin_id_UNIQUE` (`admin_id` ASC) ,
    	UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_user` (
    	`user_id` INT NOT NULL AUTO_INCREMENT, 
   	`first_name` VARCHAR(32) NOT NULL,
    	`last_name` VARCHAR(32) NOT NULL,
    	`email` VARCHAR(64) NOT NULL,
    	`password` VARCHAR(16) NOT NULL,
	`photo_url` VARCHAR(128) NOT NULL,
    	`coins_gave` INT NOT NULL,
    	`coins_received` INT NOT NULL,
    	`likes` INT NOT NULL,
	`phone_number` VARCHAR(16), 
	`education` VARCHAR(64),
	`facebook` VARCHAR(64),
	`linkedin` VARCHAR(64),
	`twitter` VARCHAR(64),
	`instagram` VARCHAR(64),
	`birthday` VARCHAR(16),
	`gender` enum('Male', 'Female', 'Other'),
   	`activation_code` VARCHAR(300) NOT NULL,
    	`is_suspended` INT NOT NULL,
	`is_deleted` INT NOT NULL,  	
    	PRIMARY KEY (`user_id`) ,
    	UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) ,
    	UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`transaction`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_transaction` (
    	`transaction_id` INT NOT NULL AUTO_INCREMENT, 
    	`is_kudo` INT NOT NULL,
    	`is_liked` INT NOT NULL,
	`is_comment` INT NOT NULL,
	`comment_option` VARCHAR(16),
	`giver_id` INT NOT NULL,
    	`receiver_id` INT NOT NULL,
       	`coin_quantity` INT NOT NULL,
	`hash_id` INT NOT NULL,
	`comments` INT NOT NULL,
	`photo_url` VARCHAR(128),
    	`date` DATE NOT NULL,	
    	`is_deleted` INT NOT NULL,  	
	PRIMARY KEY (`transaction_id`) ,
	UNIQUE INDEX `transaction_id_UNIQUE` (`transaction_id` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`hash`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_hash` (
    	`hash_id` INT NOT NULL AUTO_INCREMENT,
    	`name` VARCHAR(32) NOT NULL,
	`is_deleted` INT NOT NULL,  	
    	UNIQUE INDEX `hash_id_UNIQUE` (`hash_id` ASC) ,
    	PRIMARY KEY (`hash_id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`coin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_coin` (
    	`coin_id` INT NOT NULL AUTO_INCREMENT,
    	`value` INT NOT NULL,
	`is_deleted` INT NOT NULL,  	
    	UNIQUE INDEX `coin_id_UNIQUE` (`coin_id` ASC) ,
    	PRIMARY KEY (`coin_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`achievement`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_achievement` (
    	`achievement_id` INT NOT NULL AUTO_INCREMENT,
    	`name` VARCHAR(32) NOT NULL,
	`is_deleted` INT NOT NULL,  	
    	UNIQUE INDEX `achievement_id_UNIQUE` (`achievement_id` ASC) ,
    	PRIMARY KEY (`achievement_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`product`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`EFA_product` (
    	`product_id` INT NOT NULL AUTO_INCREMENT,
    	`name` VARCHAR(32) NOT NULL,
	`price` INT NOT NULL,
	`photo_url` VARCHAR(128) NOT NULL,
	`is_deleted` INT NOT NULL,  	
    	UNIQUE INDEX `product_id_UNIQUE` (`product_id` ASC) ,
    	PRIMARY KEY (`product_id`) )
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

