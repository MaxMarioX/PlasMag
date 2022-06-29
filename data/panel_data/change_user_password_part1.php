<?php
//show_account_password_code.php - plik wyboru konta
require_once('data/database_connect/data_connect.php');

$ShowAccountPsv = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Zmiana hasła dostępu</p>
								<hr style="color: blue;">
				';
				
$ShowAccountPsv .= '
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Proszę wskazać konto, którego hasło ma zostać zmienione:</span></br></br>
									<select name="AccountsList_d" style="width: 70%">
					';
									//Nawiązywanie połączenia z bazą danych
									if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
									{
										$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM konta;");

												if(mysqli_num_rows($ConnectStatus))  
												{ 
														   while($DataRow = mysqli_fetch_array($ConnectStatus))  
														   {
															   $dataUserLogin = $DataRow['login'];
															   $ShowAccountPsv .= '<option value="'.$dataUserLogin.'">'.$dataUserLogin.'</option>';
														   }
												}
												else{
												}
									$MyConnect->close();
									}
									else{

									}									
$ShowAccountPsv .= '									
									</select></br></br>
									<span class="ActionBoxData">Proszę wprowadzić nowe hasło:</span></br>
									<input type="password" name="Field-new-password-p" id="Field-new-password-p"/></br>
									<span class="ActionBoxData">Proszę potwierdzić nowe hasło:</span></br>
									<input type="password" name="Field-new-password-2-p" id="Field-new-password-2-p"/></br>
									<input type="button" name="ButtonNewPsv" id="ButtonNewPsv" value="Wprowadź nowe hasło"/>
								</div>
							</div>
						</div>
					';
?>