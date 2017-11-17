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
                    if($event['message']['text']=='ubdull'){
                        $respMessage='ถามเอาที่กุจะพอรู้นะ สัส !!!';   
                    }else if($event['message']['text']=='CGX'){
                        $respMessage='อย่าให้พูดถึงเลยครับ องค์กรเหี้ยๆแบบนั้น';
                    }else if($event['message']['text']=='สกค'){
                        $respMessage='น่าจะสาปสูญไปแล้ว';
                    }else if($event['message']['text']=='hispeed'){
                        $respMessage='น่าจะสาปสูญไปแล้ว';
                    }else if($event['message']['text']=='เสือดำ'){
                        $respMessage='จุ๊ๆ โส่ยอยู่ ให้เมียเผลอก่อน';
                    }else if($event['message']['text']=='ผศ'){
                        $respMessage='ค่าตับสูงมากฮะ ตับๆ ตับๆ ตับๆๆๆ';
                    }else if($event['message']['text']=='ผอ แมว'){
                        $respMessage='อย่าให้พูดถึงเลยครับ';
                    }else if($event['message']['text']=='ทีละคน นะ สัส'){
                        $respMessage='เออ ใช่ กุรุ่นทดลองครับ !!!';
                    }else if($event['message']['text']=='ไปราชการ'){
                        $respMessage='แปลว่าไปตีหม้อ';
                    }else if(strpos($event['message']['text'], 'สัส') !== false){
                        $respMessage='ทำไมพูดไม่ไพเราะเลยครับ ที่บ้านไม่สั่งสอนเหรอ';
                    }else if(strpos($event['message']['text'], 'เชี่ย') !== false){
                        $respMessage='นาทีนี้ ผศ คนเดียวเลยฮะ ด่าแต่กรู';
                    }else if(strpos($event['message']['text'], 'ราชการ') !== false){
                        $respMessage='มันก็แค่ข้ออ้าง รึเปล่าวะ ?';
                    }else if(strpos($event['message']['text'], 'แป๋งไปไหน') !== false){
                        $respMessage='ไม่รู้ฮะ อย่าไปพูดถึงเค้าเลย';
                    }
                    break;
            }
        $httpClient=new CurlHTTPClient($channel_token); 
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret)); 
        $textMessageBuilder=new TextMessageBuilder($respMessage);
        $response = $bot->replyMessage($replyToken, $textMessageBuilder);
        
    }
}

echo "OK";