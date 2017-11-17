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
                    }else if($event['message']['text']=='ติดกล้อง'){
                        $respMessage='ต้องร้าน Hi-Speed Net เลยมีให้เลือกหลายรุ่น สอบถามราคาแต่ละรุ่นเพียงพิมพ์ "1MP" "2MP" "4MP" ก็ได้รู้ราคากันแล้ว หรือโทร. 089-2842844 นายห้างชอบสี่มาก';   
                    }else if($event['message']['text']=='1MP'){
                        $respMessage='HP-IPCH13-VR01 / 1.3 ล้านพิกเซล / ราคา 2,300 บาท / HD Remote View by PC and Smart Phone.,Wireless Connection Router,360 Degree Full View Camera';
                    }else if($event['message']['text']=='2MP'){
                        $respMessage='HP-IPCH20-W1002-AP / 2.0 ล้านพิกเซล / ราคา 2,600 บาท / Anti-Cut 3-Axis Bracket
IP66 Waterproof Standard IR LED: 30PCS IR LED, 30Meter IR Distance';
                    }else if($event['message']['text']=='4MP'){
                        $respMessage='HP-IPCH40-W1070-OV / 4.0 ล้านพิกเซล / ราคา 3,500 บาท / Anti-Cut 3-Axis Bracket
IP66 Waterproof Standard IR LED: 36PCS IR LED, 30Meter IR Distance';
                    }else if($event['message']['text']=='กูไม่ซื้อ'){
                        $respMessage='ไอ่ซ้าด แล้วมึงถามทำฟรวยไร ';
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
                    }else if(strpos($event['message']['text'], 'สัส') !== false){
                        $respMessage='ทำไมพูดไม่ไพเราะเลยครับ ที่บ้านไม่สั่งสอนเหรอ';
                    }else if(strpos($event['message']['text'], 'เชี่ย') !== false){
                        $respMessage='นาทีนี้ ผศ คนเดียวเลยฮะ ด่าแต่กรู';
                    }else if(strpos($event['message']['text'], 'ราชการ') !== false){
                        $respMessage='มันก็แค่ข้ออ้างบังหน้าครับ';
                    }else if($event['message']['text']=='ไปราชการ') !== false){
                        $respMessage='แปลว่าไปตีหม้อ';
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