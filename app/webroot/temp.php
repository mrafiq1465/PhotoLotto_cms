<?php
$con = mysql_connect("syds21-n2bsql.hosting-services.net.au", "redbaron_joom289", "3nPr9688eS") or die(mysql_error());
mysql_select_db("redbaron_joom289", $con) or die(mysql_error());

$sql = "SELECT title, metadata from whs_content WHERE catid=8";

$flights = mysql_query($sql);

$flight_array = array();
if($flights && mysql_num_rows($flights) > 0) {

    while(list( $title,$metadata ) = mysql_fetch_row($flights)) {
        $flight_array['title'] = $title;
        $flight_array['metadata'] = $metadata;
    }

}

var_dump($flight_array);

