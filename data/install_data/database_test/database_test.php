<?php

//Funkcja sprawdza czy można nawiązać połączenie z użytkownikiem z uprawnieniami administratora
function ConnectToDatabase($_myHost, $_myUser, $_myPassword){

	$_ConnectStatus;

	if(!((empty($_myHost)) || (empty($_myUser)) || (empty($_myPassword))))
	{
		@$_myConnect = mysqli_connect($_myHost,$_myUser,$_myPassword);
		if($_myConnect)
		{
				//Jeżeli się uda zapisujem te dane w zmiennych globalnych serwera
				$_SESSION['admHost'] = $_myHost;
				$_SESSION['admUser'] = $_myUser;
				$_SESSION['admPassword'] = $_myPassword;
				
				//Zapisujemy sukces
				$_ConnectStatus = 0;
		}
		else{
				//Błąd: Podany użytkownik w systemie nie istnieje.
				$_ConnectStatus = 2;
		}
	}
	else{
		//Błąd: Nie wypełniono wszystkich pól
		$_ConnectStatus = 1;
	}
	
	return $_ConnectStatus;
}

?>