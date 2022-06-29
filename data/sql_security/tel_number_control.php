<?php
//tel_number_control.php - sprawdza czy numer telefonu jest poprawny
function TestTelNumber($uTelNumber)
{
	$TelNumberStatus = false;

	if((preg_match("/^([0-9]{3})\-([0-9]{3})\-([0-9]{3})$/",$uTelNumber)) == 1)
			$TelNumberStatus = true;
	
	return $TelNumberStatus;
}

function TestTelNumber2($uTelNumber)
{
	$TelNumberStatus = false;

	if((preg_match("/^([0-9]{2})\-([0-9]{3})\-([0-9]{2})\-([0-9]{2})$/",$uTelNumber)) == 1)
			$TelNumberStatus = true;
	
	return $TelNumberStatus;
}
?>