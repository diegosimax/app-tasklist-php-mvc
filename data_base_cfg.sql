CREATE SCHEMA `db_tasklist` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE `db_tasklist`.`tb_task` (
  `id_task` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(250) NOT NULL,
  `description` VARCHAR(250) NOT NULL,
  `status` VARCHAR(1) NOT NULL, 
  PRIMARY KEY (`id_task`))
COMMENT = 'Tabela que contém as tarefas.';

INSERT INTO `db_tasklist`.`tb_task` (`title`, `description`, `status`) VALUES ('Sexta Futebol', 'Praticar o esporte.', 'C');
