<?php


//Dołączanie plików z niezbędnymi funkcjami
require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/text_lenght.php');
require_once('data/sql_security/text_ascii_pl.php');
require_once('data/panel_data/messages/add_new_product.php');

//Funkcja kontrolująca znaki wpisane przez użytkownika
function adFieldsControl($_ProductName,$_ProductJM) {
		$_fStatusError = 0;
		
	if(!(empty($_ProductName)))
	{
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
		if(!($TextVerify = TextLenght($_ProductName, 50, "MAX")))
		{
			$_fStatusError = 1;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_ProductJM, 5, "MAX")))
		{
			$_fStatusError = 5;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_ProductName, 2, "MIN")))
		{
			$_fStatusError = 2;
			return $_fStatusError;
		}
		if(!($TextVerify = TextLenght($_ProductJM, 2, "MIN")))
		{
			$_fStatusError = 6;
			return $_fStatusError;
		}
		
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
		if(!($TextVerify = TextAsciiPL($_ProductName)))
			$_fStatusError = 3;
		if(!($TextVerify = TextAsciiPL($_ProductJM)))
			$_fStatusError = 7;
	}
	else{
		$_fStatusError = 4;
	}
	
	return $_fStatusError;
}

function adUpdateProduct($_ProductId,$_ProductName,$_ProductHM,$_ProductJM,$_host,$_db_user,$_db_password,$_db_name) 
{
	$_fStatusError = 0;
	
	if($ConnectNow = mysqli_connect($_host,$_db_user,$_db_password,$_db_name))
	{	
		if((mysqli_query($ConnectNow,"UPDATE produkty SET nazwa='".$_ProductName."', ilosc='".$_ProductHM."', miara='".$_ProductJM."' WHERE id_produkt='".$_ProductId."';")) == NULL)
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

if(($_cError = adFieldsControl($ProductName,$ProductJM)) == 0)
{
	if(($_cError = adUpdateProduct($ProductId, $ProductName,$ProductHM,$ProductJM,$host,$db_user,$db_password,$db_name)) == 0)
	{
		$Result = "Dane produktu '".$ProductName."' pomyślnie zostały zaktualizowane!";
	}
	else {
		if($_cError == 1)
			$Result = $ErrorMessages[5];
		if($_cError == 2) 
			$Result = $ErrorMessages[6];
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
		$Result = $ErrorMessages[7];
	if($_cError == 6) 
		$Result = $ErrorMessages[8];
	if($_cError == 7) 
		$Result = $ErrorMessages[9];
}

?>