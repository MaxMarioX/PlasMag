<?php
/*
change_password.php - panel do zmiana hasła użytkownika
*/

$ShowPanelChangeLogin = ' 
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Zmiana hasła dostępu</p>
								<hr style="color: blue;">';
						
$ShowPanelChangeLogin .= '						
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Aktualne hasło:</span></br>
									<input type="password" name="Field-old-password" id="Field-old-password"/></br>
									<span class="ActionBoxData">Nowe hasło:</span></br>
									<input type="password" name="Field-new-password" id="Field-new-password"/></br>
									<span class="ActionBoxData">Powtórz nowe hasło:</span></br>
									<input type="password" name="Field-new-password-2" id="Field-new-password-2"/></br>
									<input type="button" name="ButtonPasswordChange" id="ButtonPasswordChange" value="Zatwierdź"/>
								</div>
							</div>
						</div>
						';
?>