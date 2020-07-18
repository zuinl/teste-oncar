CREATE DATABASE IF NOT EXISTS teste_oncar;

CREATE TABLE IF NOT EXISTS `teste_oncar`.`veiculos` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `veiculo` VARCHAR(50) NOT NULL , 
    `marca` VARCHAR(30) NOT NULL , 
    `ano` INT(4) NOT NULL , 
    `descricao` TEXT NOT NULL , 
    `vendido` INT(1) NOT NULL , 
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `updated` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`));