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
        $replyToken = $event['replyToken']; 
		
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
        $host = 'ec2-54-163-255-181.compute-1.amazonaws.com';
        $dbname = 'dcoh0blsle9i6l'; 
        $user = 'fljlfseofpkpfr';
        $pass = 'ac9fab1bfcbd77359fb3c7f0a30c571de1e94d13006d1be29aa39e5c978b9182'; 
        $connection=new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
            if($result){
                $txttel =explode(',', $event['message']['text']);
                $sql=sprintf("SELECT * FROM com4_6_phone WHERE name = '".$txttel[1]."'");
                $result = $connection->query($sql);
                error_log($sql);
                $amount = $result->rowCount();
                
                $respMessage = $txttel[0]." => ".$txttel[1]." => ".$txttel[2]." => ".$amount;
            }
        }//if event
        
        $httpClient = new CurlHTTPClient($channel_token);
        $bot=new LINEBot($httpClient, array('channelSecret'=> $channel_secret));
        
        $textMessageBuilder=new TextMessageBuilder($respMessage);
        $response=$bot->replyMessage($replyToken, $textMessageBuilder);
    }
}

echo "OK";