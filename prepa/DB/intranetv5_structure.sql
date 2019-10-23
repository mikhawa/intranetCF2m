-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema intranetv5
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `intranetv5` ;

-- -----------------------------------------------------
-- Schema intranetv5
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `intranetv5` DEFAULT CHARACTER SET utf8 ;
USE `intranetv5` ;

-- -----------------------------------------------------
-- Table `intranetv5`.`lutilisateur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lutilisateur` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lutilisateur` (
  `idlutilisateur` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lenomutilisateur` VARCHAR(80) NOT NULL,
  `lemotdepasse` VARCHAR(255) NOT NULL COMMENT 'crypt with password_hash - PASSWORD_DEFAULT ',
  `lenom` VARCHAR(45) NOT NULL,
  `leprenom` VARCHAR(45) NOT NULL,
  `lemail` VARCHAR(180) NOT NULL,
  `luniqueid` CHAR(26) NOT NULL COMMENT 'create with uniqid(key,true) string(26)',
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idlutilisateur`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lenomutilisateur_UNIQUE` ON `intranetv5`.`lutilisateur` (`lenomutilisateur` ASC);

CREATE UNIQUE INDEX `lemail_UNIQUE` ON `intranetv5`.`lutilisateur` (`lemail` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lerole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lerole` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lerole` (
  `idlerole` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lintitule` VARCHAR(60) NOT NULL,
  `ladescription` VARCHAR(300) NULL,
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idlerole`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `intitule_UNIQUE` ON `intranetv5`.`lerole` (`lintitule` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lutilisateur_has_lerole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lutilisateur_has_lerole` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lutilisateur_has_lerole` (
  `lutilisateur_idutilisateur` MEDIUMINT UNSIGNED NOT NULL,
  `lerole_idlerole` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`lutilisateur_idutilisateur`, `lerole_idlerole`),
  CONSTRAINT `fk_utilisateur_has_lerole_utilisateur`
    FOREIGN KEY (`lutilisateur_idutilisateur`)
    REFERENCES `intranetv5`.`lutilisateur` (`idlutilisateur`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateur_has_lerole_lerole1`
    FOREIGN KEY (`lerole_idlerole`)
    REFERENCES `intranetv5`.`lerole` (`idlerole`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_utilisateur_has_lerole_lerole1_idx` ON `intranetv5`.`lutilisateur_has_lerole` (`lerole_idlerole` ASC);

CREATE INDEX `fk_utilisateur_has_lerole_utilisateur_idx` ON `intranetv5`.`lutilisateur_has_lerole` (`lutilisateur_idutilisateur` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`ledroit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`ledroit` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`ledroit` (
  `idledroit` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lintitule` VARCHAR(60) NOT NULL,
  `ladescription` VARCHAR(300) NULL,
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idledroit`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `theintitule_UNIQUE` ON `intranetv5`.`ledroit` (`lintitule` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lerole_has_ledroit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lerole_has_ledroit` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lerole_has_ledroit` (
  `lerole_idlerole` SMALLINT UNSIGNED NOT NULL,
  `ledroit_idledroit` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`lerole_idlerole`, `ledroit_idledroit`),
  CONSTRAINT `fk_lerole_has_ledroit_lerole1`
    FOREIGN KEY (`lerole_idlerole`)
    REFERENCES `intranetv5`.`lerole` (`idlerole`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lerole_has_ledroit_ledroit1`
    FOREIGN KEY (`ledroit_idledroit`)
    REFERENCES `intranetv5`.`ledroit` (`idledroit`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lerole_has_ledroit_ledroit1_idx` ON `intranetv5`.`lerole_has_ledroit` (`ledroit_idledroit` ASC);

CREATE INDEX `fk_lerole_has_ledroit_lerole1_idx` ON `intranetv5`.`lerole_has_ledroit` (`lerole_idlerole` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lafiliere`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lafiliere` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lafiliere` (
  `idlafiliere` TINYINT(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lenom` VARCHAR(45) NOT NULL,
  `lacronyme` VARCHAR(10) NOT NULL,
  `lacouleur` VARCHAR(10) NULL,
  `lepicto` VARCHAR(45) NULL,
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idlafiliere`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intranetv5`.`lasession`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lasession` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lasession` (
  `idlasession` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lenom` VARCHAR(45) NOT NULL,
  `lacronyme` VARCHAR(10) NOT NULL,
  `lannee` YEAR(4) NOT NULL,
  `lenumero` TINYINT(1) NULL,
  `letype` TINYINT(1) NOT NULL,
  `debut` DATE NOT NULL,
  `fin` DATE NOT NULL,
  `lafiliere_idfiliere` TINYINT(3) UNSIGNED NOT NULL,
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idlasession`),
  CONSTRAINT `fk_session_filiere1`
    FOREIGN KEY (`lafiliere_idfiliere`)
    REFERENCES `intranetv5`.`lafiliere` (`idlafiliere`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_session_filiere1_idx` ON `intranetv5`.`lasession` (`lafiliere_idfiliere` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`linscription`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`linscription` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`linscription` (
  `idlinscription` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `debut` DATE NULL,
  `fin` DATE NULL,
  `utilisateur_idutilisateur` MEDIUMINT UNSIGNED NOT NULL,
  `lasession_idsession` INT UNSIGNED NOT NULL,
  `actif` TINYINT UNSIGNED NULL DEFAULT 1,
  PRIMARY KEY (`idlinscription`),
  CONSTRAINT `fk_inscription_utilisateur1`
    FOREIGN KEY (`utilisateur_idutilisateur`)
    REFERENCES `intranetv5`.`lutilisateur` (`idlutilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscription_session1`
    FOREIGN KEY (`lasession_idsession`)
    REFERENCES `intranetv5`.`lasession` (`idlasession`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_inscription_utilisateur1_idx` ON `intranetv5`.`linscription` (`utilisateur_idutilisateur` ASC);

CREATE INDEX `fk_inscription_session1_idx` ON `intranetv5`.`linscription` (`lasession_idsession` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`leconge`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`leconge` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`leconge` (
  `idleconge` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `debut` DATE NOT NULL COMMENT 'début du congé',
  `fin` DATE NOT NULL COMMENT 'fin du congé',
  `letype` TINYINT(1) NOT NULL COMMENT '1 = matin, 2 = après-midi, 3 = toute la journée',
  PRIMARY KEY (`idleconge`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `intranetv5`.`lasession_has_leconge`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lasession_has_leconge` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lasession_has_leconge` (
  `lasession_idlasession` INT UNSIGNED NOT NULL,
  `leconge_idleconge` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`lasession_idlasession`, `leconge_idleconge`),
  CONSTRAINT `fk_lasession_has_leconge_lasession1`
    FOREIGN KEY (`lasession_idlasession`)
    REFERENCES `intranetv5`.`lasession` (`idlasession`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lasession_has_leconge_leconge1`
    FOREIGN KEY (`leconge_idleconge`)
    REFERENCES `intranetv5`.`leconge` (`idleconge`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lasession_has_leconge_leconge1_idx` ON `intranetv5`.`lasession_has_leconge` (`leconge_idleconge` ASC);

CREATE INDEX `fk_lasession_has_leconge_lasession1_idx` ON `intranetv5`.`lasession_has_leconge` (`lasession_idlasession` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lesstats`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lesstats` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lesstats` (
  `idlesstats` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `linscription_idlinscription` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idlesstats`),
  CONSTRAINT `fk_lesstats_linscription1`
    FOREIGN KEY (`linscription_idlinscription`)
    REFERENCES `intranetv5`.`linscription` (`idlinscription`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lesstats_linscription1_idx` ON `intranetv5`.`lesstats` (`linscription_idlinscription` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lapresence`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lapresence` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lapresence` (
  `idlapresence` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lesstats_idlesstats` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idlapresence`),
  CONSTRAINT `fk_lapresence_lesstats1`
    FOREIGN KEY (`lesstats_idlesstats`)
    REFERENCES `intranetv5`.`lesstats` (`idlesstats`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lapresence_lesstats1_idx` ON `intranetv5`.`lapresence` (`lesstats_idlesstats` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`laprogression`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`laprogression` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`laprogression` (
  `idlaprogression` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `linscription_idlinscription` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idlaprogression`),
  CONSTRAINT `fk_laprogression_linscription1`
    FOREIGN KEY (`linscription_idlinscription`)
    REFERENCES `intranetv5`.`linscription` (`idlinscription`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_laprogression_linscription1_idx` ON `intranetv5`.`laprogression` (`linscription_idlinscription` ASC);


-- -----------------------------------------------------
-- Table `intranetv5`.`lesuivi`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`lesuivi` ;

CREATE TABLE IF NOT EXISTS `intranetv5`.`lesuivi` (
  `idlesuivi` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ladate` DATE NOT NULL,
  `ponctualite` VARCHAR(250) NOT NULL,
  `evolution` VARCHAR(250) NOT NULL,
  `testti` VARCHAR(250) NOT NULL,
  `attitude` VARCHAR(250) NOT NULL,
  `laprogression_idlaprogression` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idlesuivi`),
  CONSTRAINT `fk_lesuivi_laprogression1`
    FOREIGN KEY (`laprogression_idlaprogression`)
    REFERENCES `intranetv5`.`laprogression` (`idlaprogression`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_lesuivi_laprogression1_idx` ON `intranetv5`.`lesuivi` (`laprogression_idlaprogression` ASC);

USE `intranetv5` ;

-- -----------------------------------------------------
-- Placeholder table for view `intranetv5`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `intranetv5`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `intranetv5`.`view1`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `intranetv5`.`view1`;
DROP VIEW IF EXISTS `intranetv5`.`view1` ;
USE `intranetv5`;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
