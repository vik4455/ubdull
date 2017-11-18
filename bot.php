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
                case 'text':
                    //Get replyToken
                    $replyToken = $event['replyToken']; //Reply message
                    if($event['message']['text']=='ubdull'){
                        $respMessage='เรามารวยไปด้วยกันนะ พิมพ์ ทีเด็ด1,2,3';
                        $textMessageBuilder=new TextMessageBuilder($respMessage);
                        break;
                    }else if($event['message']['text']=='กาก'){
                        $packageId = 1; 
                        $stickerId = 3;
                        $textMessageBuilder=new StickerMessageBuilder($packageId, $stickerId);
                        break;
                    }else if(strpos($event['message']['text'],'ทีเด็ด'){
                        $originalContentUrl = 'https://scontent-fbkk5-7.us-fbcdn.net/v1/t.1-48/1426l78O9684I4108ZPH0J4S8_842023153_K1DlXQOI5DHP/dskvvc.qpjhg.xmwo/w/data/1006/1006732-img.s86i03.ukvq.jpg';
                        $previewImageUrl = 'https://scontent-fbkk5-7.us-fbcdn.net/v1/t.1-48/1426l78O9684I4108ZPH0J4S8_842023153_K1DlXQOI5DHP/dskvvc.qpjhg.xmwo/w/data/1006/1006732-img.s86i03.ukvq.jpg';
                        $textMessageBuilder=new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
                        break;
                    }else if (strpos($event['message']['text'], 'มีเคร') !== false) {
                        $respMessage='การพนันไม่ทำให้ใครรวยนะครับ';
                        $textMessageBuilder=new TextMessageBuilder($respMessage);
                        break;
                    }else if (strpos($event['message']['text'], 'สัส') !== false) {
                        $respMessage='หยาบคายชิบหาย ควย';
                        $textMessageBuilder=new TextMessageBuilder($respMessage);
                        break;
                    }else if(strpos($event['message']['text'],'ไก่ขาว'){
                        $originalContentUrl = 'https://cdn.images.express.co.uk/img/dynamic/67/590x/Tottenham-v-Arsenal-Pochettino-Chelsea-title-race-798540.jpg';
                        $previewImageUrl = 'https://cdn.images.express.co.uk/img/dynamic/67/590x/Tottenham-v-Arsenal-Pochettino-Chelsea-title-race-798540.jpg';
                        $textMessageBuilder=new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
                        break;
                    }else if(strpos($event['message']['text'],'ขอราคา'){
                        $originalContentUrl = 'https://cdn.images.express.co.uk/img/dynamic/67/590x/Tottenham-v-Arsenal-Pochettino-Chelsea-title-race-798540.jpg';
                        $previewImageUrl = 'https://cdn.images.express.co.uk/img/dynamic/67/590x/Tottenham-v-Arsenal-Pochettino-Chelsea-title-race-798540.jpg';
                        $textMessageBuilder=new ImageMessageBuilder($originalContentUrl, $previewImageUrl);
                        break;
                    }
            }
        $httpClient=new CurlHTTPClient($channel_token); 
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
        
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
    }
}

echo "OK";