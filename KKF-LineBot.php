<?php
 
$strAccessToken = "gH3z10t4//X75A2T/23MD6vmWCYq694lYI+jT+IKA9WCdljG5cdDRDnu1o1l8lB9j3XPoJkInTpBaWn9cjUY/ulp0I/v9HCVfnpK/Os4o8dBdVU48Fl4f3lpeIQscTKji/V2PgZ487al+z7QXqHQCwdB04t89/1O/w1cDnyilFU=";

 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
 
if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
}else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันยังไม่มีชื่อนะ";
}else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
}else if($arrJson['events'][0]['message']['text'] == "แผนวันนี้"){
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "OK รอแปป";
}else{
  $arrPostData = array();
  $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
  $arrPostData['messages'][0]['type'] = "text";
  $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
}
 
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$strUrl);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($ch);
curl_close ($ch);

if($arrJson['events'][0]['message']['text'] == "แผนวันนี้") {

  $postData = array(
   'user' => 'admin',
   'pw' => 'admin',
   'submit' => 'Login'
   );

  // Setup cURL
  $ch = curl_init('https://script.google.com/d/1JOAv3B4BFK_iD96wwIjj2E8nKI4OI7pRft3u_Gpb5k4ZPK6aALFEUPg1/edit?usp=drive_web');
  curl_setopt_array($ch, array(
  CURLOPT_POST => TRUE,
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'
 ),
  CURLOPT_POSTFIELDS => json_encode($postData)
));

 // Send the request
   $response = curl_exec($ch);

 var_dump($response);

 // Check for errors
  if($response === FALSE){
  die(curl_error($ch));
  }

   // Decode the response
    $responseData = json_decode($response, TRUE);

// Print the date from the response
 echo $responseData['published'];

}else{
}







 
?>
