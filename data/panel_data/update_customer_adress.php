<?php

require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii_pl.php');
require_once('data/sql_security/city_code_control.php');
require_once('data/sql_security/street_number_control.php');
require_once('data/panel_data/messages/update_user_adress.php');

if(!((empty($pdataUserCity)) || (empty($pdataUserCityCode)) || (empty($pdataUserStreet)) || (empty($pdataUserStreetNr))))
{
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
	if(!($TextVerify = TextLenght($pdataUserCity, 30, "MAX"))){
		$Result = $ErrorMessages[0];
		return 1;
	}
	
	if(!($TextVerify = TextLenght($pdataUserCity, 3, "MIN"))){
		$Result = $ErrorMessages[11];
		return 1;
	}
	
	if(!($TextVerify = TestCityCode($pdataUserCityCode))){
		$Result = $ErrorMessages[1];
		return 1;
	}
	if(!(empty($pdataUserProvince))){
		if(!($TextVerify = TextLenght($pdataUserProvince, 20, "MAX"))){
			$Result = $ErrorMessages[19];
			return 1;
		}
		if(!($TextVerify = TextLenght($pdataUserProvince, 3, "MIN"))){
			$Result = $ErrorMessages[24];
			return 1;
		}
	}
	if(!($TextVerify = TextLenght($pdataUserStreet, 50, "MAX"))){
		$Result = $ErrorMessages[4];
		return 1;
	}
	if(!($TextVerify = TextLenght($pdataUserStreet, 3, "MIN"))){
		$Result = $ErrorMessages[13];
		return 1;
	}
	if(!(empty($pdataUserStreetNr))){
		if(!($TextVerify = TextLenght($pdataUserStreetNr, 3, "MAX"))){
			$Result = $ErrorMessages[5];
			return 1;
		}
	}
	if(!(empty($pdataUserStreetFlat))){
		if(!($TextVerify = TextLenght($pdataUserStreetFlat, 3, "MAX"))){
			$Result = $ErrorMessages[20];
			return 1;
		}
	}	
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
	if(!($TextVerify = TextAsciiPL($pdataUserCity))){
		$Result = $ErrorMessages[14];
		return 1;
	}
	if(!($TextVerify = TestCityCode($pdataUserCityCode))){
		$Result = $ErrorMessages[1];
		return 1;
	}
	if(!(empty($pdataUserProvince))){
		if(!($TextVerify = TextAsciiPL($pdataUserProvince))){
			$Result = $ErrorMessages[21];
			return 1;
		}
	}
	if(!($TextVerify = TextAsciiPL($pdataUserStreet))){
		$Result = $ErrorMessages[16];
		return 1;
	}
	if(!(empty($pdataUserStreetNr))){
		if(!($TextVerify = TestStreetNumber($pdataUserStreetNr))){
			$Result = $ErrorMessages[22];
			return 1;
		}
	}
	if(!(empty($pdataUserStreetFlat))){
		if(!($TextVerify = TestStreetNumber($pdataUserStreetFlat))){
			$Result = $ErrorMessages[23];
			return 1;
		}
	}
}
else{
	$Result = $ErrorMessages[17];
	return 1;
}

$_id_city;

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$QueryStatus = mysqli_query($MyConnect,"SELECT * FROM miasta WHERE miasto='".$pdataUserCity."';");
	
	if(mysqli_num_rows($QueryStatus))  
	{ 
			   while($DataRow = mysqli_fetch_array($QueryStatus))  
			   {
				   $_id_city = $DataRow['id_miasto'];
			   }
	}else{
		if((mysqli_query($MyConnect,"INSERT INTO miasta SET miasto='".$pdataUserCity."';")) == NULL)
		{
			$Result = "Błąd: Podane miasto nie istnieje w bazie i nie udało się zaktualizować bazy!";
			return 1;
		}
		$QueryStatus = mysqli_query($MyConnect,"SELECT * FROM miasta WHERE miasto='".$pdataUserCity."';");
		
		if(mysqli_num_rows($QueryStatus))  
		{ 
				   while($DataRow = mysqli_fetch_array($QueryStatus))  
				   {
					   $_id_city = $DataRow['id_miasto'];
				   }
		}		
	}		
	
	$QueryStatus = mysqli_query($MyConnect,"SELECT * FROM adresy WHERE id_klient='".$_Id."';");	
	
	if(mysqli_num_rows($QueryStatus)){
		if($UpdateStatus = mysqli_query($MyConnect,"UPDATE adresy SET kod_pocztowy='".$pdataUserCityCode."', powiat='".$pdataUserProvince."', ulica='".$pdataUserStreet."', nr_domu='".$pdataUserStreetNr."', nr_lokalu='".$pdataUserStreetFlat."', id_miasto='".$_id_city."' WHERE id_klient='".$_Id."';"))
		{
			$Result = "Dane zaktualizowano pomyślnie!";
		}else{
			$Result = "Błąd: Dane nie zostały zaktualizowane!";
		}
	}else{
		if((mysqli_query($MyConnect,"INSERT INTO adresy SET kod_pocztowy='".$pdataUserCityCode."', powiat='".$pdataUserProvince."', ulica='".$pdataUserStreet."', nr_domu='".$pdataUserStreetNr."', nr_lokalu='".$pdataUserStreetFlat."', id_miasto='".$_id_city."', id_klient='".$_Id."';")) != NULL)
		{
			$Result = "Dane zaktualizowano pomyślnie!";
		}else{
			$Result = "Błąd: Dane nie zostały zaktualizowane!";
		}
	}
  $MyConnect->close();
}
else{
	$Result = "Błąd: Dane nie zostały zaktualizowane!";
}

?>