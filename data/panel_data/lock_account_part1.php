<?php
/*
stop_account_code.php - panel do blokady konta użytkownika
*/

require_once('data/database_connect/data_connect.php');

$ShowPanelStopAccount = ' 
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Blokowanie konta</p>
								<hr style="color: blue;">';
						
$ShowPanelStopAccount .= '						
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Proszę wskazać konto, która ma zostać zablokowane:</span></br></br>
									<select name="AccountsList" style="width: 70%">';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM konta WHERE aktywny=1;");

			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						   $dataUserLogin = $DataRow['login'];
						   $ShowPanelStopAccount .= '<option value="'.$dataUserLogin.'">'.$dataUserLogin.'</option>';
					   }
			}
			else{
			}
$MyConnect->close();
}
else{

}
									
$ShowPanelStopAccount .= '									
									</select></br></br>
									<input type="button" name="ButtonStopAccount" id="ButtonStopAccount" value="Zablokuj"/>
								</div>
							</div>
						</div>
						';
?>