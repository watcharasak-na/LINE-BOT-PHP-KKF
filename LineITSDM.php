<?php
define("LINE_API","https://notify-api.line.me/api/notify");
define("LINE_TOKEN","4yeYxn5rva9Pn9sDQFHPY058LWhSBXRjtgbgWXYvsbm");

function notify_message($message){
	


    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array(
        'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: text/html; charset=UTF-8\r\n"
            		  ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
        )
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
	return $res;
}
$res = notify_message($_GET['message']);

