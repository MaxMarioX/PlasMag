<?php
//add_new_account_new.php - plik dodający nowe konto

//Dołączanie plików z niezbędnymi funkcjami
require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii.php');
require_once('data/sql_security/text_ascii_pl.php');
require_once('data/panel_data/messages/add_new_account.php');

//Funkcja kontrolująca znaki wpisane przez użytkownika
function adFieldsControl($_newLogin, $_newPassword, $_newPassword2) {
		$_fStatusError = 0;
		
	if(!((empty($_newLogin)) || (empty($_newPassword)) || (empty($_newPassword2))))
	{
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
		if(!($TextVerify = TextLenght($_newLogin, 10, "MAX")))
		{
			$_fStatusError = 1;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_newPassword, 15, "MAX")))
		{
			$_fStatusError = 2;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_newPassword2, 15, "MAX")))
		{
			$_fStatusError = 2;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_newLogin, 3, "MIN")))
		{
			$_fStatusError = 3;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_newPassword, 6, "MIN")))
		{
			$_fStatusError = 4;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_newPassword2, 6, "MIN")))
		{
			$_fStatusError = 4;
			return $_fStatusError;
		}
		
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
		if(!($TextVerify = TextAscii($_newLogin)))
			$_fStatusError = 5;
		if(!($TextVerify = TextAscii($_newPassword)))
			$_fStatusError = 6;
		if(!($TextVerify = TextAscii($_newPassword2)))
			$_fStatusError = 6;
	}
	else{
		$_fStatusError = 7;
	}
	
	return $_fStatusError;
}
function adFieldsControl2($pdataUserName,$pdataUserSurname) 
{
	$_fStatusError = 0;

	if(!((empty($pdataUserName)) || (empty($pdataUserSurname))))
	{
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
		if(!($TextVerify = TextLenght($pdataUserName, 10, "MAX"))){
			$_fStatusError = 1;
			return 1;
		}
		if(!($TextVerify = TextLenght($pdataUserSurname, 15, "MAX"))){
			$_fStatusError = 2;
			return 1;
		}
		if(!($TextVerify = TextLenght($pdataUserName, 3, "MIN"))){
			$_fStatusError = 4;
			return 1;
		}
		if(!($TextVerify = TextLenght($pdataUserSurname, 3, "MIN"))){
			$_fStatusError = 5;
			return 1;
		}
			
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
		if(!($TextVerify = TextAsciiPL($pdataUserName))){
			$_fStatusError = 6;
			return 1;
		}
		if(!($TextVerify = TextAsciiPL($pdataUserSurname))){
			$_fStatusError = 7;
			return 1;
		}
	}
	else{
		$_fStatusError = 9;
		return 1;
	}
	
	return $_fStatusError;
}

function adPasswordCompare($_newPassword,$_newPassword2)
{
	$_fStatusError = 0;
	
	if($_newPassword != $_newPassword2)
		$_fStatusError = 1;
	
	return $_fStatusError;
}

function adLoginControl($_uLogin,$_host,$_db_user,$_db_password,$_db_name)
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{
		if($ConnectStatus = mysqli_query($ConnectNow,"SELECT * FROM konta WHERE login='".$_uLogin."';"))
		{
			if(mysqli_num_rows($ConnectStatus))  
			{ 
				$_fStatusError = 1;
			}			
		}
	$ConnectNow->close();
	}
	else{
		$_fStatusError = 2;
	}
		
	return $_fStatusError;	
}

function adAddAccount($_uLogin,$_uPassword,$_uActive,$_uRules,$_host,$_db_user,$_db_password,$_db_name,$_UId) 
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{
		$_uSecurityPass = password_hash($_uPassword, PASSWORD_DEFAULT);
		
		if((mysqli_query($ConnectNow,"INSERT INTO konta SET login='".$_uLogin."', haslo='".$_uSecurityPass."', aktywny='".$_uActive."', uprawnienia='".$_uRules."', id_pracownik='".$_UId."';")) == NULL)
		{
			$_fStatusError = 2;
		}			
	$ConnectNow->close();
	}
	else{
		$_fStatusError = 1;
	}
		
	return $_fStatusError;
}

function adAddUser($pdataUserName,$pdataUserSurname,$_host,$_db_user,$_db_password,$_db_name) 
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{		
		if((mysqli_query($ConnectNow,"INSERT INTO pracownicy SET imie='".$pdataUserName."', nazwisko='".$pdataUserSurname."';")) != NULL)
		{
			$_fStatusError = mysqli_insert_id($ConnectNow);	
		}			
	$ConnectNow->close();
	}
	else{
		$_fStatusError = 1;
	}
		
	return $_fStatusError;
}

if(($_cError = adFieldsControl($NewLogin,$Password,$Password_2)) == 0)
{
	if(($_cError = adFieldsControl2($Name,$Surrname)) == 0)
	{	
		if(($_cError = adPasswordCompare($Password,$Password_2)) == 0)
		{
			if(($_cError = adLoginControl($NewLogin,$host,$db_user,$db_password,$db_name)) == 0)
			{
				$_Id;
				
				if(($_Id = $_cError = adAddUser($Name,$Surrname,$host,$db_user,$db_password,$db_name)) != 0)
				{							
					if(($_cError = adAddAccount($NewLogin,$Password,1,$Rules,$host,$db_user,$db_password,$db_name,$_Id)) == 0)
					{
						$Result = "Konto zostało pomyślnie założone!";
					}
					else {
						if($_cError == 1)
							$Result = $ErrorMessages[10];
						if($_cError == 2) 
							$Result = $ErrorMessages[11];
					}
				}
				else {
					$Result = $ErrorMessages[19];
				}
			}
			else {
				if($_cError == 1)
					$Result = $ErrorMessages[8];
				if($_cError == 2)
					$Result = $ErrorMessages[9];
			}
		}
		else {
			$Result = $ErrorMessages[7];
		}
	}
	else {
		if($_cError == 1) 
			$Result = $ErrorMessages[13];
		if($_cError == 2) 
			$Result = $ErrorMessages[14];
		if($_cError == 3) 
			$Result = $ErrorMessages[15];
		if($_cError == 4) 
			$Result = $ErrorMessages[16];
		if($_cError == 5) 
			$Result = $ErrorMessages[17];
		if($_cError == 6) 
			$Result = $ErrorMessages[18];
		if($_cError == 7) 
			$Result = $ErrorMessages[18];
		if($_cError == 8) 
			$Result = $ErrorMessages[18];	
		if($_cError == 9) 
			$Result = $ErrorMessages[19];		
	}
}
else {
	if($_cError == 1) 
		$Result = $ErrorMessages[0];
	if($_cError == 2) 
		$Result = $ErrorMessages[1];
	if($_cError == 3) 
		$Result = $ErrorMessages[2];
	if($_cError == 4) 
		$Result = $ErrorMessages[3];
	if($_cError == 5) 
		$Result = $ErrorMessages[4];
	if($_cError == 6) 
		$Result = $ErrorMessages[5];
	if($_cError == 7) 
		$Result = $ErrorMessages[12];
}

?>