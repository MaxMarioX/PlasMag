<?php

$CreateTable_miasta = "
					CREATE TABLE `miasta` (
					  `id_miasto` INT(11) NOT NULL AUTO_INCREMENT UNIQUE,
					  `miasto` VARCHAR(30) NOT NULL,
					  PRIMARY KEY (`id_miasto`)
					) ENGINE = InnoDB;
					"
					;
?>