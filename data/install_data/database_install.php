<?php
//database_install.php - istalacja systemu

session_start();

//Polecenie sql tworzące bazę danych z kodowaniem utf8
$CreateDatabase = "CREATE DATABASE ".$_SESSION['database_name']." CHARACTER SET utf8 COLLATE utf8_polish_ci ;";

//Szyfrowanie hasła
$_uSecurityPass = password_hash($_SESSION['sysPassword'], PASSWORD_DEFAULT);

//Polecenie sql dodające nowego użytkownika(administratora) do bazy danych
$userAdmin = "Admin";
$AddNewUser = "INSERT INTO pracownicy set imie='".$userAdmin."', nazwisko='".$userAdmin."';";

//Polecenie sql dodające nowe konto użytkownika(administratora) do bazy danych
$AddNewAccount = "INSERT INTO konta set login='".$_SESSION['sysUser']."', haslo='".$_uSecurityPass."', aktywny=1, uprawnienia=1, id_pracownik=1;";

//Polecenia sql tworzące strukturę w bazie danych
require_once('database_structure/table_pracownicy.php');
require_once('database_structure/table_konta.php');
require_once('database_structure/table_klienci.php');
require_once('database_structure/table_miasta.php');
require_once('database_structure/table_adresy.php');
require_once('database_structure/table_kontakty.php');
require_once('database_structure/table_produkty.php');
require_once('database_structure/table_wydania.php');


//Dane do pliku konfiguracyjnego database_connect.php
$Config_file = "<?php\n\$host = '".$_SESSION['uHost']."';\n\$db_user = '".$_SESSION['uUser']."';\n\$db_password = '".$_SESSION['uPassword']."';\n\$db_name = '".$_SESSION['database_name']."';\n?>";
					
//Nawiązanie połączenia z serwerem bazodanowym na prawach administratora
$ConnectToAdminAccount = mysqli_connect($_SESSION['admHost'],$_SESSION['admUser'],$_SESSION['admPassword']);

//Jeżeli połączenie powiodło się...
if($ConnectToAdminAccount){
	//Utwórz bazę danych, następnie...
	if(mysqli_query($ConnectToAdminAccount,$CreateDatabase)){
		//Zaznaczenie bazy
		mysqli_select_db($ConnectToAdminAccount,$_SESSION['database_name']);
			//Utworzenie tabeli pracownicy
			if(mysqli_query($ConnectToAdminAccount,$CreateTable_pracownicy))
			{
				//Dodawanie użytkownika do bazy danych
				if(!(mysqli_query($ConnectToAdminAccount,$AddNewUser)))
				{
					echo "Błąd: ".mysqli_error($ConnectToAdminAccount);	
				}
			}else{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}
			//Utworzenie tabeli konta
			if(mysqli_query($ConnectToAdminAccount,$CreateTable_konta))
			{
				//Dodawanie nowego konta do bazy danych
				if(!(mysqli_query($ConnectToAdminAccount,$AddNewAccount)))
				{
					echo "Błąd: ".mysqli_error($ConnectToAdminAccount);	
				}
			}else{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}		
			//Utworzenie tabeli klienci
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_klienci)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}
			//Utworzenie tabeli miasta
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_miasta)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}			
			//Utworzenie tabeli adresy
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_adresy)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}			
			//Utworzenie tabeli kontakty
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_kontakty)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}	
			//Utworzenie tabeli produkty
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_produkty)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}
			//Utworzenie tabeli wydania
			if(!(mysqli_query($ConnectToAdminAccount,$CreateTable_wydania)))
			{
				echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
			}
			//Utworzenie pliku konfiguracyjnego			
			if($ConfigFile = fopen("../database_connect/data_connect.php","w")){
				fputs($ConfigFile,$Config_file);
				fclose($ConfigFile);
			}else{
				echo "Błąd: Nie można utworzyć pliku konfiguracyjnego";
			}
			//Wysłanie komunikatu sukcesu
			echo "#success";
			//Wyczyszczenie pamięci serwera dla danej sesji
			session_unset();
	}else{
	 echo "Błąd: ".mysqli_error($ConnectToAdminAccount);
	}
	mysqli_close($ConnectToAdminAccount);
}else{
	echo "Błąd:".mysqli_error($ConnectToAdminAccount);
}

?>