<?php
//show_user_data.php - plik prezentujący dane użytkownika

require_once('data/database_connect/data_connect.php');

$AddNewProduct = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Dodawanie nowego produktu</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Nazwa produktu:</span></br>
									<input type="text" name="Product-name" id="Product-name"/></br></br>
									<span class="ActionBoxData">Jednostka miary:</span></br>
									<input type="text" name="Product-jm" id="Product-jm"/></br></br>
									<input type="button" name="ButtonNewProduct" id="ButtonNewProduct" value="Zatwierdź"/>
								</div>
							</div>
						</div>
				';
?>