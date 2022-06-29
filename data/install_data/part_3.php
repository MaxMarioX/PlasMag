<?php
//part_3.php - 

//Rozpoczęcie sesji
session_start();

//Dołączenie pliku z komunikatami błędów
require_once('messages/m_part_3.php');

//Funkcja sprawdza czy można nawiązać połączenie z użytkownikiem
require_once('data_test/data_test.php');

//Funkcja weryfikująca wpisane znaki
require_once('text_control/text_lenght.php');
require_once('text_control/text_ascii.php');

//get-data-1.php - plik pobierający dane na potrzeby instalacji
$_unUser = $_POST['sysUser'];
$_unPassword = $_POST['sysPassword'];
$_unPassword2 = $_POST['sysPassword2'];

if(!((empty($_unUser)) || (empty($_unPassword)) || (empty($_unPassword2))))
{
	//Wywołanie funkcji weryfikującej wpisane znaki pod względem długości
	if(!($TextVerify = TextLenght($_unUser, 10, "MAX")))
		exit($ErrorMessages[0]);
	if(!($TextVerify = TextLenght($_unPassword, 20, "MAX")))
		exit($ErrorMessages[1]);
	if(!($TextVerify = TextLenght($_unPassword2, 20, "MAX")))
		exit($ErrorMessages[1]);

	if(!($TextVerify = TextLenght($_unUser, 3, "MIN")))
		exit($ErrorMessages[5]);
	if(!($TextVerify = TextLenght($_unPassword, 6, "MIN")))
		exit($ErrorMessages[6]);
	if(!($TextVerify = TextLenght($_unPassword2, 6, "MIN")))
		exit($ErrorMessages[6]);

	//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
	if(!($TextVerify = TextAscii($_unUser)))
		exit($ErrorMessages[4]);
	
	//Weryfikowanie hasła
	if(($dtFinal = CheckData($_unUser, $_unPassword, $_unPassword2)) == true)
		exit("success");
	else
		exit($ErrorMessages[3]);
}
else{
	exit($ErrorMessages[2]);
}
?>