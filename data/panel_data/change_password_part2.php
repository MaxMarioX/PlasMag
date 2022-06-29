<?php
/*
change_password.php - zmiana hasła użytkownika
*/

//Dołączanie plików z niezbędnymi funkcjami
require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii.php');
require_once('data/panel_data/messages/change_password.php');
require_once('data/login_data/data_control.php');

//Funkcja kontrolująca znaki wpisane przez użytkownika
function FieldsControl($_oldPassword, $_newPassword, $_newPassword2) {
	$_fStatusError = 0;
	
	if(!((empty($_oldPassword)) || (empty($_newPassword)) || (empty($_newPassword2))))
	{
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
	if(!($TextVerify = TextLenght($_oldPassword, 20, "MAX")))
		$_fStatusError = 1; 
	if(!($TextVerify = TextLenght($_newPassword, 20, "MAX")))
		$_fStatusError = 1;
	if(!($TextVerify = TextLenght($_newPassword2, 20, "MAX")))
		$_fStatusError = 1;
	
	if($_fStatusError == 1)
		return $_fStatusError;
	
	if(!($TextVerify = TextLenght($_oldPassword, 6, "MIN")))
		$_fStatusError = 9; 
	if(!($TextVerify = TextLenght($_newPassword, 6, "MIN")))
		$_fStatusError = 9;
	if(!($TextVerify = TextLenght($_newPassword2, 6, "MIN")))
		$_fStatusError = 9;

	if($_fStatusError == 9)
		return $_fStatusError;	
	
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
	if(!($TextVerify = TextAscii($_oldPassword)))
		$_fStatusError = 2;
	if(!($TextVerify = TextAscii($_newPassword)))
		$_fStatusError = 2;
	if(!($TextVerify = TextAscii($_newPassword2)))
		$_fStatusError = 2;
	}
	else{
		$_fStatusError = 3;
	}
	
	return $_fStatusError;
}

function PasswordCompare($_newPassword,$_newPassword2)
{
	$_fStatusError = 0;
	
	if($_newPassword != $_newPassword2)
		$_fStatusError = 1;
	
	return $_fStatusError;
}

function PasswordControl($_uLogin,$_oldPassword,$_newPassword2,$_host,$_db_user,$_db_password,$_db_name) 
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{
		if($ConnectStatus = mysqli_query($ConnectNow,sprintf("SELECT * FROM konta WHERE login='%s'", mysqli_real_escape_string($ConnectNow,$_uLogin))))
		{
			if(mysqli_num_rows($ConnectStatus))  
			{ 
				while($DataRow = mysqli_fetch_array($ConnectStatus))  
				{  
					if(CheckLoginData($_oldPassword,$DataRow['haslo']))
					{
						$_uSecurityPass = password_hash($_newPassword2, PASSWORD_DEFAULT);
						
						if(!(mysqli_query($ConnectNow,"UPDATE konta SET haslo='".$_uSecurityPass."' WHERE login='".$_uLogin."';")))
						{
							$_fStatusError = 6;
						}
					}
					else{
						$_fStatusError = 5;
					}
				}
			}			
		}
		else{
			$_fStatusError = 7;
		}
	$ConnectNow->close();
	}
	else{
		$_fStatusError = 8;
	}
		
	return $_fStatusError;
}

$p_oldPassword = $_POST['oldpassword'];
$p_newPassword = $_POST['newpassword'];
$p_newPassword2 = $_POST['newpassword2'];
$p_login = $_User;


if(($_cError = FieldsControl($p_oldPassword,$p_newPassword,$p_newPassword2)) == 0)
{
	if(($_cError = PasswordCompare($p_newPassword,$p_newPassword2)) == 0)
	{
		if(($_cError = PasswordControl($p_login,$p_oldPassword,$p_newPassword2,$host,$db_user,$db_password,$db_name)) == 0)
		{
			$Result = "Hasło zostało zmienione pomyślnie!";
		}
		else {
			if($_cError == 5)
				$Result = $ErrorMessages[5];
			if($_cError == 6) 
				$Result = $ErrorMessages[6];
			if($_cError == 7) 
				$Result = $ErrorMessages[7];
			if($_cError == 8) 
				$Result = $ErrorMessages[8];
		}
	}
	else {
		$Result = $ErrorMessages[4];
	}
}
else {
	if($_cError == 1) 
		$Result = $ErrorMessages[1];
	if($_cError == 2) 
		$Result = $ErrorMessages[2];
	if($_cError == 3) 
		$Result = $ErrorMessages[3];
	if($_cError == 9) 
		$Result = $ErrorMessages[9];
}



?>