<?php

require_once('data/database_connect/data_connect.php');

$ShowItemsWz;

$_ProductId;
$_ProductName;
$_ProductHm;
$_ProductJm;

$ShowItemsWz = '
							<div class="ActionBoxTitle">
								<p style="text-align: center;">Wydanie magazynowe nr '.$_SESSION['WZnumber'].'&nbsp;&nbsp;&nbsp;&nbsp;Data: '.$_SESSION['WZdate'].'</p>
								<hr style="color: blue;">
							</div>
							<div class="ActionBoxBody" id="ActionBoxBody">
								<div class="ActionBoxBodyCD">
									<table id="ItemsWz">
									    <tr>
											<th style="width: 5em;">Lp.</th>
											<th style="width: 30em;">Nazwa towaru</th>
											<th style="width: 5em;">Ilość</th>
											<th style="width: 3em;">J.M.</th>
											<th style="width: 7em;">Korekta</th>
										</tr>
				';

//Nawiązywanie połączenia z bazą danych
if(@$MyConnect = mysqli_connect($host,$db_user,$db_password,$db_name))
{
	$ConnectStatus = mysqli_query($MyConnect,"SELECT numer, pozycja, ilosc, id_produkt FROM wydania WHERE numer='".$_SESSION['WZnumber']."';");
			
			if(mysqli_num_rows($ConnectStatus))  
			{
				$_LpList = 1;
					   while($DataRow = mysqli_fetch_array($ConnectStatus))  
					   {
							$_LpList;
							
							$_WzNumber = $DataRow['numer'];
							$_ItemPosidion = $DataRow['pozycja'];
							$_Value = $DataRow['ilosc'];
							$_IdProduct = $DataRow['id_produkt'];							
							
							$ConnectStatus2 = mysqli_query($MyConnect,"SELECT * FROM produkty WHERE id_produkt='".$_IdProduct."';");
							
										if(mysqli_num_rows($ConnectStatus2))  
										{ 
												   while($DataRow2 = mysqli_fetch_array($ConnectStatus2))  
												   {
													$_ProductName = $DataRow2['nazwa'];
													$_ProductJm = $DataRow2['miara'];
													
													$ShowItemsWz .= '
																	<tr onmouseover="ovStyle(this)" onmouseout="ouStyle(this)">
																		<td>'.$_LpList.'</td>
																		<td>'.$_ProductName.'</td>
																		<td>'.$_Value.'</td>
																		<td>'.$_ProductJm.'</td>
																		<td><input type="text" name="'.$_ProductName.'" id="Field'.$_ItemPosidion.'" value=""/></td>
																		<td><input type="button" name="Btn'.$_ProductName.'" id="Btn'.$_ProductName.'" onclick="CorrItm(\'Field'.$_ItemPosidion.'\','.$_ItemPosidion.','.$_IdProduct.',\''.$_ProductName.'\',\''.$_ProductJm.'\')" value="Popraw"/></td>
																		<td><input type="button" name="BtnDel'.$_ProductName.'" id="BtnDel'.$_ProductName.'" onclick="DelItm('.$_ItemPosidion.','.$_IdProduct.')" value="Usuń"/></td>
																	</tr>
																	';					

												   }
										}
										else{
										}
							$_LpList = $_LpList + 1;					
					   }				   
			
			}else{
			}				
	$MyConnect->close();
}
else{

}

$ShowItemsWz .= '
									</table>
								</div>
								<p style="font-family: Times New Roman; color: #0C0;" id="ProductsStatus">.</p>
								<input style="width: 100%; margin-top: 10px;" type="text" name="ProductsLiFilter" id="ProductsLiFilter" onkeyup="FilterData(\'ProductsLiFilter\',\'ItemsWz\',1)" placeholder="Proszę podać nazwę produktu"/>
								<input type="button" name="EndItemList" id="EndItemList" value="Zakończ"/>
								<input type="button" name="RefreshItemList" id="RefreshItemList" value="Odświerz"/>
								<input type="button" name="BackToItems" id="BackToItems" value="Wróć"/>
							</div>
				';

			
?>


