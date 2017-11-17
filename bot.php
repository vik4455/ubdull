<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;

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
			switch($event['message']['type']) {
                case 'text':
                    //Get replyToken
                    $replyToken = $event['replyToken']; //Reply message
                    if($event['message']['text']=='ติดกล้อง'){
                        $respMessage='ต้องร้าน Hi-Speed Net เลยมีให้เลือกหลายรุ่น สอบถามราคาแต่ละรุ่นเพียงพิมพ์ "1MP" "2MP" "3MP" "4MP" ก็ได้รู้ราคากันแล้ว';   
                    }else if($event['message']['text']=='1MP'){
                        $respMessage='HP-IPCH13-VR01 / ราคา 2,300 บาท / <br>- HD Remote View by PC and Smart Phone.<br>
- Wireless Connection Router<br>
- 360 Degree Full View Camera';
                    }else if($event['message']['text']=='2MP'){
                        $respMessage='พ่อภูพุ '.$event['message']['text'];
                    }else if($event['message']['text']=='3MP'){
                        $respMessage='พ่อนารา '.$event['message']['text'];
                    }else if($event['message']['text']=='4MP'){
                        $respMessage='ซินแสเมืองหนองกี่ '.$event['message']['text'];
                    }else if($event['message']['text']=='แสงเดือน'){
                        $respMessage='คุณเมียที่รักและเคารพ '.$event['message']['text'];
                    }
                    break;
                case 'location':
                    $address = $event['message']['address'];
                    //Reply message
                    $respMessage='Hello, your address is '.$address;
                    break;
            }
        $httpClient=new CurlHTTPClient($channel_token); 
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
        $textMessageBuilder=new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
    }
}

echo "OK";