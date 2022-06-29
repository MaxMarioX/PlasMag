<?php

require_once('data/database_connect/data_connect.php');

/*
Aby usunąć produkt z listy, należy wcześniej pobrać z relacji 'wydanie' ilość wydanego towaru aby tą
ilość z powrotem wprowadzić do stanu magazynowego 
*/

//Łączymy się z bazą danych
if($ConnectNow = mysqli_connect($host,$db_user,$db_password,$db_name))
{ 
	$WZValue;
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

	//Usuwamy produkt z relacji wydania
	if((mysqli_query($ConnectNow,"DELETE FROM wydania WHERE numer='".$_SESSION['WZnumber']."' AND pozycja='".$_Lp."' AND id_produkt='".$_IdProduct."';")) != NULL)
	{	
		//Wprowadzamy produkt z powrotem do stanów magazynowych
		if((mysqli_query($ConnectNow,"UPDATE produkty SET ilosc=ilosc+'".$WZValue."' WHERE id_produkt='".$_IdProduct."';")) != NULL)
		{
			$Result = "Usunięto produkt z listy!";
		}else {
			$Result = "Nie udało się przyjąć z powrotem tego produkru na magazyn w ilości: ".$WZValue." ";
		}

	}else {
		$Result = "Nie udało się usunąć tej pozycji z listy!";
	}
	
	$ConnectNow->close();
}
else{
	$Result = "Nie można nawiązać połączenia z bazą danych!";
}

?>


