<?php
//add_new_account.php - plik dodający nowe konto

$ShowPanelNewAccount = ' 
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Dodawanie nowego klienta</p>
								<hr style="color: blue;">';
						
$ShowPanelNewAccount .= '						
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Nazwa firmy:</span></br>
									<input type="text" name="Company-name" id="Company-name"/></br>
									<span class="ActionBoxData">NIP:</span></br>
									<input type="text" name="Company-nip" id="Company-nip"/></br>
									<span class="ActionBoxData">REGON:</span></br>
									<input type="text" name="Company-regon" id="Company-regon"/></br>
									<input type="button" name="ButtonAddCustomer" id="ButtonAddCustomer" value="Wprowadź klienta"/>								
								</div>
							</div>
						</div>
						';
?>