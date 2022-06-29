<?php
//data_test_2.php - plik sprawdzający poprawność wpisanej nazy

function CheckDataField($FieldName)
{
$Status = true;

if(empty($FieldName))
	$Status = false;

else
	$_SESSION['database_name'] = $FieldName;

return $Status;

}

?>