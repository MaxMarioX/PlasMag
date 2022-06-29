<?php

require_once('data/database_connect/data_connect.php');

$ConnectError = "Nie udało się przyjąć towaru!";

if((empty($IdItem)) || (empty($HowMany)))
{
	$Result = "Nie wykonano przyjęcia towaru! Proszę podać ilość!";
	return 1;		
}

if($ConnectNow = mysqli_connect($host,$db_user,$db_password,$db_name))
{	
	$name;
	$value;
	$jm;
	
	if(($ConnectStatus = mysqli_query($ConnectNow,"SELECT * FROM produkty WHERE id_produkt='".$IdItem."';")) != NULL)
	{
		while($DataRow = mysqli_fetch_array($ConnectStatus))  
		{
			$name = $DataRow['nazwa'];
			$value = $DataRow['ilosc'];
			$jm = $DataRow['miara'];
		}		
	}else{
		$Result = $ConnectError;
		return 1;
	}
	
	$update_value = $HowMany+$value;
	
	if((mysqli_query($ConnectNow,"UPDATE produkty SET ilosc='".$update_value."' WHERE id_produkt='".$IdItem."';")) != NULL)
	{
		$Result = "Przyjęto ".$name." w ilości ".$HowMany." ".$jm.". Łączna ilość to ".$update_value." ".$jm.".";
	}else{
		$Result = $ConnectError;
	}
	$ConnectNow->close();
}else{
	$Result = $ConnectError;
}

?>


