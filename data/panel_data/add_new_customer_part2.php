<?php
//add_new_customer_now.php - plik dodający nowego klienta

//Dołączanie plików z niezbędnymi funkcjami
require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii_pl.php');
require_once('data/sql_security/nip_regon.php');
require_once('data/panel_data/messages/add_new_customer.php');

//Funkcja kontrolująca znaki wpisane przez użytkownika
function adFieldsControl($_CustomerName,$_CustomerNip,$_CustomerRegon) {
		$_fStatusError = 0;
		
	if(!((empty($_CustomerName)) || (empty($_CustomerNip)) || (empty($_CustomerRegon))))
	{
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
		if(!($TextVerify = TextLenght($_CustomerName, 50, "MAX")))
		{
			$_fStatusError = 1;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_CustomerName, 3, "MIN")))
		{
			$_fStatusError = 2;
			return $_fStatusError;
		}
		if(!($TextVerify = TestNip($_CustomerNip)))
		{
			$_fStatusError = 3;
			return $_fStatusError;
		}
		if(!($TextVerify = TestRegon($_CustomerRegon)))
		{
			$_fStatusError = 4;
			return $_fStatusError;
		}
		
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
		if(!($TextVerify = TextAsciiPL($_CustomerName)))
			$_fStatusError = 5;
	}
	else{
		$_fStatusError = 6;
	}
	
	return $_fStatusError;
}

function adAddCustomer($_CustomerName,$_CustomerNip,$_CustomerRegon,$_host,$_db_user,$_db_password,$_db_name) 
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{	
		if((mysqli_query($ConnectNow,"INSERT INTO klienci SET nip='".$_CustomerNip."', regon='".$_CustomerRegon."', nazwa='".$_CustomerName."';")) == NULL)
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

function ControlCustomer($_CustomerName,$_CustomerNip,$_CustomerRegon,$_host,$_db_user,$_db_password,$_db_name)
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{
		if($ConnectStatus = mysqli_query($ConnectNow,"SELECT * FROM klienci WHERE nip='".$_CustomerNip."' OR regon='".$_CustomerRegon."' OR nazwa='".$_CustomerName."';"))
		{
			if(mysqli_num_rows($ConnectStatus))  
			{ 
				$_fStatusError = 2;
			}			
		}
	$ConnectNow->close();
	}
	else{
		$_fStatusError = 1;
	}
		
	return $_fStatusError;	
}

if(($_cError = adFieldsControl($CustomerName,$CustomerNip,$CustomerRegon)) == 0)
{
	if(($_cError = ControlCustomer($CustomerName,$CustomerNip,$CustomerRegon,$host,$db_user,$db_password,$db_name)) == 0)
	{
		if(($_cError = adAddCustomer($CustomerName,$CustomerNip,$CustomerRegon,$host,$db_user,$db_password,$db_name)) == 0)
		{
			
			$Result = "Klient ".$CustomerName." został wprowadzony do bazy!";
		}
		else {
			if($_cError == 1)
				$Result = $ErrorMessages[7];
			if($_cError == 2) 
				$Result = $ErrorMessages[8];
		}
	}
	else {
			if($_cError == 1)
				$Result = $ErrorMessages[7];
			if($_cError == 2) 
				$Result = $ErrorMessages[9];		
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
}

?>