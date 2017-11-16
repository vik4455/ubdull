<?php
$access_token = 'NX3gVUbJlcigNvsVtNqIr2cb0wdriV4OahIH6pB7O6gUAtU54iDhhK6Eu6wHbci7fhU083AzutOM0pJbyVHb9L5bewHM5145QWTRz5a69QldQ+h6q73y1VPt57DFlE/SyQqsx6BrKu28AGUES6+BawdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;