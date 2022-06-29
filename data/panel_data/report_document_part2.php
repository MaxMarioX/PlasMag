<?php

require_once('data/database_connect/data_connect.php');
require_once('data/sql_security/date_control.php');
require_once('data/sql_security/date_control_2.php');

//Sprawdzanie czy wprowadzone daty są we właściwym formacie rrrr-mm-dd
if(($cStatus = TestDate($_DataStart)) == false){
	$Result = "#ERROR_DATA_START";
	return 1;
}

if(($cStatus = TestDate($_DataStop)) == false){
	$Result = "#ERROR_DATA_STOP";
	return 1;
}

//Sprawdzanie czy data początkowa nie jest większa od daty końcowej
if(($cStatus = TestDate_2($_DataStart,$_DataStop)) == false){
	$Result = "#ERROR_DATA";
	return 1;
}

$ShowReport = '
	<div class="ActionBoxTitle">
		<p style="text-align: center;">Raporty</p>
		<hr style="color: blue;">
	</div>
	<div class="ReportActionBoxBodyCD">
		<div class="report-document">
			<div class="title">
				<h1>Raport wydań magazynowych</h1>
				<h3>Dotyczy od '.$_DataStart.' do '.$_DataStop.'</h3>
			</div>
			<div class="items">
				<table class="items-table">
					<tr>
						<th class="lp">Lp</th>
						<th class="numer_wz">Numer WZ</th>
						<th class="firma">Firma</th>
						<th class="date_wz">Data wystawienia</th>
						<th class="employee_wz">Wystawił</th>
					</tr>
			';
				//Nawiązywanie połączenia z bazą danych
				if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
				{
					//$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM wydania GROUP By numer;");
					$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM wydania WHERE data >= '".$_DataStart."' AND data <= '".$_DataStop."' GROUP BY numer;");
					
							if(mysqli_num_rows($ConnectStatus))  
							{
								$Lp = 1;
									   while($DataRow = mysqli_fetch_array($ConnectStatus))  
									   {
										$WzNumber = $DataRow['numer'];
										$WzData = $DataRow['data'];
										$WzIdEmployee = $DataRow['id_pracownik'];
										$WzIdCustomer = $DataRow['id_klient'];
																
											$ConnectStatus2 = mysqli_query($MyConnect,"SELECT id_pracownik, imie, nazwisko FROM pracownicy;");
										
											if(mysqli_num_rows($ConnectStatus))  
											{							
												$DataRow2 = mysqli_fetch_array($ConnectStatus2);
												$EmployeeData = $DataRow2['imie'];
												$EmployeeData .= ' '.$DataRow2['nazwisko'];
												
											}

											$ConnectStatus3 = mysqli_query($MyConnect,"SELECT id_klient, nazwa FROM klienci WHERE id_klient='".$WzIdCustomer."';");
										
											if(mysqli_num_rows($ConnectStatus))  
											{							
												$DataRow3 = mysqli_fetch_array($ConnectStatus3);
												$CustomerData = $DataRow3['nazwa'];								
											}
											
										$ShowReport .= '
													    <tr class="items-textdata">
															<td>'.$Lp.'</td>
															<td>WZ nr '.$WzNumber.'</td>
															<td>'.$CustomerData.'</td>
															<td>'.$WzData.'</td>											
															<td>'.$EmployeeData.'</td>
														</tr>
															';					
											$Lp = $Lp + 1;
									   }
							}
							else{
							}	
				$MyConnect->close();
				}
				else{

				}	
			
$ShowReport .= '
				</table>
			</div>
		</div>
				';
	$Result = $ShowReport;
?>