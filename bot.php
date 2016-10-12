<?php
//require 'vendor/autoload.php';

$access_token = 'XGwHGXONz/LuYr3OZOVLFKMazoBIOwK/hoZa9SHGaOz6Zqu8aaW+AkRtKc8zs4A5GcYk1qFA0ONzsqU+iqbITU8TupYFIKLek5TJnZyBtmUGc65fGUrjk56JGE1Ay2m87lgfR53jCd5gsWO/G1cESgdB04t89/1O/w1cDnyilFU=';
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:W8B1EissNtwSwyk';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
  // Loop through each event
  foreach ($events['events'] as $event) {
    // Reply only when message sent is in 'text' format
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
      // Get text sent
      $text = $event['message']['text'];
      // Get replyToken
      $replyToken = $event['replyToken'];

      if ($text == 'สวัสดี') {
        $replyText = 'สวัสดีเช่นกัน';
      } else if ($text == 'คุณชื่ออะไร') {
        $replyText = 'ศานติโลกา';
      } else if ($text == 'ทำอะไรได้บ้าง') {
        $replyText = 'ฉันทำได้หลายอย่าง เช่น บอกคุณว่าเรามีกิจกรรมอะไรบ้างในอนาคต';
      } else {
        $replyText = 'ไม่เข้าใจ';
      }

      // Build message to reply back
      $messages = [
        'type' => 'text',
        'text' => $replyText
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/reply';
      $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages],
      ];
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_PROXY, $proxy);
      curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n";
    }
  }
}
echo "OK";