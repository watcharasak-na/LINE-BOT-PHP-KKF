<?php
$access_token = 'XGwHGXONz/LuYr3OZOVLFKMazoBIOwK/hoZa9SHGaOz6Zqu8aaW+AkRtKc8zs4A5GcYk1qFA0ONzsqU+iqbITU8TupYFIKLek5TJnZyBtmUGc65fGUrjk56JGE1Ay2m87lgfR53jCd5gsWO/G1cESgdB04t89/1O/w1cDnyilFU=';
$proxy = 'velodrome.usefixie.com:80';
$proxyauth = 'fixie:W8B1EissNtwSwyk';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
$result = curl_exec($ch);
curl_close($ch);

echo $result;