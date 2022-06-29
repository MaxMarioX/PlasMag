<?php

require_once('data/database_connect/data_connect.php');

$_ProductId;
$_ProductName;
$_ProductHm;
$_ProductJm;

$ShowItems = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Stany magazynowe</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="Items">
									    <tr>
											<th style="width: 5em;">ID</th>
											<th style="width: 30em;">Nazwa towaru</th>
											<th style="width: 5em;">Ilość</th>
											<th style="width: 7em;">J.M.</th>
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
						$_ProductHm = $DataRow['ilosc'];
						$_ProductJm = $DataRow['miara'];
									
											if($_ProductHm < 10)
											{											
						$ShowItems .= '
									    <tr style="background: rgba(236,6,6,.5);" onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
									';
											}
											else if(($_ProductHm >= 10) && ($_ProductHm <= 20)){
						$ShowItems .= '
									    <tr style="background: rgba(255,255,0,.5);" onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
									';																							
											}
											else{
						$ShowItems .= '
									    <tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
									';																							
											}											
						$ShowItems .= '			
											<td>'.$_ProductId.'</td>
											<td>'.$_ProductName.'</td>
											<td>'.$_ProductHm.'</td>
											<td>'.$_ProductJm.'</td>
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
								<input style="width: 100%; margin-top: 30px;" type="text" name="ProductsLiFilter" id="ProductsLiFilter" onkeyup="FilterData(\'ProductsLiFilter\',\'Items\',1)" placeholder="Proszę podać nazwę produktu"/>
							</div>
				';				
?>


