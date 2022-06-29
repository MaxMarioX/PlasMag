<?php

$CreateTable_produkty = "
					CREATE TABLE `produkty` (
					  `id_produkt` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `nazwa` VARCHAR(50) NOT NULL UNIQUE,
					  `ilosc` INT(11) NOT NULL,
					  `miara` VARCHAR(5) NOT NULL,
					  PRIMARY KEY (`id_produkt`)
					) ENGINE = InnoDB;
					"
					;
?>