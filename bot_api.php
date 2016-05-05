<?php
$API_KEY = '187767986:AAFLK_h8SMMG1mH8cDS64xfE5Lb6LRyo2vU';
$url = 'https://api.telegram.org/bot'.$API_KEY;
$update = file_get_contents($url."/getupdates");
$updateArray = json_decode($update,TRUE);

$chatId = $updateArray["result"][0]["message"]["chat"]["id"];

$update = file_get_contents($url."/sendmessage?chat_id=".$chatId."&text=Maxalchik");
?>