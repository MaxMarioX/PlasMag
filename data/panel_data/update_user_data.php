<?php

require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/sql_injection.php');
require_once('data/sql_security/text_ascii.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii_pl.php');
require_once('data/sql_security/date_control.php');
require_once('data/sql_security/text_note.php');
require_once('data/panel_data/messages/update_user_data.php');

if(!((empty($pdataUserName)) || (empty($pdataUserSurname))))
{
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
	if(!($TextVerify = TextLenght($pdataUserName, 10, "MAX"))){
		$Result = $ErrorMessages[0];
		return 1;
	}
	if(!($TextVerify = TextLenght($pdataUserSurname, 15, "MAX"))){
		$Result = $ErrorMessages[1];
		return 1;
	}
	if(!($TextVerify = TextLenght($dataUserNote, 150, "MAX"))){
		$Result = $ErrorMessages[3];
		return 1;
	}
	if(!($TextVerify = TextLenght($pdataUserName, 3, "MIN"))){
		$Result = $ErrorMessages[4];
		return 1;
	}
	if(!($TextVerify = TextLenght($pdataUserSurname, 3, "MIN"))){
		$Result = $ErrorMessages[5];
	}
		
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
	if(!($TextVerify = TextAsciiPL($pdataUserName))){
		$Result = $ErrorMessages[6];
		return 1;
	}
	if(!($TextVerify = TextAsciiPL($pdataUserSurname))){
		$Result = $ErrorMessages[6];
		return 1;
	}
	if(!(empty($dataUserNote))){
		if(!($TextVerify = TextNote($dataUserNote))){
			$Result = $ErrorMessages[6];
			return 1;
		}
	}
}
else{
	$Result = $ErrorMessages[7];
	return 1;
}

//zabezpieczanie przed SqlInction
sql_injection($pdataUserName);
sql_injection($pdataUserSurname);
sql_injection($dataUserNote);

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$QueryStatus = mysqli_query($MyConnect,"SELECT * FROM pracownicy WHERE id_pracownik='".$_Id."';");	
	
	if(mysqli_num_rows($QueryStatus)){
		if($UpdateStatus = mysqli_query($MyConnect,"UPDATE pracownicy SET imie='".$pdataUserName."', nazwisko='".$pdataUserSurname."', notatka='".$dataUserNote."' WHERE id_pracownik='".$_Id."';"))
		{
			$Result = "Dane zaktualizowano pomyślnie!";
		}else{
			$Result = "Błąd: Dane nie zostały zaktualizowane!";
		}
	}else{
		if((mysqli_query($MyConnect,"INSERT INTO pracownicy SET imie='".$pdataUserName."', nazwisko='".$pdataUserSurname."', notatka='".$dataUserNote."', id_pracownik='".$_Id."';")) != NULL)
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