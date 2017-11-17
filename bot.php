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
                        $respMessage='เรามารวยไปด้วยกันนะ พิมพ์ ทีเด็ด1,2,3';   
                    }else if($event['message']['text']=='ทีเด็ด1'){
                        $respMessage='เชฟฟิลด์ ยูไนเต็ด ต่อ ครึ่งลูกครับ แม้จะเป็นเกมส์เยือนแต่เบอร์ตัน อัลเบี้ยนเล่นในบ้านฟอร์มไม่ดีเลย กัดฟันต่อดาบคู่ครับ อับดุลมั่นจายย';
                    }else if($event['message']['text']=='ทีเด็ด2'){
                        $respMessage='สูง 2.5 บุนเดสลีกา 2 ไอน์ทรัค เบาร์ชไวน์ พบ บีเลเฟลด์ รั่วด้วยกันทั้งคู่ บีเลเฟลด์ในบ้านกาก ไอน์ทรัคเยือนก็กาก เชื่อว่ายิงกันยับ อับดุลว่าสูงแน่ๆ';
                    }else if($event['message']['text']=='ทีเด็ด3'){
                        $respMessage='เดน บอสช์ เจอ โวเลนดัม ราคาเสมอ โวเลนดัมบ๊วยครับ ฟอร์มย่ำแย่จริงๆ ราคาเสมอลุ้นเดน บอสช์ดีกว่าครับ เชื่ออับดุล เราจะรวยไปด้วยกัน';
                    }else if($event['message']['text']=='บอลสเต็ป'){
                        $respMessage='ต่อเชฟยู - สูงไอน์ทรัค เบราชไวน์ - เดน บอสช์ - วิสล่าคราคอฟ ';
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