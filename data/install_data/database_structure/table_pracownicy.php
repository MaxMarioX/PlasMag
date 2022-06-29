<?php

$CreateTable_pracownicy = "
					CREATE TABLE `pracownicy` (
					  `id_pracownik` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `imie` VARCHAR(10) NOT NULL,
					  `nazwisko` VARCHAR(15) NOT NULL,
					  `notatka` TINYTEXT NULL,
					  PRIMARY KEY (`id_pracownik`))	
					ENGINE = InnoDB;
					"
					;
?>