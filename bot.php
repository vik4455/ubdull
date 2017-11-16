<?php
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('pfJsKyHp/SAvMMdXXZaXsNxKA+YlaN1bGt6aRevlXOj75GMnD4gkPvsF0gDh6hYyfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QkaPtdtBOTdPPEdPVozICNbwtREYm4L1UAc9g+5oflIFQdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'f60131c3b22cf492ec86acd0f7eeb0e2']);

$response = $bot->replyText('<reply token>', 'hello!');