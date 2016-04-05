SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `efa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `efa` ;

-- -----------------------------------------------------
-- Table `efa`.`admin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`admin` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `password` VARCHAR(16) NOT NULL ,
    `email` VARCHAR(45) NOT NULL ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
    UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`employee`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`employee` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `first` VARCHAR(24) NOT NULL,
    `last` VARCHAR(24) NOT NULL,
    `photo_url` VARCHAR(128) NOT NULL,
    `email` VARCHAR(45) NOT NULL,
    `password` VARCHAR(16) NOT NULL,
    `coins_left` INT NOT NULL,
    `coins_given` INT NOT NULL,
    `coins_received` INT NOT NULL,
    `last_received` INT NOT NULL,
    `likes` INT NOT NULL, 
    `date_joined` DATE NOT NULL, 
    `time_joined` TIME NOT NULL,
    `period` INT NOT NULL,
    `last_date` DATE NOT NULL,
    `last_time` TIME NOT NULL,
    `last_date_int` INT NOT NULL,
    `activation` VARCHAR(300) NOT NULL,
    `status` enum('0','1') NOT NULL DEFAULT '0',
    `today` INT NOT NULL,
    PRIMARY KEY (`id`) ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
    UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`transaction`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`transaction` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `kudo_id` INT NOT NULL,
    `giver_id` INT NOT NULL,
    `giver_first` VARCHAR(24) NOT NULL,
    `giver_last` VARCHAR(24) NOT NULL,
    `receiver_id` INT NOT NULL,
    `receiver_first` VARCHAR(24) NOT NULL,
    `receiver_last` VARCHAR(24) NOT NULL,
    `quantity` INT NOT NULL,
    `date` DATE NOT NULL,
    `date_int` INT NOT NULL,
    `time` TIME NOT NULL,
    `period` INT NOT NULL,  
    PRIMARY KEY (`id`) ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`kudo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`kudo` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `giver_id` INT NOT NULL,
    `giver_first` VARCHAR(24) NOT NULL,
    `giver_last` VARCHAR(24) NOT NULL,
    `receiver_id` INT NOT NULL,
    `receiver_first` VARCHAR(24) NOT NULL,
    `receiver_last` VARCHAR(24) NOT NULL,
    `quantity` INT NOT NULL,
    `likes` INT NOT NULL,
    `hash` VARCHAR(45),
    `message` VARCHAR(200),
    `photo_url` VARCHAR(128),
    `giver_photo_url` VARCHAR(128),
    `receiver_photo_url` VARCHAR(128),
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `period` INT NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `efa`.`turnover`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`turnover` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `period` INT NOT NULL,
    `daily_coin` INT NOT NULL,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`hash`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`hash` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `hash` VARCHAR(45) NOT NULL,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`coin`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`coin` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `value` INT NOT NULL,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
    PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`likes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`likes` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `giver_id` INT NOT NULL,
    `receiver_id` INT NOT NULL,
    `kudo_id` INT NOT NULL,
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `period` INT NOT NULL,
    PRIMARY KEY (`id`) ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`comment` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `giver_id` INT NOT NULL,
    `giver_first` VARCHAR(24) NOT NULL,
    `giver_last` VARCHAR(24) NOT NULL,
    `giver_photo_url` VARCHAR(128),
    `receiver_id` INT NOT NULL,
    `comment` VARCHAR(200) NOT NULL,
    `hash` VARCHAR(45),
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `option` VARCHAR(24) NOT NULL,
    `quantity` INT NOT NULL,
    `period` INT NOT NULL,
    PRIMARY KEY (`id`) ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `efa`.`kudo_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `efa`.`kudo_comment` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `kudo_id` INT NOT NULL,
    `giver_id` INT NOT NULL,
    `giver_first` VARCHAR(24) NOT NULL,
    `giver_last` VARCHAR(24) NOT NULL,
    `giver_photo_url` VARCHAR(128),
    `comment` VARCHAR(200) NOT NULL,
    `date` DATE NOT NULL,
    `time` TIME NOT NULL,
    `period` INT NOT NULL,
    PRIMARY KEY (`id`) ,
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

