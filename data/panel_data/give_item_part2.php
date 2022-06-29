<?php

require_once('data/database_connect/data_connect.php');

$ShowItemsG;

//Sprawdzamy czy klient został wybrany z listy
if($IdCustomer == "undefined")
{
	$ShowItemsG = "<script>alert(\"Operacja została przerwana ponieważ nie wybrano klienta!\");</script>";
	return 1;
}

/*
Tworzymy numer WZ. Numer WZ będzie wyglądał zgodnie ze wzorem 1/2018. Jedynka oznacza numer zapisany w polu numer.
Będzie to liczba inkrementowana z każdym następnym wydaniem. Liczba 2018 oznacza rok.

W pierwszej kolejności sprawdzamy ostatni największy numer zapisany w polu numer i zapisujemy ten numer w zmiennej
sesyjnej pamięci serwera.
*/

if($ConnectNow = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	if(($Status = mysqli_query($ConnectNow,"SELECT MAX(numer) as numer FROM wydania;")) != NULL)
	{
		if(mysqli_num_rows($Status))  
		{
			$GetLastWzNumber = mysqli_fetch_array($Status);
			
				if($GetLastWzNumber['numer'] == null)
				{
					$_SESSION['WZnumber'] = 0;						
				}else{
					$_SESSION['WZnumber'] = $GetLastWzNumber['numer'];
				}		
		}
		else{
			$Result = "Nie można odczytać rekordu!";
			return 1;
		}
	}
	else{
		$Result = "Nie można wykonać zapytania do bazy danych!";
		return 1;
	}	
	$ConnectNow->close();
}
else{
	$Result = "Nie można nawiązać połączenia z bazą danych!";
}

/*
Tworzymy nowy numer WZ. Jeżeli nie ma jeszcze żadnej Wz-tki, tworzymy numer 1. W przeciwnym razie,
pobieramy wartość z WZnumber, powiększamy ją o jeden i nową wartość, zapisujemy z powrotem do zmiennej sesyjnej.
*/

if($_SESSION['WZnumber'] == 0)
{
	$_SESSION['WZnumber'] = 1;
}
else{
	$LastWzNumer = $_SESSION['WZnumber'];
	$LastWzNumer = $LastWzNumer + 1;
	$_SESSION['WZnumber'] = $LastWzNumer;
}

/*
Zapisujemy datę.
*/
$_SESSION['WZdate'] = date("Y-m-d");

/*
Zapisujemy numer pierwszej pozycji na dokumencie WZ.
*/
$_SESSION['ItemPosition'] = 1;

/*
Wyświetlamy listę towarów.  
*/

$_ProductId;
$_ProductName;
$_ProductHm;
$_ProductJm;

$ShowItemsG = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Wydanie towaru z magazynu</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="Items">
									    <tr>
											<th style="width: 5em;">ID</th>
											<th style="width: 30em;">Nazwa towaru</th>
											<th style="width: 3em;">J.M.</th>
											<th style="width: 7em;">Ilość</th>
										</tr>
				';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM produkty ORDER BY nazwa;");
	
			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						$_ProductId = $DataRow['id_produkt'];
						$_ProductName = $DataRow['nazwa'];
						$_ProductJm = $DataRow['miara'];
						
						$ShowItemsG .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
											<td>'.$_ProductId.'</td>
											<td>'.$_ProductName.'</td>
											<td>'.$_ProductJm.'</td>
											<td><input type="text" name="'.$_ProductName.'" id="Field'.$_ProductId.'" value=""/></td>
											<td><input type="button" name="Btn'.$_ProductName.'" id="Btn'.$_ProductName.'" onclick="GiveItm(\'Field'.$_ProductId.'\','.$_ProductId.',\''.$_ProductName.'\',\''.$_ProductJm.'\')" value="Wydaj"/></td>
										</tr>
											';					

					   }
			}
			else{
			}	
$MyConnect->close();
}
else{
	$Result = "Nie można nawiązać połączenia z bazą danych!";
}

$ShowItemsG .= '
									</table>
								</div>
								<p style="font-family: Times New Roman; color: #0C0;" id="ProductsStatus">.</p>
								<input style="width: 100%; margin-top: 10px;" type="text" name="ProductsLiFilter" id="ProductsLiFilter" onkeyup="FilterData(\'ProductsLiFilter\',\'Items\',1)" placeholder="Proszę podać nazwę produktu"/>
								<input type="button" name="ShowItemList" id="ShowItemList" value="Wydane produkty"/>
							</div>
				';


				
?>


