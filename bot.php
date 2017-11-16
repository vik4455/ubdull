<?php
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('jf4myrsLqZMwMyra5wuDVfNU2fhADDNoo7851ngpr0V/BFPNAkALW4C4UQ0O/9lyfhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QkieesC8Hh3K2HR5Vi0RHYcAEX4qY4ShCOG/xkYPEmzHAdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'f60131c3b22cf492ec86acd0f7eeb0e2']);

$response = $bot->replyText('<reply token>', 'hello!');