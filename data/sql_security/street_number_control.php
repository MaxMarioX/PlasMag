<?php
//street_number_control.php - sprawdza czy numer ulicy jest poprawny
function TestStreetNumber($uStreetNumber)
{
	$StreetNumberStatus = true;

	if((filter_var($uStreetNumber,FILTER_VALIDATE_INT)) == false)
			$StreetNumberStatus = false;
	
	return $StreetNumberStatus;
}
?>