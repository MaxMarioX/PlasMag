<?php

require_once('data/database_connect/data_connect.php');

$_ProductId;
$_ProductName;
$_ProductHm;
$_ProductJm;

$ShowItems = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Przyjęcie towaru na magazyn</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="Items">
									    <tr>
											<th style="width: 5em;">ID</th>
											<th style="width: 30em;">Nazwa towaru</th>
											<th style="width: 3em;">J.M.</th>
											<th style="width: 7em;">Przyjmij</th>
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
						$_ProductJm = $DataRow['miara'];
						
						$ShowItems .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
											<td>'.$_ProductId.'</td>
											<td>'.$_ProductName.'</td>
											<td>'.$_ProductJm.'</td>
											<td><input type="text" name="'.$_ProductName.'" id="Field'.$_ProductId.'" value=""/></td>
											<td><input type="button" name="Btn'.$_ProductName.'" id="Btn'.$_ProductName.'" onclick="UpdateItm(\'Field'.$_ProductId.'\','.$_ProductId.',\''.$_ProductName.'\',\''.$_ProductJm.'\')" value="Przyjmij"/></td>
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

$ShowItems .= '
									</table>
								</div>
								<p style="font-family: Times New Roman; color: #0C0;" id="ProductsStatus">.</p>
								<input style="width: 100%; margin-top: 10px;" type="text" name="ProductsLiFilter" id="ProductsLiFilter" onkeyup="FilterData(\'ProductsLiFilter\',\'Items\',1)" placeholder="Proszę podać nazwę produktu"/>
							</div>
				';				
?>


