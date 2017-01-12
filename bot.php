<?php
$access_token = 'wzwpbz9tZWCSPDrTFYf+APzByZ3jnlV259OV13WiCcsBXMftEVvi/OzVdEy8C31CYj4iA6GdPwQ5QCBnrJPKTNC4IcxZlr4bJwIVRAPd1FlWnDG8ThGjHWY4ZIOD1V/DhshZVuUJUv+YfDrLgh6xtgdB04t89/1O/w1cDnyilFU=';
// Get POST body content
//$content = file_get_contents('php://input');
$content = {"events":[{"type":"message","replyToken":"9a0353fad2ca47009bd42d4716116bb8","source":{"userId":"Ubb0233685f6c43ad7af9f72476d67f16","type":"user"},"timestamp":1484190639335,"message":{"type":"text","id":"5489547671801","text":"p"}}]};
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data

echo 'OKK';
print_r($events);