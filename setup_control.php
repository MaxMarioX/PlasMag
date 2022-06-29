<?php
/*
Setup-control.php - sprawdzi czy istnieje plik data_connect.php
Jeżeli tego pliku zabraknie wówczas system przeprowadzi proces instalacji i konfiguracji
*/

function SysInstallControll(){
//Zmienna przechowująca informację czy należy przeprowadzić instalację (domyślnie nie)
$SetSystem = false;


class FileDoesntExistException extends Exception
{
	
}

//Sprawdzenie czy istnieje plik data_connect.php
try{
	if(!($dbFile = @fopen("data/database_connect/data_connect.php",'r')))
	{
		throw new FileDoesntExistException();
	}
	fclose($dbFile);
}
catch(FileDoesntExistException $msg){
	$SetSystem = true;
}

return $SetSystem;
}
?>