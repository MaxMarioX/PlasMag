<?php
//text_ascii_pl.php - sprawdza czy nie podano znaków potencjalnie niebezpiecznych (wersja z polskimi znakami)

function TextAsciiPL($TextField)
{
	$TextStatus = false;
	
	if((preg_match("/^[a-zA-Z0-9\ę\ó\ą\ś\ł\ż\ź\ć\ń\Ę\Ó\Ą\Ś\Ł\Ż\Ź\Ć\Ń\ ]+$/",$TextField)) == 1)
		$TextStatus = true;
	
	return $TextStatus;
}
?>
