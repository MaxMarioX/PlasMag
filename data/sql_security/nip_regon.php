<?php
//nio_regon.php - sprawdza czy numer telefonu jest poprawny
function TestNip($uNipNumber)
{
	$uNipNumberStatus = false;

	if((preg_match("/^([0-9]{10})$/",$uNipNumber)) == 1)
			$uNipNumberStatus = true;
	
	return $uNipNumberStatus;
}

function TestRegon($uRegonNumber)
{
	$uRegonNumberStatus = false;

	if((preg_match("/^([0-9]{9})$/",$uRegonNumber)) == 1)
			$uRegonNumberStatus = true;
	
	return $uRegonNumberStatus;
}
?>