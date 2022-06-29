<?php
/*
start_account_code.php - panel do odblokowania konta użytkownika
*/

require_once('data/database_connect/data_connect.php');

$ShowPanelStopAccount = ' 
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Odblokowanie konta</p>
								<hr style="color: blue;">';
						
$ShowPanelStopAccount .= '						
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Proszę wskazać konto, która ma zostać odblokowane:</span></br></br>
									<select name="AccountsList_b" style="width: 70%">';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM konta WHERE aktywny=0;");

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
									<input type="button" name="ButtonStartAccount" id="ButtonStartAccount" value="Odblokuj"/>
								</div>
							</div>
						</div>
						<script>
						var selectedValue_b = AccountsList_b.value;
						if(selectedValue_b=="")
							document.getElementById("ButtonStartAccount").disabled = true;
						</script>
						';
?>