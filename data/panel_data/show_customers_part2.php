<?php

require_once('data/database_connect/data_connect.php');

$dataName = "";
$dataNIP = "";
$dataREGON = "";

$dataPhone_1 = "";
$dataPhone_2 = "";
$dataFax = "";
$dataEmail = "";

$pdataUserCityCode = "";
$pdataUserProvince = "";
$pdataUserVoivodeship = "";
$pdataUserStreet = "";
$pdataUserStreetNr = "";
$pdataUserStreetFlat = "";
$pdataUserIDcity = "";
$pdataUserCity = "";

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM klienci WHERE id_klient='".$_Id."';");

			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						   $dataName = $DataRow['nazwa'];
						   $dataNIP = $DataRow['nip'];
						   $dataREGON = $DataRow['regon'];
					   }
			}
			else{
			}

	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM kontakty WHERE id_klient='".$_Id."';");

			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						   $dataPhone_1 = $DataRow['telefon_1'];
						   $dataPhone_2 = $DataRow['telefon_2'];
						   $dataFax = $DataRow['fax'];
						   $dataEmail = $DataRow['email'];
					   }
			}
			else{
			}
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM adresy WHERE id_klient='".$_Id."';");

			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						   $pdataUserCityCode = $DataRow['kod_pocztowy'];
						   $pdataUserProvince = $DataRow['powiat'];
						   $pdataUserStreet = $DataRow['ulica'];
						   $pdataUserStreetNr = $DataRow['nr_domu'];
						   $pdataUserStreetFlat = $DataRow['nr_lokalu'];
						   $pdataUserIDcity = $DataRow['id_miasto'];
					   }
			}
			else{
			}
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM miasta WHERE id_miasto='".$pdataUserIDcity."';");

			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
							$pdataUserCity = $DataRow['miasto'];
					   }
			}
			else{
			}
$MyConnect->close();
}
else{

}

if($pdataUserStreetNr == "0")
	$pdataUserStreetNr = "";
if($pdataUserStreetFlat == "0")
	$pdataUserStreetFlat = "";

$ShowCustomerData2 = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Dane klienta</p>
								<hr style="color: blue;">
				';
				
$ShowCustomerData2 .= '
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodySc1">
										<span class="ActionBoxData">*Nazwa:</span></br>
										<input type="text" name="user-name" id="user-name" value="'.$dataName.'"/></br>
										<span class="ActionBoxData">*NIP:</span></br>
										<input type="text" name="user-nip" id="user-nip" value = "'.$dataNIP.'"/></br>
										<span class="ActionBoxData">*REGON:</span></br>
										<input type="text" name="user-regon" id="user-regon" value="'.$dataREGON.'"/></br>
										<input type="button" name="ButtonUpdate2" id="ButtonUpdate2" value="Zaktualizuj"/>
								</div>
								<div class="ActionBoxBodySc2">
										<span class="ActionBoxData">*Miejscowość:</span></br>
										<input type="text" name="user-city" id="user-city" value="'.$pdataUserCity.'"/></br>
										<span class="ActionBoxData">*Kod pocztowy:</span></br>
										<input type="text" name="user-city-code" id="user-city-code" value="'.$pdataUserCityCode.'"/></br>
										<span class="ActionBoxData">Powiat:</span></br>
										<input type="text" name="user-province" id="user-province" value="'.$pdataUserProvince.'"/></br>
										<span class="ActionBoxData">*Ulica:</span></br>
										<input type="text" name="user-street" id="user-street" value="'.$pdataUserStreet.'"/></br>
										<span class="ActionBoxData">*Numer domu:</span></br>
										<input type="text" name="user-street-nr" id="user-street-nr" value="'.$pdataUserStreetNr.'"/></br>
										<span class="ActionBoxData">Numer mieszkania:</span></br>
										<input type="text" name="user-street-flat" id="user-street-flat" value="'.$pdataUserStreetFlat.'"/></br>
										<input type="button" name="BtnUpdateDataAdress2" id="BtnUpdateDataAdress2" value="Zaktualizuj"/>
								</div>
								<div class="ActionBoxBodySc3">
										<span class="ActionBoxData">*Telefon komórkowy:</span></br>
										<input type="text" name="user-tel-kom" id="user-tel-kom" value="'.$dataPhone_1.'"/></br>
										<span class="ActionBoxData">Telefon stacjonarny:</span></br>
										<input type="text" name="user-tel-sta" id="user-tel-sta" value="'.$dataPhone_2.'"/></br>
										<span class="ActionBoxData">Fax:</span></br>
										<input type="text" name="user-fax" id="user-fax" value="'.$dataFax.'"/></br>
										<span class="ActionBoxData">*Adres e-mail:</span></br>
										<input type="text" name="user-mail" id="user-mail" value="'.$dataEmail.'"/></br>
										<input type="button" name="ButtonUpdateDataCon2" id="ButtonUpdateDataCon2" value="Zaktualizuj"/>
								</div>
							</div>
						</div>
				';
?>


