<?php
//city_code_control.php - sprawdza czy podano prawidłowy kod pocztowy
function TestCityCode($uCityCode)
{
	$CityCodeStatus = false;

	if((preg_match("/^([0-9]{2})\-([0-9]{3})$/",$uCityCode)) == 1)
			$CityCodeStatus = true;
	
	return $CityCodeStatus;
}
?>