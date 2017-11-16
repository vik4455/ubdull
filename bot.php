<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = 'pfJsKyHp/SAvMMdXXZaXsNxKA+YlaN1bGt6aRevlXOj75GMnD4gkPvsF0gDh6hYyfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QkaPtdtBOTdPPEdPVozICNbwtREYm4L1UAc9g+5oflIFQdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'f60131c3b22cf492ec86acd0f7eeb0e2';

$content = file_get_contents('php://input'); 
$events = json_decode($content, true);
if (!is_null($events['events'])) {
//Loop through each event 
    foreach($events['events'] as $event){
    if ($event['type'] == 'message') { 
        switch($event['message']['type']) {
        case 'text'
            //Get replyToken
            //$replyToken = $event['replyToken'];
            // Reply message
            $respMessage = 'Hello, your message is '. $event['message']['text'];
            $httpClient = new CurlHTTPClient($channel_token);
            $bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));
            
            $textMessageBuilder = new TextMessageBuilder($respMessage); 
            $response = $bot->replyMessage('<replyToken>', $textMessageBuilder);
        break;
        } 
    }
    }
}

echo "OK";