<?php

require_once('data/database_connect/data_connect.php');


$ShowWZ = '
<div class="ActionBoxTitle">
	<p style="text-align: center;">Dokument wydanie magazynowe</p>
	<hr style="color: blue;">
</div>
<div class="WZActionBoxBodyCD">
<div class="wz-document">
		<div class="business-data">
			<div class="business-a">
				<table class="business-table">
					<tr><th class="p-business">Sprzedawca</th></tr>
					<tr><td>
						<p class="p-business">Firma handlowa PLAS-MAX Krystian Plaskota</p>
						<p class="p-business">96-100 Skierniewice, ul. Jana III Sobieskiego</p>
						<p class="p-business">NIP: 013456789 REGON: 0123456789</p>
						<p class="p-business">Tel: 46-833-33-99</p>
						</td>
					</tr>
				</table>
			</div>
			<div class="business-b">
				<table class="business-table">
					<tr><th class="p-business">Odbiorca</th></tr>
					<tr><td>
					
			';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	//W pierwszej kolejności pobieramy dane firmy, której dotyczy wydanie WZ. Pobieramy id klienta.
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM wydania WHERE numer='".$WzNumber."';");
		
	if(mysqli_num_rows($ConnectStatus))  
	{
		
		$DataRow = mysqli_fetch_array($ConnectStatus);
		$IdCustomer = $DataRow['id_klient'];
		$Id_employee = $DataRow['id_pracownik'];
		
		//Pobieramy dane klienta na podstawie id klienta z relacji klienci.
		$ConnectStatus2 = mysqli_query($MyConnect,"SELECT * FROM klienci WHERE id_klient='".$IdCustomer."';");
		
		if(mysqli_num_rows($ConnectStatus2))  
		{
			$DataRow2 = mysqli_fetch_array($ConnectStatus2);
			$crNIP = $DataRow2['nip'];
			$crREGON = $DataRow2['regon'];
			$crNAME = $DataRow2['nazwa'];
		}

		//Pobieramy dane klienta na podstawie id klienta z relacji adres.
		$ConnectStatus3 = mysqli_query($MyConnect,"SELECT * FROM adresy WHERE id_klient='".$IdCustomer."';");
		
		if(mysqli_num_rows($ConnectStatus3))  
		{
			$DataRow3 = mysqli_fetch_array($ConnectStatus3);
			$crPcode = $DataRow3['kod_pocztowy'];
			$crIdCity = $DataRow3['id_miasto'];
			$crStreet = $DataRow3['ulica'];
			$crHouse = $DataRow3['nr_domu'];
			$crHouse2 = $DataRow3['nr_lokalu'];
		}

		//Pobieramy nazwę miasta na podstawie id miasto z relacji miasta
		$ConnectStatus4 = mysqli_query($MyConnect,"SELECT * FROM miasta WHERE id_miasto='".@$crIdCity."';");
		
		if(mysqli_num_rows($ConnectStatus4))  
		{
			$DataRow4 = mysqli_fetch_array($ConnectStatus4);
			$crCityName = $DataRow4['miasto'];
		}

		//Pobieramy dane klienta na podstawie id klienta z relacji kontakty.
		$ConnectStatus5 = mysqli_query($MyConnect,"SELECT * FROM kontakty WHERE id_klient='".$IdCustomer."';");
		
		if(mysqli_num_rows($ConnectStatus5))  
		{
			$DataRow5 = mysqli_fetch_array($ConnectStatus5);
			$crPhone1 = $DataRow5['telefon_1'];
			$crPhone2 = $DataRow5['telefon_2'];
			$crFax = $DataRow5['fax'];
		}
		
		$ShowWZ .= '
						<p class="p-business">'.@$crNAME.'</p>
						<p class="p-business">'.@$crPcode.' '.@$crCityName.', ul. '.@$crStreet.' '.@$crHouse.'
					';
					
					if(!(empty($crHouse2)))
					{
		$ShowWZ .= ' / '.$crHouse2.'';
					}
					
		$ShowWZ .=	'	
						</p>
						<p class="p-business">NIP: '.@$crNIP.' REGON: '.@$crREGON.'</p>
						<p class="p-business">Tel: '.@$crPhone2.'</p>
						</td>
					</tr>
				</table>
			</div>
		</div>
		';
		
		//Pobieramy datę wystawienia dokumentu WZ
		$WZdate = $DataRow['data'];
		
		$ShowWZ .= '
		<div class="title">
			<h1>Wydanie z magazynu nr '.$WzNumber.'</h1>
			<h3>Data wystawienia '.$WZdate.'</h3>
		</div>
			';
			
		//Wypisujemy towary będące przedmiotem wydania
		$ShowWZ .= '
		<div class="items">
				<table class="items-table">
					<tr>
						<th class="lp">Lp</th>
						<th class="indeks">Nazwa przedmiotu</th>
						<th class="ilosc">Ilość</th>
						<th class="jm">j.m.</th> 
					</tr>
					';
		$ConnectStatus7 = mysqli_query($MyConnect,"SELECT * FROM wydania WHERE numer='".$WzNumber."';");		
		
		$WzLp = 1;
		
		while($DataRow = mysqli_fetch_array($ConnectStatus7))
		{
			$IdItem = $DataRow['id_produkt'];
			$ValueItem = $DataRow['ilosc'];
			
			//Pobieramy nazwę produktu na podstawie id produktu
			$ConnectStatus6 = mysqli_query($MyConnect,"SELECT id_produkt, nazwa, miara FROM produkty WHERE id_produkt='".$IdItem."';");
			
			if(mysqli_num_rows($ConnectStatus6))  
			{
				$DataRow7 = mysqli_fetch_array($ConnectStatus6);
				$crItemName = $DataRow7['nazwa'];
				$crItemJm = $DataRow7['miara'];
			}		
	
			$ShowWZ .= '				
					<tr class="items-textdata"><td>'.$WzLp.'</td><td>'.$crItemName.'</td><td>'.$ValueItem.'</td><td>'.$crItemJm.'</td></tr>
					';
			
			$WzLp = $WzLp + 1;
		}

			$ShowWZ .= '
				</table>
		</div>
		';
		
		//Pobieramy imię i nazwisko pracownika, który wystawił WZ.
		$ConnectStatus8 = mysqli_query($MyConnect,"SELECT id_pracownik, imie, nazwisko FROM pracownicy WHERE id_pracownik='".$Id_employee."';");
		$DataRow8 = mysqli_fetch_array($ConnectStatus8);
		$EmployeeData = $DataRow8['imie'];
		$EmployeeData .= ' '.$DataRow8['nazwisko'];
		
		$ShowWZ .= '
		<div class="signatures">
			<div class="signatures-a">
				<table class="signatures-table">
					<tr><th class="signatures-textdata">Wystawił '.$EmployeeData.'</th></tr>
					<tr class="signatures-tr"><td>Podpis</td>
					</tr>
				</table>
			</div>
			<div class="signatures-b">
				<table class="signatures-table">
					<tr><th class="signatures-textdata">Odebrał</th></tr>
					<tr class="signatures-tr"><td>Podpis</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	</div>
		  ';
			
	}
	
$MyConnect->close();
}
else{

}				
?>


