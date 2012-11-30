<?php
//require '/var/www/ampush/live/includes/config.php';

ini_set('default_socket_timeout', 60);
ini_set('soap.wsdl_cache_enabled', '0');

$fileName = '/Applications/MAMP/htdocs/AmpushEdu/scripts/hits/bing/81369336.zip';
processzip($fileName);

function processzip($zipfile) {
    //global $ampush_mysql;

    $zip = zip_open($zipfile);
    while ($zip_entry = zip_read($zip)) {
        $zip_file = zip_entry_name($zip_entry);
        $fp = fopen('php://memory','rw');
        fwrite($fp,zip_entry_read($zip_entry,zip_entry_filesize($zip_entry)));
        rewind($fp);
        while (($data = fgetcsv($fp,1000)) !== false) {
            // print_r($data);
            // "AccountName","AccountNumber","Clicks","GregorianDate","Hour","Spend"
            if (in_array('AccountName',$data) && !isset($header)) {
                $header = $data;
                continue;
            }
            else if (!isset($header)) {
                continue;
            }
            if (preg_match('/\d+\/\d+\/\d+/',$data[array_search('GregorianDate',$header)])) {
                $date = date('Y-m-d',strtotime($data[array_search('GregorianDate',$header)]));
                $datetime = $date.' '.str_pad($data[array_search('Hour',$header)],2,'0',STR_PAD_LEFT).':00:00';
                $cost_arr[$datetime][$data[array_search('AdDistribution',$header)]]['Spend'] += $data[array_search('Spend',$header)];
                $cost_arr[$datetime][$data[array_search('AdDistribution',$header)]]['Clicks'] += $data[array_search('Clicks',$header)];
                $total += $data[array_search('Spend',$header)];
            }
        }
    }
    if (isset($cost_arr) && !empty($cost_arr)) {
        foreach ($cost_arr as $datetime=>$v) {
            if ($v['Search'] > 0 ) {
                //$sql = 'INSERT INTO hits SET source=\'Bing\', date=\''.$datetime.'\', adcost='.$v['Search']['Spend'].', clicks='.$v['Search']['Clicks'].' ON DUPLICATE KEY UPDATE adcost=VALUES(adcost), clicks=VALUES(clicks)';
                //echo $sql."\n";
               // $ampush_mysql->query($sql);
                echo $v['Search']['Spend'] . "\n";
                echo $v['Search']['Clicks']. "\n";


            }
            if ($v['Content'] > 0) {
               // $sql = 'INSERT INTO hits SET source=\'BingContent\', date=\''.$datetime.'\', adcost='.$v['Content']['Spend'].', clicks='.$v['Content']['Clicks'].' ON DUPLICATE KEY UPDATE adcost=VALUES(adcost), clicks=VALUES(clicks)';
                //echo $sql."\n";
               // $ampush_mysql->query($sql);
            }
        }
       // touch('/var/www/ampush/scripts/hits/bing/updated.txt');
    }
}

// Definition for the class that is used by the Reporting service.
class AccountPerformanceReportRequest
{
    public $Format;
    public $Language;
    public $ReportName;
    public $ReturnOnlyCompleteData;
    public $Aggregation;
    public $Columns;
    public $Filter;
    public $Scope;
    public $Time;
}

