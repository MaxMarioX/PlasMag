<?php

require_once('data/database_connect/data_connect.php');

$ConnectError = "Nie wprowadzono korekty!";
$ActualValue;
$WZValue;
$NewValue;

if((empty($_Lp)) || (empty($_HowMany)))
{
	$Result = "Nie wprowadzono korekty! Proszę podać ilość!";
	return 1;		
}

if($_HowMany <= 0)
{
	$Result = "Nie wprowadzono korekty! Proszę podać poprawną ilość!";
	return 1;		
}

if((filter_var($_HowMany,FILTER_VALIDATE_INT)) == false)
{
	$Result = "Nie wprowadzono korekty! Proszę podać poprawną ilość!";
	return 1;		
}

//Sprawdzamy czy ilość wydawanego produktu jest większa niż ilość znajdująca się w magazynie

//Łączymy się z bazą danych
if($ConnectNow = mysqli_connect($host,$db_user,$db_password,$db_name))
{  
	//Sprawdzam ile towaru wydano
	if(($Status = mysqli_query($ConnectNow,"SELECT * FROM wydania WHERE numer='".$_SESSION['WZnumber']."' AND pozycja='".$_Lp."';")) != NULL)
	{
		if(mysqli_num_rows($Status))  
		{
			$GetValue = mysqli_fetch_array($Status);
			
				$WZValue = $GetValue['ilosc'];			
		}
		else{
			$Result = "Nie można odczytać rekordu!";
			$ConnectNow->close();
			return 1;
		}
		
	}else {
		$Result = "Operacja została przerwana ponieważ nie można sprawdzić produktu w bazie danych!";
		$ConnectNow->close();
		return 1;
	}
		
	//Przypadek kiedy, chcę($_HowMany) dopisać do WZ ($WZValue) więcej towaru
	if($_HowMany > $WZValue)
	{
		//Obliczam o ile więcej trzeba zdjąć towaru ze stanu
		$Value = $_HowMany - $WZValue;
		
		//W pierwszej kolejności aktualizujemy stan magazynowy, pod warunkiem, że ilość danego produktu jest wystarczająca
		if((mysqli_query($ConnectNow,"UPDATE produkty SET ilosc = IF(ilosc > 0 AND ilosc >= '".$Value."', ilosc-'".$Value."', ilosc) WHERE id_produkt='".$_IdProduct."';")) != NULL)
		{
			if(mysqli_affected_rows($ConnectNow) != 0)
			{
				//Jeżeli udało się, zaktualizować stan magazynowy, rejestrujemy wydanie
				if((mysqli_query($ConnectNow,"UPDATE wydania SET ilosc='".$_HowMany."' WHERE numer='".$_SESSION['WZnumber']."' AND pozycja='".$_Lp."';")) != NULL)			
				{		
					$Result = "Poprawiono ".$_ItemName." na ".$_HowMany." ".$_ItemJM.".";
				}
				else{
					$Result = "Nie udało się zaktualizować wydania!";		
				}
			}else {
				$Result = "NIE MOŻNA wprowadzić korekty dla ".$_ItemName." z powodu niewystarczającej ilości tego produktu na magazynie!";
			}
		}else{
			$Result = "Nie udało się zaktualizować wydania!";
		}
	}
	
	//Przypadek kiedy, chcę($_HowMany) dopisać do WZ ($WZValue) mniej towaru	
	if($_HowMany < $WZValue)
	{
		//Obliczam o ile więcej trzeba dopisać towaru do stanu
		$Value = $WZValue - $_HowMany;

		//W pierwszej kolejności aktualizujemy stan magazynowy, pod warunkiem, że ilość danego produktu jest wystarczająca
		if((mysqli_query($ConnectNow,"UPDATE produkty SET ilosc = ilosc+'".$Value."' WHERE id_produkt='".$_IdProduct."';")) != NULL)
		{
			if(mysqli_affected_rows($ConnectNow) != 0)
			{
				//Jeżeli udało się, zaktualizować stan magazynowy, rejestrujemy wydanie
				if((mysqli_query($ConnectNow,"UPDATE wydania SET ilosc='".$_HowMany."' WHERE numer='".$_SESSION['WZnumber']."' AND pozycja='".$_Lp."';")) != NULL)			
				{		
					$Result = "Poprawiono ".$_ItemName." na ".$_HowMany." ".$_ItemJM.".";
				}
				else{
					$Result = "Nie udało się zaktualizować wydania!";		
				}
			}else {
				$Result = "Nie moża wprowadzić korekty dla ".$_ItemName.".";
			}
		}else{
			$Result = "Nie udało się zaktualizować wydania!";
		}
	}
	
	
	//Przypadek kiedy, $_HowMany = $WZValue	
	if($_HowMany == $WZValue)
		$Result = "Nie moża wprowadzić korekty. Proszę podać wartość większą lub mniejszą od ilości już wydanego towaru!";	
	
	$ConnectNow->close();
}
else{
	$Result = "Operacja została przerwana ponieważ nie można nawiązać połączenia z bazą danych!";
}

?>


