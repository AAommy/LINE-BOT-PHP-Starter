<?php
$access_token = 'wzwpbz9tZWCSPDrTFYf+APzByZ3jnlV259OV13WiCcsBXMftEVvi/OzVdEy8C31CYj4iA6GdPwQ5QCBnrJPKTNC4IcxZlr4bJwIVRAPd1FlWnDG8ThGjHWY4ZIOD1V/DhshZVuUJUv+YfDrLgh6xtgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if(strpos($text, 'h') !== false){
				$messages = [
					'type' => 'text',
					'text' => 'hello'
				];
			}else if($text == '555'){
				$messages = [
					'type' => 'text',
					'text' => '5 5 5'
				];
			}else{
				$messages = [
					'type' => 'image',
					'originalContentUrl' => 'https://github.com/AAommy/LINE-BOT-PHP-Starter/blob/master/Hydrangeas.jpg',
					'previewImageUrl' => 'https://github.com/AAommy/LINE-BOT-PHP-Starter/blob/master/aaa.jpg'
				];
			}
			/*$messages = [
				'type' => 'text',
				'text' => $Textreply
			];*/
			
			/*$messages = [
				'type' => 'image',
				'originalContentUrl' => 'Hydrangeas.jpg',
				'previewImageUrl' => 'aaa.jpg'
			];*/

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
