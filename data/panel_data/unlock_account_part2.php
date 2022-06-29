<?php
/*
start_account_now.php - odblokowanie konta użytkownika
*/

require_once('data/database_connect/data_connect.php');

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	if($UpdateStatus = mysqli_query($MyConnect,"UPDATE konta SET aktywny=1 WHERE login='".$uLogin."';"))
	{
		$Result = "Użytkownik o loginie ".$uLogin." został odblokowany!";
	}else{
		$Result = "Błąd: Nie udało się odblokować użytkownika!";
	}
  $MyConnect->close();
}
else{
	$Result = "Błąd: Nie udało się nawiązać połączenia z bazą danych!";
}

?>