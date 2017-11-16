<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = 'Lffp33UgmurEA06PCo+Aru9LPpZS9heaNnMQim6Uj4ceMzosmD1lgc1l5VMKhnsGfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69Qn1PUTwgr4lsSh5Hf7XCZ8R/5MZqOuynV61EmUT8LNsywdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'f60131c3b22cf492ec86acd0f7eeb0e2';

/Get message from Line API
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
        $httpClient=newCurlHTTPClient($channel_token); $bot=newLINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
        $textMessageBuilder=newTextMessageBuilder($respMessage);
    } 
  }
}
}
$response=$bot->replyMessage($replyToken, $textMessageBuilder); break;
echo "OK";