-- -----------------------------------------------------
-- Schema sys_cecapfv
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sys_cecapfv` DEFAULT CHARACTER SET utf8 ;
USE `sys_cecapfv` ;

-- -----------------------------------------------------
-- Table `sys_cecapfv`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`person_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`person_types` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`centers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`centers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`schedules`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`schedules` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turno` INT NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`persons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`persons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(100) NOT NULL,
  `lastName` VARCHAR(100) NULL,
  `phone` VARCHAR(15) NULL,
  `birthdate` DATE NULL,
  `dni` VARCHAR(15) NULL,
  `parent` INT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `person_type_id` INT NOT NULL,
  `school` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_persons_person_types_idx` (`person_type_id` ASC),
  CONSTRAINT `fk_persons_person_types`
    FOREIGN KEY (`person_type_id`)
    REFERENCES `sys_cecapfv`.`person_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`classrooms`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`classrooms` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `schedule_id` INT NOT NULL,
  `course_id` INT NOT NULL,
  `center_id` INT NOT NULL,
  `person_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_classes_schedules1_idx` (`schedule_id` ASC),
  INDEX `fk_classes_courses1_idx` (`course_id` ASC),
  INDEX `fk_classes_centers1_idx` (`center_id` ASC),
  INDEX `fk_classes_persons1_idx` (`person_id` ASC),
  CONSTRAINT `fk_classes_schedules1`
    FOREIGN KEY (`schedule_id`)
    REFERENCES `sys_cecapfv`.`schedules` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_courses1`
    FOREIGN KEY (`course_id`)
    REFERENCES `sys_cecapfv`.`courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_centers1`
    FOREIGN KEY (`center_id`)
    REFERENCES `sys_cecapfv`.`centers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_persons1`
    FOREIGN KEY (`person_id`)
    REFERENCES `sys_cecapfv`.`persons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`schools`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`schools` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(150) NOT NULL,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `description_UNIQUE` (`description` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`person_classroom`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`person_classroom` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `person_id` INT NOT NULL,
  `classroom_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_person_class_persons1_idx` (`person_id` ASC),
  INDEX `fk_person_class_classes1_idx` (`classroom_id` ASC),
  CONSTRAINT `fk_person_class_persons1`
    FOREIGN KEY (`person_id`)
    REFERENCES `sys_cecapfv`.`persons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_person_class_classes1`
    FOREIGN KEY (`classroom_id`)
    REFERENCES `sys_cecapfv`.`classrooms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sys_cecapfv`.`assistances`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sys_cecapfv`.`assistances` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `attend` CHAR(1) NOT NULL DEFAULT 0,
  `active` TINYINT NULL DEFAULT 1,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  `person_id` INT NOT NULL,
  `classroom_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_assistances_persons1_idx` (`person_id` ASC),
  INDEX `fk_assistances_classes1_idx` (`classroom_id` ASC),
  CONSTRAINT `fk_assistances_persons1`
    FOREIGN KEY (`person_id`)
    REFERENCES `sys_cecapfv`.`persons` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_assistances_classes1`
    FOREIGN KEY (`classroom_id`)
    REFERENCES `sys_cecapfv`.`classrooms` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
