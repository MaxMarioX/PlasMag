<?php
//show_user_data.php - plik prezentujący dane użytkownika

require_once('data/database_connect/data_connect.php');

$EditProduct = '
						<div class="ActionBox" id="ActionBox">
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Zmiana danych produktu</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyOp1Sc1">
									<span class="ActionBoxData">Nazwa produktu:</span></br>
				';
						//Nawiązywanie połączenia z bazą danych
						if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
						{
							$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM produkty WHERE id_produkt='".$ProductId."';");

									if(mysqli_num_rows($ConnectStatus))  
									{ 
											   while($DataRow = mysqli_fetch_array($ConnectStatus))  
											   {
												$_SESSION['ProductId'] = $_POST['IdProduct'];
												$ProductName = $DataRow['nazwa'];
												$_SESSION['ProductHowMany'] = $DataRow['ilosc'];
												$ProductJM = $DataRow['miara'];												
												
$EditProduct .= '								<input type="text" name="Product-name" id="Product-name" value="'.$ProductName.'"/></br></br>
												<span class="ActionBoxData">Jednostka miary:</span></br>
												<input type="text" name="Product-jm" id="Product-jm" value="'.$ProductJM.'"/></br></br>
				';
											   }
									}
									else{
									}
						$MyConnect->close();
						}
						else{

						}				
$EditProduct .= '						

										<input type="button" name="ButtonEditProduct" id="ButtonEditProduct" value="Zatwierdź"/>
								</div>
							</div>
						</div>
				';
?>