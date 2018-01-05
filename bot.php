<?php
require_once('./vendor/autoload.php');
// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use \LINE\LINEBot\MessageBuilder\ImageMessageBuilder;
use \LINE\LINEBot\MessageBuilder\StickerMessageBuilder;
use \LINE\LINEBot\MessageBuilder\LocationMessageBuilder;

$channel_token = 'sOttPVIPecY31qh4PLzQ/OFyyTBn7/oIk3rvObgarbgkS954zwoItNBVBRiXmCVIfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QlnQEYMcsLT4WAJlqANJ+ivQ0wyoJ91FOHmIP351/LPQwdB04t89/1O/w1cDnyilFU=';
$channel_secret = '7d7c763746c7377064d0d8f491f01679';

//Get message from Line API
$content = file_get_contents('php://input');
$events=json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
        include 'include/connect.php';
        $httpClient = new CurlHTTPClient($channel_token);
        
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret));
        $grp = $event['source']['groupId'];
        $user = $event['source']['userId'];
        $replyToken = $event['replyToken'];
        
        $manager = $conn->query('SELECT mng_id FROM manager');
        $cm = $manager->num_rows;

		$res = $bot->getProfile($user);
        if ($res->isSucceeded()) {
            $profile = $res->getJSONDecodedBody();
            $displayName = $profile['displayName']; 
        }
        if ($event['type'] == 'message') {
            if($event['message']['type']=='text'){
                $msg = $event['message']['text'];
                $txt =explode(',', $msg);
                $dt = date('Y-m-d');
                if(($txt[0]=="rg")&&(strlen($txt[1])==13)&&(is_numeric($txt[1]))){
                    $chkuser = $conn->query('SELECT user_name FROM user WHERE user_id = "'.$user.'"');
                    $cu = $chkuser->num_rows;
                    if($cu==0){
                        $add_user = $conn->query('INSERT INTO 
                            user (user_name,user_id,user_citizen,add_date) 
                            VALUES ("'.$displayName.'","'.$user.'","'.$txt[1].'","'.$dt.'")');
                            if (!$add_user) {
                                die('Add Member : '.$conn->error);
                            }
                    $respMessage= "ลงทะเบียนสมาชิก ชื่อ : ".$displayName."
เลขบัตร : ".$txt[1]." เรียบร้อย";    
                    }else{
                    $respMessage= "สมาชิกมีในระบบเรียบร้อยแล้ว";    
                    }
                           
                }
                
                if(($msg=="info")&&($user=="U21fc57cb014940d3a2e0f648dbf4aec3")){
                    $respMessage= "สมาชิกที่เข้าร่วมใหม่ พิมพ์
-----------------
rg,เลขที่บัตรประชาชน
-----------------
เพื่อลงทะเบียนกับเราก่อน";    
                }
                    
            }
        }
        
        $textMessageBuilder=new TextMessageBuilder($respMessage);
        $response=$bot->replyMessage($replyToken, $textMessageBuilder);
    }
}

echo "OK";