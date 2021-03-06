-- MySQL Script generated by MySQL Workbench
-- Sun Mar 10 18:18:03 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema phplay
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema phplay
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `phplay` DEFAULT CHARACTER SET utf8 ;
USE `phplay` ;

-- -----------------------------------------------------
-- Table `phplay`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `phplay`.`user` (
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`name`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `phplay`.`userList`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `phplay`.`userList` (
  `listId` INT NOT NULL AUTO_INCREMENT,
  `userid` VARCHAR(45) NULL,
  PRIMARY KEY (`listId`),
  INDEX `name_idx` (`userid` ASC) VISIBLE,
  CONSTRAINT `name`
    FOREIGN KEY (`userid`)
    REFERENCES `phplay`.`user` (`name`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `phplay`.`video`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `phplay`.`video` (
  `videoId` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(70) NULL,
  `artist` VARCHAR(70) NULL,
  `link` VARCHAR(45) NULL,
  `belongingList` INT NULL,
  PRIMARY KEY (`videoId`),
  INDEX `listId_idx` (`belongingList` ASC) VISIBLE,
  CONSTRAINT `listId`
    FOREIGN KEY (`belongingList`)
    REFERENCES `phplay`.`userList` (`listId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
