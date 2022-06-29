<?php
//email_control.php - sprawdza czy adres e-mail poprawny
function TestEmail($uEmail)
{
	$EmailStatus = true;

	if((filter_var($uEmail,FILTER_VALIDATE_EMAIL)) == false)
			$EmailStatus = false;
	
	return $EmailStatus;
}
?>