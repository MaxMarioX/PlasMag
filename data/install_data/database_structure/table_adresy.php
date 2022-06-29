<?php

$CreateTable_adresy = "
					CREATE TABLE `adresy` (
					  `id_adres` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `kod_pocztowy` VARCHAR(6) NOT NULL,
					  `powiat` VARCHAR(20) NULL,
					  `ulica` VARCHAR(50) NOT NULL,
					  `nr_domu` SMALLINT(6) NOT NULL,
					  `nr_lokalu` SMALLINT(6) NULL,
					  `id_miasto` INT NOT NULL,
					  `id_klient` INT NULL UNIQUE,	
					  PRIMARY KEY (`id_adres`),					  
					  FOREIGN KEY (id_miasto) REFERENCES miasta(id_miasto),
					  FOREIGN KEY (id_klient) REFERENCES klienci(id_klient)
					) ENGINE = InnoDB;
					"
					;
?>