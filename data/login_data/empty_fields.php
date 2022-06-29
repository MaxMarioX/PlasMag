<?php
/*
empty_fields.php zawiera fukcję sprawdzjącą czy pola w formularzu logowania
są wypełnione danymi.
*/
function CheckFields($fieldA,$fieldB)
{
	$status = true;
	
	if((empty($fieldA)) || (empty($fieldB)))
		$status = false;
	
	return $status;
}
?>