-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestao` DEFAULT CHARACTER SET utf8 ;
USE `gestao` ;

-- -----------------------------------------------------
-- Table `gestao`.`materia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao`.`materia` (
  `idmateria` INT NOT NULL AUTO_INCREMENT,
  `nome_materia` VARCHAR(100) NULL,
  `professor_materia` VARCHAR(200) NULL,
  `cor_materia` VARCHAR(200) NULL,
  PRIMARY KEY (`idmateria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao`.`tarefa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao`.`tarefa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo_tarefa` VARCHAR(200) NULL,
  `data_tarefa` DATE NULL,
  `tarefa_descricao` VARCHAR(2000) NULL,
  `prioridade_tarefa` INT NULL,
  `idmateria` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tarefa_materia_idx` (`idmateria` ASC),
  CONSTRAINT `fk_tarefa_materia`
    FOREIGN KEY (`idmateria`)
    REFERENCES `gestao`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao`.`trabalho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao`.`trabalho` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_trabalho` DATE NULL,
  `titulo_trabalho` VARCHAR(200) NULL,
  `descricao_trabalho` VARCHAR(2000) NULL,
  `prioridade_trabalho` INT NULL,
  `idmateria` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_trabalho_materia_idx` (`idmateria` ASC),
  CONSTRAINT `fk_trabalho_materia`
    FOREIGN KEY (`idmateria`)
    REFERENCES `gestao`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestao`.`prova`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestao`.`prova` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data_prova` DATE NULL,
  `titulo_prova` VARCHAR(200) NULL,
  `descricao_prova` VARCHAR(2000) NULL,
  `prioridade_prova` INT NULL,
  `idmateria` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_prova_materia_idx` (`idmateria` ASC),
  CONSTRAINT `fk_prova_materia`
    FOREIGN KEY (`idmateria`)
    REFERENCES `gestao`.`materia` (`idmateria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
