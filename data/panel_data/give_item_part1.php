<?php

require_once('data/database_connect/data_connect.php');

$_CustomerId = "";
$_CustomerNIP = "";
$_CustomerREGON = "";
$_CustomerName = "";

$ShowCustomerData = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Wydanie towaru z magazynu - wybór klienta</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="Customers">
									    <tr>
											<th style="width: 2em;"></th>
											<th style="width: 5em;">ID</th>
											<th style="width: 30em;">FIRMA</th>
											<th style="width: 10em;">NIP</th>
											<th style="width: 10em;">REGON</th>
										</tr>
				';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM klienci ORDER BY nazwa;");
	
			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						$_CustomerId = $DataRow['id_klient'];
						$CustomerNIP = $DataRow['nip'];
						$CustomerREGON = $DataRow['regon'];
						$CustomerName = $DataRow['nazwa'];
						
						$ShowCustomerData .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
											<td><input type="radio" name="CustomerItRadioB" value="'.$_CustomerId.'"></td>
											<td>'.$_CustomerId.'</td>
											<td>'.$CustomerName.'</td>
											<td>'.$CustomerNIP.'</td>
											<td>'.$CustomerREGON.'</td>
										</tr>
											';					

					   }
			}
			else{
			}	
$MyConnect->close();
}
else{

}

$ShowCustomerData .= '
									</table>
								</div>
								<input style="width: 100%; margin-top: 30px;" type="text" name="CustomersFilter" id="CustomersFilter" onkeyup="FilterData(\'CustomersFilter\',\'Customers\',2)" placeholder="Proszę podać nazwę firmy"/>
								<input type="button" name="ButtonThisCustomer" id="ButtonThisCustomer" value="Wybierz klienta"/>
							</div>
				';				
?>


