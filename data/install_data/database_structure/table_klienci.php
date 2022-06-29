<?php

$CreateTable_klienci = "
					CREATE TABLE `klienci` (
					  `id_klient` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `nip` VARCHAR(10) NOT NULL,
					  `regon` VARCHAR(9) NOT NULL,
					  `nazwa` VARCHAR(50) NOT NULL,
					  PRIMARY KEY (`id_klient`)
					)ENGINE = InnoDB;
					"
					;				
?>