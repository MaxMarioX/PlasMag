<?php
//part_2.php - pozyskanie danych logowania do konta z ograniczonymi uprawnieniami

//Rozpoczęcie sesji
session_start();

//Dołączenie pliku z komunikatami błędów
require_once('messages/m_part_2.php');

//Funkcja sprawdza czy można nawiązać połączenie z użytkownikiem
require_once('database_test/database_test_2.php');

//Funkcja z testami poprawności wpisanych danych dla nazwy bazy danych
require_once('data_test/data_test_2.php');

//Funkcja weryfikująca wpisane znaki
require_once('text_control/text_lenght.php');
require_once('text_control/text_ascii.php');

//get-data-1.php - plik pobierający dane na potrzeby instalacji
$_uHost = $_POST['nhost'];
$_uUser = $_POST['nuser'];
$_uPassword = $_POST['npassword'];
$_uDatabase = $_POST['ndatabase'];

//Wywołanie funkcji sprawdzającej czy istnieje dany użytkownik w systemie
$urFinal = ConnectToDatabase($_uHost, $_uUser, $_uPassword);

if($urFinal == "0"){
	//Wywołanie funkcji sprawdzającej poprawność nazwy
	$fFinal = CheckDataField($_uDatabase);
	
	if($fFinal == "1"){
	
		//Wywołanie funkcji weryfikującej wpisane znaki
		if(!($TextVerify = TextLenght($_uDatabase, 10, "MAX")))
			exit($ErrorMessages[0]);
		if(!($TextVerify = TextLenght($_uDatabase, 3, "MIN")))
			exit($ErrorMessages[1]);
		//Wywołanie funkcji weryfikującej wpisane znaki pod względem użytych znaków
		if(!($TextVerify = TextAscii($_uDatabase)))
			exit($ErrorMessages[2]);
		exit("success");
	}else{
		exit($ErrorMessages[3]);
	}
}
if($urFinal == "1")
	exit($ErrorMessages[3]);

if($urFinal == "2")
	exit($ErrorMessages[4]);
?>