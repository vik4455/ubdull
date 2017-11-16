<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

$channel_token = 'Lffp33UgmurEA06PCo+Aru9LPpZS9heaNnMQim6Uj4ceMzosmD1lgc1l5VMKhnsGfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69Qn1PUTwgr4lsSh5Hf7XCZ8R/5MZqOuynV61EmUT8LNsywdB04t89/1O/w1cDnyilFU=';
$channel_secret = 'f60131c3b22cf492ec86acd0f7eeb0e2';

//Get message from Line API
$content = file_get_contents('php://input');

// แปลงข้อความรูปแบบ JSON  ให้อยู่ในโครงสร้างตัวแปร array
$events = json_decode($content, true);
if(!is_null($events)){
    // ถ้ามีค่า สร้างตัวแปรเก็บ replyToken ไว้ใช้งาน
    $replyToken = $events['events'][0]['replyToken'];
}
// ส่วนของคำสั่งจัดเตียมรูปแบบข้อความสำหรับส่ง
$textMessageBuilder = new TextMessageBuilder(json_encode($events));
 
//l ส่วนของคำสั่งตอบกลับข้อความ
$response = $bot->replyMessage($replyToken,$textMessageBuilder);
if ($response->isSucceeded()) {
    echo 'Succeeded!';
    return;
}
 
// Failed
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>