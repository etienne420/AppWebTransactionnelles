-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Librairie`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Librairie` (
  `id_librairie` INT NOT NULL,
  `id_utilisateur` INT NULL,
  `id_jeu` INT NULL,
  `date_ajout` DATE NULL,
  PRIMARY KEY (`id_librairie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Utilisateur` (
  `idUtilisateur` INT NOT NULL,
  `nom` VARCHAR(45) NULL,
  `courriel` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  `Librairie_id_librairie` INT NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  INDEX `fk_Utilisateur_Librairie_idx` (`Librairie_id_librairie` ASC) VISIBLE,
  CONSTRAINT `fk_Utilisateur_Librairie`
    FOREIGN KEY (`Librairie_id_librairie`)
    REFERENCES `mydb`.`Librairie` (`id_librairie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Evaluation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Evaluation` (
  `id_evaluation` INT NOT NULL,
  `id_utilisateur` INT NULL,
  `id_jeu` VARCHAR(45) NULL,
  `note` VARCHAR(45) NULL,
  `commentaire` LONGTEXT NULL,
  PRIMARY KEY (`id_evaluation`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Emprunt`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Emprunt` (
  `id_emprunt` INT NOT NULL,
  `id_utilisateur` INT NULL,
  `id_jeu` INT NULL,
  `date_emprunt` DATE NULL,
  `date_retour` DATE NULL,
  PRIMARY KEY (`id_emprunt`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Jeu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Jeu` (
  `id_jeu` INT NOT NULL,
  `titre` VARCHAR(45) NULL,
  `genre` VARCHAR(45) NULL,
  `annee_sortie` YEAR NULL,
  `description` VARCHAR(45) NULL,
  `Librairie_id_librairie` INT NOT NULL,
  `Evaluation_id_evaluation` INT NOT NULL,
  `Emprunt_id_emprunt` INT NOT NULL,
  PRIMARY KEY (`id_jeu`),
  INDEX `fk_Jeu_Librairie1_idx` (`Librairie_id_librairie` ASC) VISIBLE,
  INDEX `fk_Jeu_Evaluation1_idx` (`Evaluation_id_evaluation` ASC) VISIBLE,
  INDEX `fk_Jeu_Emprunt1_idx` (`Emprunt_id_emprunt` ASC) VISIBLE,
  CONSTRAINT `fk_Jeu_Librairie1`
    FOREIGN KEY (`Librairie_id_librairie`)
    REFERENCES `mydb`.`Librairie` (`id_librairie`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jeu_Evaluation1`
    FOREIGN KEY (`Evaluation_id_evaluation`)
    REFERENCES `mydb`.`Evaluation` (`id_evaluation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Jeu_Emprunt1`
    FOREIGN KEY (`Emprunt_id_emprunt`)
    REFERENCES `mydb`.`Emprunt` (`id_emprunt`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
