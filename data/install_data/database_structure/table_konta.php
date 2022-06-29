<?php

$CreateTable_konta = "
					CREATE TABLE `konta` (
					  `id_konto` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `login` VARCHAR(10) NOT NULL UNIQUE,
					  `haslo` VARCHAR(255) NOT NULL,
					  `aktywny` TINYINT(4) NOT NULL,
					  `uprawnienia` TINYINT(4) NOT NULL,
					  `id_pracownik` INT(11) NOT NULL,
					  PRIMARY KEY (`id_konto`),
					  FOREIGN KEY (id_pracownik) REFERENCES pracownicy(id_pracownik))
					ENGINE = InnoDB;
					"
					;
?>