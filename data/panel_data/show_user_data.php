<?php
//show_user_data.php - plik prezentujący dane użytkownika

require_once('data/database_connect/data_connect.php');

$dataUserName = "";
$dataUserSurname = "";
$dataUserNote = "";


//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM pracownicy WHERE id_pracownik='".$_Id."';");

			if(mysqli_num_rows($ConnectStatus))  
			{
				$DataRow = mysqli_fetch_array($ConnectStatus);
		
				$dataUserName = $DataRow['imie'];
				$dataUserSurname = $DataRow['nazwisko'];
				$dataUserNote = $DataRow['notatka'];
			}
			else{
				
			}

	$MyConnect->close();
}
else{

}

$ShowUserData = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Dane konta '.$_User.'</p>
								<hr style="color: blue;">
				';
				
$ShowUserData .= '
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
										<span class="ActionBoxData">*Imię:</span></br>
										<input type="text" name="user-name" id="user-name" value="'.$dataUserName.'"/></br>
										<span class="ActionBoxData">*Nazwisko:</span></br>
										<input type="text" name="user-surname" id="user-surname" value = "'.$dataUserSurname.'"/></br>
										<span class="ActionBoxData">Notatka:</span></br>
										<input type="text" name="user-note" id="user-note" value="'.$dataUserNote.'"/></br>
										<input type="button" name="ButtonUpdate" id="ButtonUpdate" value="Zaktualizuj"/>
								</div>
							</div>
						</div>
				';
?>