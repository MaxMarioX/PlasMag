<?php

$CreateTable_kontakty = "
					CREATE TABLE `kontakty` (
					  `id_kontakt` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `telefon_1` VARCHAR(11) NOT NULL,
					  `telefon_2` VARCHAR(12) NULL,
					  `fax` VARCHAR(12) NULL,
					  `email` VARCHAR(50) NOT NULL,
					  `id_klient` INT(11) NULL UNIQUE,
					  PRIMARY KEY (`id_kontakt`),					  
					  FOREIGN KEY (id_klient) REFERENCES klienci(id_klient)
					) ENGINE = InnoDB;
					"
					;
?>