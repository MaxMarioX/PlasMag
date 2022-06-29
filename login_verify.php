<?php
/*
login_verify.php - plik zawiera mechanizm logowania
*/

//Uruchomienie sesji
session_start();

//Dołączanie pliku z konfiguracją połączenia z bazą danych
require_once('data/database_connect/data_connect.php');

//Dołączanie pliku z komunikatami błędów
require_once('data/login_data/messages.php');

//Dołączanie pliku z funkcją sprawdzania pól
require_once('data/login_data/empty_fields.php');

//Dołączanie pliku z funkcją sprawdzania poprawności danych logowania
require_once('data/login_data/data_control.php');

//Dołączanie pliku z funkcją zabezpieczania przed sql injection
require_once('data/sql_security/sql_injection.php');

//Funkcja sprawdzająca poprawność danych uwierzytelniających
function CheckUserNow($_uLogin,$_uPassword,$_host,$_db_user,$_db_password,$_db_name) 
{
	$_fStatusError = 0;
	
	//Sprawdzenie czy zostały wypełnione pola: login i password
	if(CheckFields($_uLogin,$_uPassword))
	{
		//Nawiązywanie połączenia z bazą danych
		@$MyConnect = mysqli_connect($_host,$_db_user,$_db_password,$_db_name);
		
		//Sprawdzenie czy udało się nawiązać połączenie
		if($MyConnect)
		{
			//Sprawdzenie czy login istnieje w bazie danych
			$ConnectStatus = mysqli_query($MyConnect,sprintf("SELECT * FROM konta WHERE login='%s'", mysqli_real_escape_string($MyConnect,$_uLogin)));

			//Sprawdzenie ile krotek zwróciło zapytanie (zawsze zwróci 1)
			if(mysqli_num_rows($ConnectStatus))  
			{ 
					    //Pobranie zawartości tablicy
					    $DataRow = mysqli_fetch_array($ConnectStatus);
						
						if($DataRow['aktywny'] == 1)
						{
						//Sprawdzenie czy użytkownik podał poprawne hasło
							if(CheckLoginData($_uPassword,$DataRow['haslo']))
							{
								//Jeżeli jest poprawne, fakt ten zostaje odnotowany w pamięci serwera
								$_SESSION['UserIsLogin'] = true;
								$_SESSION['UserPrivileges'] = $DataRow['uprawnienia'];
								$_SESSION['UserLogin'] = $DataRow['login'];
								$_SESSION['UserID'] = $DataRow['id_pracownik'];
							}
							else
								$_fStatusError = 2;
						}
						else
							$_fStatusError = 3;
				//Zamknięcie połączenia
				$MyConnect->close();
			}
			else{
				$_fStatusError = 2;
			}			
		}
		else{
			$_fStatusError = 1;
		}

	}else{
		$_fStatusError = 4;
	}
	
	return $_fStatusError;
}

//Pobranie loginu i hasła i zapisanie tych danych w zmiennych
$uLogin = $_POST['login'];
$uPassword = $_POST['password'];

//Sprawdzenie znaków
sql_injection($uLogin);

if(!($_cError = CheckUserNow($uLogin,$uPassword,$host,$db_user,$db_password,$db_name)) == 0)
{
	if($_cError == 1) 
		exit($ErrorMessages[1]);
	if($_cError == 2) 
		exit($ErrorMessages[2]);
	if($_cError == 3) 
		exit($ErrorMessages[3]);
	if($_cError == 4) 
		exit($ErrorMessages[4]);
}
else{
	exit("#UserLoginSuccess");
}
?>
