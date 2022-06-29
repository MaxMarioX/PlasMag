<?php

require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/sql_injection.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/tel_number_control.php');
require_once('data/sql_security/email_control.php');
require_once('data/panel_data/messages/update_customer_contact.php');

if(!((empty($pdataUserTelKom)) || (empty($pdataUserMail))))
{
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
	if(!($TextVerify = TestTelNumber($pdataUserTelKom, 11, "MAX"))){
		$Result = $ErrorMessages[0];
		return 1;
	}
	if(!(empty($pdataUserTelSta))){
		if(!($TextVerify = TestTelNumber2($pdataUserTelSta, 13, "MAX"))){
			$Result = $ErrorMessages[1];
			return 1;
		}
	}
	if(!(empty($pdataUserFax))){
		if(!($TextVerify = TestTelNumber2($pdataUserFax, 13, "MAX"))){
			$Result = $ErrorMessages[2];
			return 1;
		}
	}
	if(!($TextVerify = TextLenght($pdataUserMail, 50, "MAX"))){
		$Result = $ErrorMessages[3];
		return 1;
	}
		
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
	if(!($TextVerify = TestEmail($pdataUserMail))){
		$Result = $ErrorMessages[4];
		return 1;
	}
}
else{
	$Result = $ErrorMessages[5];
	return 1;
}

//zabezpieczanie przed SqlInction
sql_injection($pdataUserMail);

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$QueryStatus = mysqli_query($MyConnect,"SELECT * FROM kontakty WHERE id_klient='".$_Id."';");	
	
	if(mysqli_num_rows($QueryStatus)){
		if($UpdateStatus = mysqli_query($MyConnect,"UPDATE kontakty SET telefon_1='".$pdataUserTelKom."', telefon_2='".$pdataUserTelSta."', fax='".$pdataUserFax."', email='".$pdataUserMail."' WHERE id_klient='".$_Id."';"))
		{
			$Result = "Dane zaktualizowano pomyślnie!";
		}else{
			$Result = "Błąd: Dane nie zostały zaktualizowane!";
		}
	}else{
		if((mysqli_query($MyConnect,"INSERT INTO kontakty SET telefon_1='".$pdataUserTelKom."', telefon_2='".$pdataUserTelSta."', fax='".$pdataUserFax."', email='".$pdataUserMail."', id_klient='".$_Id."';")) != NULL)
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