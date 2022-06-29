<?php

require_once('data/database_connect/data_connect.php');

$_ProductId = "";
$_ProductName = "";

$ShowProductsData = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Zmiana danych produktu</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="Products">
									    <tr>
											<th style="width: 2em;"></th>
											<th style="width: 5em;">ID</th>
											<th style="width: 30em;">Nazwa produktu</th>
										</tr>
				';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT * FROM produkty ORDER BY nazwa;");
	
			if(mysqli_num_rows($ConnectStatus))  
			{ 
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
						$_ProductId = $DataRow['id_produkt'];
						$_ProductName = $DataRow['nazwa'];
						
						$ShowProductsData .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
											<td><input type="radio" name="ProductRadioB" value="'.$_ProductId.'"></td>
											<td>'.$_ProductId.'</td>
											<td>'.$_ProductName.'</td>
										</tr>
											';					

					   }
			}
			else{
			}	
$MyConnect->close();
}
else{

}

$ShowProductsData .= '
									</table>
								</div>
								<input style="width: 100%; margin-top: 30px;" type="text" name="ProductsFilter" id="ProductsFilter" onkeyup="FilterData(\'ProductsFilter\',\'Products\',2)" placeholder="Proszę podać nazwę produktu"/>
								<input type="button" name="ButtonProdData" id="ButtonProdData" value="Zmień dane"/>
							</div>
				';				
?>


