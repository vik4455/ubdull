<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = 'wg5krRjKGZ3LnV109YBgOLOJ0f/cdg2ZkXHUjW8G9GLbDPhG8RasvXp6IXOq2gk0fhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QnhHQFGR1LmLYPzkLv6oJz/0493BO+moa6fBWN76U3XMgdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'd171b56cec58a1af71389799f9564b10';

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message') {
			switch($event['message']['type']) {
                case 'text':
                    //Get replyToken
                    $replyToken = $event['replyToken']; //Reply message
                    if($event['message']['text']=='กะแป๋ง'){
                        $respMessage='พ่อแอลลี่ '.$event['message']['text'];   
                    }else if($event['message']['text']=='กะแป๋ง'){
                        $respMessage='พ่อเสือน้อย '.$event['message']['text'];
                    }else if($event['message']['text']=='ผศ'){
                        $respMessage='พ่อภูพุ '.$event['message']['text'];
                    }else if($event['message']['text']=='เสี่ยโอ๋'){
                        $respMessage='พ่อนารา '.$event['message']['text'];
                    }else if($event['message']['text']=='ตี๋น้อย'){
                        $respMessage='ซินแสเมืองหนองกี่ '.$event['message']['text'];
                    }else if($event['message']['text']=='แสงเดือน'){
                        $respMessage='คุณเมียที่รักและเคารพ '.$event['message']['text'];
                    }else{
                        $respMessage='สุดยอดคุณพ่ออยู่นี่แหละ';
                    }
                    
                    $httpClient=new CurlHTTPClient($channel_token); 
                    $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); $textMessageBuilder=new TextMessageBuilder($respMessage);
                    $response = $bot->replyMessage($replyToken, $textMessageBuilder);
            } 
        }
    }
}

echo "OK";