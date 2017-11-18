<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
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
            case 'text': {
                    switch(strtolower($event['message']['text'])) { 
                        case 'm':
                            $respMessage='What sup man.Go away!';
                            break; 
                        case 'f':
                            $respMessage='Love you lady.';
                            break; 
                        default:
                            $respMessage='What is your sex? M or F'; 
                        break;
                    }
                }
                $textMessageBuilder=new TextMessageBuilder($respMessage);
                break;
            case 'image':
                $originalContentUrl = 'https://img.purch.com/w/660/aHR0cDovL3d3dy5zcGFjZS5jb20vaW1hZ2VzL2kvMDAwLzAwNS82NDQvb3JpZ2luYWwvbW9vbi13YXRjaGluZy1uaWdodC0xMDA5MTYtMDIuanBn';
                $previewImageUrl = 'https://img.purch.com/w/660/aHR0cDovL3d3dy5zcGFjZS5jb20vaW1hZ2VzL2kvMDAwLzAwNS82NDQvb3JpZ2luYWwvbW9vbi13YXRjaGluZy1uaWdodC0xMDA5MTYtMDIuanBn';
                $textMessageBuilder=new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
                //$messageID = $event['message']['id']; 
                //$respMessage='Hello, your image ID is '.$messageID;
                break;
            case 'sticker':
                $packageId = 1; 
                $stickerId = 3;
                $textMessageBuilder=new StickerMessageBuilder($packageId, $stickerId);
                break;
            case 'location':
                $address = $event['message']['address'];
                $respMessage='Hello, your address is '.$address;
                break;
//            case 'video':
//                $messageID = $event['message']['id'];
//                $fileID = $event['message']['id'];
//                $response = $bot->getMessageContent($fileID); 
//                $fileName = 'linebot.mp4'; 
//                $file=fopen($fileName, 'w');
//                fwrite($file, $response->getRawBody());
//                $respMessage='Hello, your video ID is '.$messageID;
//                break;
//            case 'audio':
//                $messageID = $event['message']['id'];
//                $fileID = $event['message']['id'];
//                $response = $bot->getMessageContent($fileID); 
//                $fileName = 'linebot.m4a'; $file=fopen($fileName, 'w');
//                fwrite($file, $response->getRawBody());
//                $respMessage='Hello, your audio ID is '.$messageID;
//                break;
            default:
                $respMessage='What is you sent ?'; 
                break;
        }
        $httpClient=new CurlHTTPClient($channel_token); 
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
        
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
    }
}

echo "OK";