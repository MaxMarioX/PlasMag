<?php
//date_control_2.php - sprawdza czy podano prawidłową datę
function TestDate_2($Date_1, $Date_2)
{
	$DateStatus = true;

	$_Date_1 = new DateTime($Date_1);
	$_Date_2 = new DateTime($Date_2);
	
	if($_Date_1 >= $_Date_2)
		$DateStatus = false;
	
	return $DateStatus;
}
?>