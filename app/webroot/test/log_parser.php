<?php

error_reporting(1);
ini_set('Display_errors','on');

$inputFile = 'log_23';
//$outputFile = 'out/' . $inputFile . '_parsed.csv';
$outputFile = 'parsed.csv';

$inputFileHandle = fopen($inputFile,'r') or die('Input file not found');
$outputFileHandle = fopen($outputFile,'w') or die('Output file create error');

$header_array = array(
    'Time',
    'Query_time',
    'Lock_time',
    'Rows_sent',
    'Rows_examined',
    'timestamp',
    'Query'
);

fputcsv($outputFileHandle,$header_array);

$fragment = '';
$fragment_flag = 0;

$i=0;
while($line=fgets($inputFileHandle)){
    $i++;
    if($i>1000) break;
    if (strstr($line,'# Time:') || strstr($line,'# User@Host:')) {
        if($fragment != '' && !preg_match('/^# Time:.+$/',$fragment)){
            process_fragment($fragment,$outputFileHandle);
            $fragment = '';
        }
        $fragment .= $line;
    } else {
        $fragment .= $line;
    }
}

function process_fragment($fragment,$outputFileHandle){
    $eol = PHP_EOL;
    $pattern = "/(# Time: (.+)$eol)?# User@Host:.+$eol# Query_time: (.+)  Lock_time: (.+) Rows_sent: (.+)  Rows_examined: (.+){$eol}SET timestamp=(.+);$eol([.\w\W]+);/";
    preg_match($pattern,$fragment,$matches);
    unset($matches[0]);
    unset($matches[1]);
    fputcsv($outputFileHandle,$matches);
}