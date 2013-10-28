<?php
function dbConnect(){
    global $con;
    $con = mysql_connect("localhost", "root", "rootuser") or die(    mysql_error());
    mysql_select_db("pixta", $con) or die(mysql_error());
}
function sanitise($string) {
	$returnstring=str_replace("'", "\'", $string);
	$returnstring=str_replace("<", "", $returnstring);
	$returnstring=str_replace(">", "", $returnstring);
	if ($_SERVER['HTTP_HOST']=="localhost") {
		return $returnstring;
	} else {
		return mysql_real_escape_string($returnstring);
		//return $returnstring;
	}
}

function cleanstring($string) {
        $returnstring=str_replace("\\", "'", $string);
	return ($returnstring);
}
?>
