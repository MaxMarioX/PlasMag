<?php
//add_new_account.php - plik dodający nowe konto

$ShowPanelNewAccount = ' 
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Dodawanie nowego konta</p>
								<hr style="color: blue;">';
						
$ShowPanelNewAccount .= '						
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Imię użytkownika:</span></br>
									<input type="text" name="Field-name" id="Field-name"/></br>
									<span class="ActionBoxData">Nazwisko użytkownika:</span></br>
									<input type="text" name="Field-surname" id="Field-surname"/></br>
									<span class="ActionBoxData">Login:</span></br>
									<input type="text" name="Field-login" id="Field-login"/></br>
									<span class="ActionBoxData">Hasło:</span></br>
									<input type="password" name="Field-password" id="Field-password"/></br>
									<span class="ActionBoxData">Powtórz hasło:</span></br>
									<input type="password" name="Field-password-2" id="Field-password-2"/></br>
									<input type="checkbox" name="admin_choice" id="admin_choice" value="administrator">Administrator</br>
									<input type="button" name="ButtonAddAccount" id="ButtonAddAccount" value="Załóż konto"/>
								</div>
							</div>
						</div>
						';
?>