<?php
	$host = 'localhost';
	$table = 'promos';
	$file = 'aami_';
	$csv_output = '';
	if ($_SERVER['HTTP_HOST']=="pixta.dev") {
		$user = 'root';
		$pass = 'rootuser';
		$db = 'pixta';
	} else {
		$user = 'root';
		$pass = 'flydigital2013';
		$db = 'pixta';
	}

$link = mysql_connect($host, $user, $pass) or die("Can not connect." . mysql_error());
mysql_select_db($db) or die("Can not connect.");

$result = mysql_query("SHOW COLUMNS FROM ".$table."");
$i = 0;
if (mysql_num_rows($result) > 0) {
while ($row = mysql_fetch_assoc($result)) {
//$csv_output .= $row['Field'].", ";
$i++;
}
}
    $csv_output.="id".", ";
    $csv_output.="dateadded".", ";
    $csv_output.="name".", ";
    $csv_output.="surname".", ";
    $csv_output.="email".", ";
    $csv_output.="post_code".", ";
    $csv_output.="mobile_number".", ";
    $csv_output.="terms_cond".", ";
    $csv_output.="insurance_type".", ";
    $csv_output.="renewal_mont".", ";
    $csv_output.="planning_holiday".", ";
    $csv_output.="apply_for_comp".", ";
    $csv_output.="vote".", ";
    $csv_output.="mac_address".", ";
    $csv_output.="derby_day".", ";
    $csv_output.="staff_id".", ";
    $csv_output.="email_sms_send".", ";
    $csv_output.="sent_email_address".", ";
    $csv_output .= "\n";

$values = mysql_query("SELECT * from promos");
while ($rowr = mysql_fetch_row($values)) {
for ($j=0;$j<19;$j++) {
$csv_output .= $rowr[$j].", ";
}
$csv_output .= "\n";
}

$filename = $file."_".date("Y-m-d_H-i",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;
?>