<?php

$CreateTable_wydania = "
					CREATE TABLE `wydania` (
					  `numer` INT(11) NOT NULL,
					  `pozycja` INT(11) NOT NULL,
					  `ilosc` INT(11) NOT NULL,					  
					  `data` DATE NOT NULL,
					  `id_pracownik` INT(11) NOT NULL,
					  `id_klient` INT(11) NOT NULL,
					  `id_produkt` INT(11) NOT NULL,
					  FOREIGN KEY (id_pracownik) REFERENCES pracownicy(id_pracownik),
					  FOREIGN KEY (id_klient) REFERENCES klienci(id_klient),
					  FOREIGN KEY (id_produkt) REFERENCES produkty(id_produkt)				  
					) ENGINE = InnoDB;
					"
					;
?>