<?php
//sql_injection.php - funkcja zabezpieczająca przed wstrzykiwaniem kodu sql

function sql_injection(&$myData)
{
	$myData = htmlentities($myData,ENT_QUOTES,"UTF-8");
}


?>