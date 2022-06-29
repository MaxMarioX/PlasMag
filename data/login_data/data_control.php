<?php
/*
data_control.php zawiera funkcję sprawdzającą czy użytkownik
podał poprawny login i hasło i czy tym samym może zalogować się.
*/

function CheckLoginData($uPassword,$hPassword)
{
	$Correct = false;

	if(password_verify($uPassword,$hPassword))
		$Correct = true;
	
	return $Correct;
}
?>