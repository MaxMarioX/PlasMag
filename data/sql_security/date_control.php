<?php
//date_control.php - sprawdza czy podano prawidłową datę
function TestDate($uDate)
{
	$DateStatus = false;

	$Date_day = substr($uDate,8,2);
	$Date_month = substr($uDate,-5,-3);
	$Date_year = substr($uDate,0,-6);	
	
	if((preg_match("/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/",$uDate)) == 1)
		if((checkdate($Date_month,$Date_day,$Date_year)) == 1)
			$DateStatus = true;
	
	return $DateStatus;
}
?>