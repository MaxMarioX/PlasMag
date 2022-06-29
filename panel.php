<?php
/*
panel.php - centrum dowodzenia systemem
*/
@session_start();

//Funkcja sprawdzająca czy dostęp do panelu jest legalny
require_once('data/panel_data/panel_control.php');

if(CheckEnter())
{
	require_once('data/panel_data/panel_scripts.php');
	require_once('data/panel_data/panel_box.php');
	
	if($ScriptsFile = fopen("scripts\js-panel\menu.js","w")){
		fputs($ScriptsFile,$SaveScripts);
		fclose($ScriptsFile);
		echo $ShowPanelBox;
	}else{
		echo "Błąd: Nie można utworzyć pliku skryptowego";
	}
}
else{
	echo '<script type="text/javascript">alert(\'Dostęp do panelu zabroniony!\');</script>';
	exit();
}
/*STARY KOD
if(CheckEnter())
{
	require_once('data/panel_data/panel_scripts.php');
	require_once('data/panel_data/panel_box.php');
}
else{
	echo '<script type="text/javascript">alert(\'Dostęp do panelu zabroniony!\');</script>';
	exit();
}
*/


?>