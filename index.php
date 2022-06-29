<?php
//Rozpoczęcie sesji celem sprawdzenia czy użytkownik jest zalogowany
session_start();

//Sprawdzenie czy wymagana jest instalacja
require_once('setup_control.php');

//Sprawdzenie czywymagana jest instalacja
$InstallRequire;

//Sprawdzenie czy użytkownik jest zalogowany w systemie
$CanIShowPanel = false;

if(isset($_SESSION['UserIsLogin'])){
	if($_SESSION['UserIsLogin'] == true){
		$CanIShowPanel = true;
	}
}

//Wywołanie funkcji sprawdzającej czy wymagana jest instalacja
$InstallRequire = SysInstallControll();


//Rozpoczęcie generowania strony www
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="styles/main.css" type="text/css"/>
<?php
if($InstallRequire)
{
	echo "<link rel=\"stylesheet\" href=\"styles/install.css\" type=\"text/css\"/>";
}
else{
	if(!($CanIShowPanel)){
		echo "<link rel=\"stylesheet\" href=\"styles/login-form.css\" type=\"text/css\"/>\n";
		echo "<link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\">\n";
	}else{
		echo "<link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\">\n";
		echo "<link rel=\"stylesheet\" href=\"styles/panel.css\" type=\"text/css\"/>";
		echo "<link rel=\"stylesheet\" href=\"styles/menu.css\" type=\"text/css\"/>";
		echo "<link rel=\"stylesheet\" href=\"styles/icons.css\" type=\"text/css\"/>";
		echo "<link rel=\"stylesheet\" href=\"styles/wz.css\" type=\"text/css\"/>";
		echo "<link rel=\"stylesheet\" href=\"styles/report.css\" type=\"text/css\"/>";
	}	
}
?>
	<script src="scripts/jquery-library/jquery-3.2.1.js"></script>
</head>

<body>
<div id="MyWindow">
<?php

//Instalacja wymagana
if($InstallRequire)
{
	require_once('setup.php');
}
//Instalacja nie wymagana - kontynuacja wykonywania systemu
else{

	//W przypadku gdy użytkownik nie jest zalogowany wyświetl formularz logowania
	if(!($CanIShowPanel)){
		require_once('data/login_data/login_box.php');
	}
	
	//W przypadku gdy użytkownik jest zalogowany wyświetl panel sterowania
	if($CanIShowPanel){
		require_once('panel.php');
	}
}
?>
</div>
<?php
//Miejsce na wstawianie skryptów

//Nie wymagana instalacja
if(!($InstallRequire))
{
	
	//W przypadku gdy użytkownik nie jest zalogowany	
	if(!($CanIShowPanel)){
		require_once('scripts/js-login/ix-control.js');
	}
	//W przypadku gdy użytkownik jest zalogowany
	else {
		require_once('scripts/js-panel/menu.js');
		require_once('scripts/js-panel/menu_functions.js');
	}
}
//Wymagana instalacja
else{
	require_once('scripts/js-login/install.js');
}

?>
</body>
<!--<a style="text-align: right;" href="https://www.freepik.com/free-vector/abstract-business-blue-circle_1435130.htm" >Designed by Freepik</a>-->
</html>
