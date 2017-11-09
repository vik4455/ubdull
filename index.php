<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
$channel_token = 'xTm6W+W9dDaM5UIZKhFUhdUHExbahJJixWPbl1rG7MjYvpgcf2TukjOM/Ain+7ozfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QneMTAqDQX7TwW4Dl6gm3+03lZ1E2QSFtRXxUNbCNU5EwdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'a112cedb91a3ded4ba9cf92c990c07fb';
//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);
if (!is_null($events['events'])) {
//Loop through each event foreach($events['events']as $event){
// Line API send a lot of event type, we interested in message only. if ($event['type'] == 'message') {
switch($event['message']['type']) {
case 'text':
//Get replyToken
$replyToken = $event['replyToken']; //Reply message
$respMessage='Hello, your message is '.$event['message']['text'];
$httpClient=newCurlHTTPClient($channel_token); $bot=newLINEBot($httpClient, array('channelSecret'=> $channel_secret)); $textMessageBuilder=newTextMessageBuilder($respMessage);
} }
} }
$response=$bot->replyMessage($replyToken, $textMessageBuilder); break;
echo "OK";