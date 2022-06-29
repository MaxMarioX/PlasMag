<?php
//part_1.php - pozyskanie danych logowania do konta administratora

//Rozpoczęcie sesji
session_start();

//Dołączenie pliku z komunikatami błędów
require_once('messages/m_part_1.php');

//Funkcja sprawdza czy można nawiązać połączenie z użytkownikiem
require_once('database_test/database_test.php');

//Funkcja weryfikująca wpisane znaki


//get-data-1.php - plik pobierający dane na potrzeby instalacji
$_Host = $_POST['host'];
$_User = $_POST['user'];
$_Password = $_POST['password'];

//Wywołanie funkcji sprawdzającej czy istnieje dany użytkownik w systemie
$admFinal = ConnectToDatabase($_Host, $_User, $_Password);

if($admFinal == "0"){
	exit("success");
}
if($admFinal == "1")
	exit($ErrorMessages[0]);

if($admFinal == "2")
	exit($ErrorMessages[1]);

?>