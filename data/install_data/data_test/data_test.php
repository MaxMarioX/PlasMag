<?php
//Funkcja sprawdza czy pola zostały poprawnie wypełnione
function CheckData($_myUser,$_myPassword, $_myPassword2){
	
	$_ConnectStatus = true;
	
	//Sprawdzenie czy wpisane hasła są takie same
	if($_myPassword == $_myPassword2)
	{
		//Jeżeli się uda zapisujem te dane w zmiennych globalnych serwera
		$_SESSION['sysUser'] = $_myUser;
		$_SESSION['sysPassword'] = $_myPassword;
	}
	else{
		//Błąd: Podane hasła nie są takie same.
		$_ConnectStatus = false;
	}
	
	return $_ConnectStatus;
}
?>