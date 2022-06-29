<?php
/*
stop_account_now.php - blokowanie konta użytkownika
*/

require_once('data/database_connect/data_connect.php');

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	if($UpdateStatus = mysqli_query($MyConnect,"UPDATE konta SET aktywny=0 WHERE login='".$uLogin."';"))
	{
		$Result = "Użytkownik o loginie ".$uLogin." został zablokowany!";
	}else{
		$Result = "Błąd: Nie udało się zablokować użytkownika!";
	}
  $MyConnect->close();
}
else{
	$Result = "Błąd: Nie udało się nawiązać połączenia z bazą danych!";
}

?>