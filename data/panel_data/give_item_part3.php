<?php

require_once('data/database_connect/data_connect.php');

$ConnectError = "Nie udało się wydać towaru!";
$ActualValue;

if(empty($IdItem))
{
	$Result = "Nie wykonano wydania towaru! Proszę wybrać towar!";
	return 1;		
}

if(empty($hm))
{
	$Result = "Nie wykonano wydania towaru! Proszę podać ilość!";
	return 1;		
}

if($hm <= 0)
{
	$Result = "Nie wykonano wydania towaru! Proszę podać poprawną ilość!";
	return 1;		
}

if((filter_var($hm,FILTER_VALIDATE_INT)) == false)
{
	$Result = "Nie wykonano wydania towaru! Proszę podać poprawną ilość!";
	return 1;		
}

/*
Fakt wydania danego towaru odnotowywany jest z następującymi danymi:

numer - numer WZ, do którego przyporządkowane będą wszystkie pola;	$_SESSION['WZnumber'];
pozycja - numer pod którym zapisano towar;							$_SESSION['ItemPosition'];
ilosc - liczba mówiąca ile wydano danego towaru;					$hm;
data - określająca kiedy wydano towar; 								$_SESSION['WZdate'];
id_pracownik - identyfikator pracownika, który wydał towar;			$_SESSION['UserID'];
id_klient - identyfikator klienta, któremu towar wydano; 			$_SESSION['CustomerIdGive']
id_produkt - identyfikator produktu, który był przedmiotem wydania;	$IdItem;
*/


//Łączymy się z bazą danych
if($ConnectNow = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	//W pierwszej kolejności aktualizujemy stany magazynowe. Zdejmujemy ze stanu odpowiednią ilość danego produktu. Oczywiście pod
	//warunkiem, że jest go wystarczająca ilość w magazynie.
	if((mysqli_query($ConnectNow,"UPDATE produkty SET ilosc = IF(ilosc > 0 AND ilosc >= '".$hm."', ilosc-'".$hm."', ilosc) WHERE id_produkt = '".$IdItem."';")) != FALSE)
	{
		if(mysqli_affected_rows($ConnectNow) != 0)
		{
			//Jeżeli uda się zdjąć towar ze stanu, wtedy możemy zarejestrować wydanie
			if((mysqli_query($ConnectNow,"INSERT INTO wydania SET numer='".$_SESSION['WZnumber']."', pozycja='".$_SESSION['ItemPosition']."', ilosc='".$hm."', data='".$_SESSION['WZdate']."', id_pracownik='".$_SESSION['UserID']."', id_klient='".$_SESSION['CustomerIdGive']."', id_produkt='".$IdItem."';")) != NULL)
			{
				$Result = "Wydano ".$NameItem." w ilości ".$hm." ".$JmItem."";
			}else {
				$Result = "Błąd krytyczny! Towar został zdjęty ze stanu ale nie został wydany!";
			}
		}else{
			$Result = "NIE MOŻNA wydać ".$NameItem." z powodu niewystarczającej ilości ".$JmItem." na magazynie!";
		}
	}else {
		$Result = "Nie można zaktualizować stanów magazynowych!";
	}
	$ConnectNow->close();
}
else{
	$Result = "Operacja została przerwana ponieważ nie można nawiązać połączenia z bazą danych!";
	return 1;
}

/*
Zapisujemy kolejny numer następnej pozycji.
*/
$ItemNextPosition = $_SESSION['ItemPosition'];
$ItemNextPosition = $ItemNextPosition + 1;
$_SESSION['ItemPosition'] = $ItemNextPosition;

?>


