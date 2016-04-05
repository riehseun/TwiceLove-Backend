SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `twice` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `twice` ;

-- -----------------------------------------------------
-- Table `twice`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `twice`.`TWICE_user` (
    	`user_id` INT NOT NULL AUTO_INCREMENT ,
    	`user_name` VARCHAR(64) NOT NULL ,
	`vote` VARCHAR(16) NOT NULL ,	
 	PRIMARY KEY (`user_id`) ,    	
	UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) )
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `twice`.`TWICE_kudo` (
	`kudo_id` INT NOT NULL AUTO_INCREMENT ,
	`name` VARCHAR(64),
	`image` VARCHAR(128),
	`status` VARCHAR(64),
	`profile_pic` VARCHAR(128),
	`time_stamp` VARCHAR(64),
	`url` VARCHAR(128),
	PRIMARY KEY (`kudo_id`),
	UNIQUE INDEX `kudo_id_UNIQUE` (`kudo_id` ASC) )
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

