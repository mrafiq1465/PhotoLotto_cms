<?php
//require '/var/www/ampush/live/includes/config.php';

ini_set('default_socket_timeout', 60);
ini_set('soap.wsdl_cache_enabled', '0');

try {
    $account_id = '963862';
    $URI = 'https://adcenterapi.microsoft.com/api/advertiser/v7/';
    // $URI = 'https://sandboxapi.adcenter.microsoft.com/Api/Advertiser/v7/';
    $xmlns = 'https://adcenter.microsoft.com/v7';
    $report_proxy = $URI.'Reporting/ReportingService.svc?wsdl';

    $action = 'SubmitGenerateReport';

    // sandbox
    // $username = 'API_Ampush_Med_SB';
    // $password = 'SB4567';
    // $developer_token = 'Q1W4JP50Q';

    $username = 'API_Ampush_Med';
    $password = 'abi123!@#';
    $developer_token = '6S53S9186S1H';

    $application_token = '';

    $header_app_token = new SoapHeader($xmlns, 'ApplicationToken', $application_token, false);
    $header_dev_token = new SoapHeader($xmlns, 'DeveloperToken', $developer_token, false);
    $header_username = new SoapHeader($xmlns, 'UserName', $username, false);
    $header_password = new SoapHeader($xmlns, 'Password', $password, false);

    $input_headers = array($header_app_token, $header_dev_token, $header_username, $header_password);

    $opts = array('trace'=>true);
    $client = new SOAPClient($report_proxy, $opts);

    $start = date('N') == '5' && date('G') == '6' ? strtotime('-7 days') : strtotime('-3 days');
    $end = strtotime('today');
    $request = new AccountPerformanceReportRequest();
    $request->Aggregation='Hourly';
    $request->Format='Csv';
    $request->Language='English';
    $request->ReturnOnlyCompleteData=false;

    $request->Time=array('CustomDateRangeStart'=>array('Day'=>date('d',$start),'Month'=>date('m',$start),'Year'=>date('Y',$start)),'CustomDateRangeEnd'=>array('Day'=>date('d',$end),'Month'=>date('m',$end),'Year'=>date('Y',$end)));

    $request->Columns=array('AccountName',
        'AccountNumber',
        'Clicks',
        'AdDistribution',
        'TimePeriod',
        'Spend');

    $request->Scope=array('AccountIds'=>null);

    $soapstruct = new SoapVar($request,
        SOAP_ENC_OBJECT,
        "AccountPerformanceReportRequest",
        $xmlns);

    $params=array('ReportRequest'=>$soapstruct);

    $result = $client->__soapCall($action,array($action.'Request' =>
    $params), null, $input_headers, $output_headers);
    /*
         print "$action succeeded with Tracking ID "
              . $output_headers['TrackingId']
              . ".\n";
    */

    $reportRequestId=$result->ReportRequestId;

    // printf("ReportRequestId: %d\n", $reportRequestId);

    // Poll to get the status of the report until it is complete.
    $waitMinutes = 1;
    $maxWaitMinutes = 10;
    $elapsedMinutes = 0;
    $action = "PollGenerateReport";
    $params=array('ReportRequestId'=>$reportRequestId);

    while ($elapsedMinutes < $maxWaitMinutes)
    {

        // Wait the specified number of minutes before you poll.
        /*
          printf("Waiting another %d minutes.\n",
                 $waitMinutes);
          printf("Total wait-time so far is %d minutes.\n",
                 $elapsedMinutes);
        */
        sleep($waitMinutes * 60);
        $elapsedMinutes += $waitMinutes;

        $result = $client->__soapCall($action,array($action.'Request' =>
        $params), null, $input_headers, $output_headers);
        /*
               print "$action succeeded with Tracking ID "
                    . $output_headers['TrackingId']
                    . ".\n";
        */
        $reportStatus=$result->ReportRequestStatus->Status;
        //printf("ReportStatus: %s\n", $reportStatus);

        if ($reportStatus == 'Success')
        {
            $downloadURL=$result->ReportRequestStatus->ReportDownloadUrl;

            $fileName = '/Applications/MAMP/htdocs/AmpushEdu/scripts/hits/bing/'.$reportRequestId.'.zip';

            $handleIn = fopen($downloadURL,"r");

            $handleOut = fopen($fileName, "w");

            while (!feof($handleIn))
            {
                $content = fread($handleIn, 8192);
                fwrite($handleOut,$content);
            }

            fclose($handleIn);
            fclose($handleOut);
            printf("Report file is ".$fileName.".\n");

            // Parse it and update database
            processzip($fileName);
            break;
        }
        else
        {
            if ($reportStatus == 'Pending')
            {
                // The report is not yet ready.
                continue;
            }
            else
            {
                // An error occurred.
                //  printf("Error occurred in %s\n", $action);
                break;
            }
        }
    }
}
catch (Exception $e)
{
    //print "$action failed.\n";

    if (isset($e->detail->ApiFaultDetail))
    {
        /*
        print "ApiFaultDetail exception encountered\n";
        print "Tracking ID: " .
            $e->detail->ApiFaultDetail->TrackingId . "\n";
        */

        // Process any operation errors.
        if (isset(
        $e->detail->ApiFaultDetail->OperationErrors->OperationError
        ))
        {
            if (is_array(
                $e->detail->ApiFaultDetail->OperationErrors->OperationError
            ))
            {
                // An array of operation errors has been returned.
                $obj = $e->detail->ApiFaultDetail->OperationErrors->OperationError;
            }
            else
            {
                // A single operation error has been returned.
                $obj = $e->detail->ApiFaultDetail->OperationErrors;
            }
            foreach ($obj as $operationError)
            {
                /*
                  print "Operation error encountered:\n";
                  print "\tMessage: ". $operationError->Message . "\n";
                  print "\tDetails: ". $operationError->Details . "\n";
                  print "\tErrorCode: ". $operationError->ErrorCode . "\n";
                  print "\tCode: ". $operationError->Code . "\n";
                */
            }
        }

        // Process any batch errors.
        if (isset(
        $e->detail->ApiFaultDetail->BatchErrors->BatchError
        ))
        {
            if (is_array(
                $e->detail->ApiFaultDetail->BatchErrors->BatchError
            ))
            {
                // An array of batch errors has been returned.
                $obj = $e->detail->ApiFaultDetail->BatchErrors->BatchError;
            }
            else
            {
                // A single batch error has been returned.
                $obj = $e->detail->ApiFaultDetail->BatchErrors;
            }
            foreach ($obj as $batchError)
            {
                /*
                  print "Batch error encountered for array index " . $batchError->Index . ".\n";
                  print "\tMessage: ". $batchError->Message . "\n";
                  print "\tDetails: ". $batchError->Details . "\n";
                  print "\tErrorCode: ". $batchError->ErrorCode . "\n";
                  print "\tCode: ". $batchError->Code . "\n";
                */
            }
        }
    }

    if (isset($e->detail->AdApiFaultDetail))
    {
        /*
        print "AdApiFaultDetail exception encountered\n";
        print "Tracking ID: " .
            $e->detail->AdApiFaultDetail->TrackingId . "\n";
        */

        // Process any operation errors.
        if (isset(
        $e->detail->AdApiFaultDetail->Errors
        ))
        {
            if (is_array(
                $e->detail->AdApiFaultDetail->Errors
            ))
            {
                // An array of errors has been returned.
                $obj = $e->detail->AdApiFaultDetail->Errors;
            }
            else
            {
                // A single error has been returned.
                $obj = $e->detail->AdApiFaultDetail->Errors;
            }
            foreach ($obj as $Error)
            {
                /*
                  print "Error encountered:\n";
                  print "\tMessage: ". $Error->Message . "\n";
                  print "\tDetail: ". $Error->Detail . "\n";
                  print "\tErrorCode: ". $Error->ErrorCode . "\n";
                  print "\tCode: ". $Error->Code . "\n";
                */
            }
        }

    }

    // Display the fault code and the fault string.
    //print $e->faultcode . " " . $e->faultstring . ".\n";

    // Display the Output for the last request.
    //print "Last SOAP request:\n";
    //print $client->__getLastRequest() . "\n";
}

function processzip($zipfile) {
    global $ampush_mysql;
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
            if ($v['Search'] > 0) {
                $sql = 'INSERT INTO hits SET source=\'Bing\', date=\''.$datetime.'\', adcost='.$v['Search']['Spend'].', clicks='.$v['Search']['Clicks'].' ON DUPLICATE KEY UPDATE adcost=VALUES(adcost), clicks=VALUES(clicks)';
                echo $sql."\n";
               // $ampush_mysql->query($sql);
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

