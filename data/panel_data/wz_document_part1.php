<?php

require_once('data/database_connect/data_connect.php');

$ShowWZ = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Lista wydań magazynowych</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="WZCustomers">
									    <tr>
											<th style="width: 2em;"></th>
											<th style="width: 3em;">Lp</th>
											<th style="width: 9em;">Numer WZ</th>
											<th style="width: 15em;">Firma</th>
											<th style="width: 10em;">Data wystawienia</th>											
											<th style="width: 10em;">Wystawił</th>
										</tr>
				';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM wydania GROUP By numer;");
	
			if(mysqli_num_rows($ConnectStatus))  
			{
				$Lp = 1;
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						$WzNumber = $DataRow['numer'];
						$WzData = $DataRow['data'];
						$WzIdEmployee = $DataRow['id_pracownik'];
						$WzIdCustomer = $DataRow['id_klient'];
												
							$ConnectStatus2 = mysqli_query($MyConnect,"SELECT id_pracownik, imie, nazwisko FROM pracownicy WHERE id_pracownik='".$WzIdEmployee."';");
						
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
							
						$ShowWZ .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
											<td><input type="radio" name="WZcustomer" value="'.$WzNumber.'"></td>
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

$ShowWZ .= '
									</table>
								</div>
								<input style="width: 100%; margin-top: 30px;" type="text" name="CustomersFilter" id="CustomersFilter" onkeyup="FilterData(\'CustomersFilter\',\'WZCustomers\',3)" placeholder="Proszę podać nazwę firmy"/>
								<input type="button" name="ButtonChoiceWZ" id="ButtonChoiceWZ" value="Wybierz WZ"/>
							</div>
				';				
?>


