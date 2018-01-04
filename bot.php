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
        
        $ins = $conn->query('SELECT MAX(idmember) AS mm FROM member');
                $mm = $ins->fetch_assoc();
                $nid = str_pad($mm['mm']+1,3,"0",STR_PAD_LEFT);
		$res = $bot->getProfile($user);
        if ($res->isSucceeded()) {
            $profile = $res->getJSONDecodedBody();
            $displayName = $profile['displayName'];
        }
        if ($event['type'] == 'message') {
            switch($event['message']['type']) {
                case 'text':
                $ct = $event['message']['text'];
                
                $txt =explode(',', $ct);
                $dt = date('Y-m-d');
                
                if(($txt[0]=="rg")&&(strlen($txt[1])==13)&&(is_numeric($txt[1]))){
                $add_user = $conn->query('INSERT INTO 
                            member (idmember,mem_name,mem_id,mem_card,mem_status,date_regis) 
                            VALUES ("'.$nid.'","'.$displayName.'","'.$user.'","'.$txt[1].'","11","'.$dt.'")');
                            if (!$add_user) {
                                die('Add Member : '.$conn->error);
                            }
                $respMessage= "ลงทะเบียนสมาชิก ".$ni." ชื่อ : ".$displayName." ".$txt[1]." User ID : ".$user." วันที่ : ".$dt;
                }else{
                $respMessage= "format ลงทะเบียนคือ rg,(เลขบัตรประชาชน)";
                }
                break;
                case 'image':
                $fileID = $event['message']['id']; 
                $response = $bot->getMessageContent($fileID); 
                $fileName = md5(date('Y-m-d')).'.jpg'; 
                if ($response->isSucceeded()) {         // Create file.         
                    $file = fopen($fileName, 'w');         
                    fwrite($file, $response->getRawBody());
                    $upd_user = $conn->query('UPDATE member SET mem_cardimg = "'.$fileName.'"');
                            if (!$upd_user) {
                                die('Add Member : '.$conn->error);
                            }
                }else {
                    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
                }
                $respMessage='บันทึกรูปบัตรประชาชน';
                break;
                case 'location':
                $respMessage='สถานที่';
                break;
                case 'audio':
                $respMessage='เสียง';
                break;
            }   
        }
        
        $textMessageBuilder=new TextMessageBuilder($respMessage);
        $response=$bot->replyMessage($replyToken, $textMessageBuilder);
    }
}

echo "OK";