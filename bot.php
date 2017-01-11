<?php
$access_token = 'wzwpbz9tZWCSPDrTFYf+APzByZ3jnlV259OV13WiCcsBXMftEVvi/OzVdEy8C31CYj4iA6GdPwQ5QCBnrJPKTNC4IcxZlr4bJwIVRAPd1FlWnDG8ThGjHWY4ZIOD1V/DhshZVuUJUv+YfDrLgh6xtgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '515995d49d4801e7c580b8c914709b35';
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

			$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
			$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

			$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
			$response = $bot->replyMessage($replyToken, $textMessageBuilder);

			echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
		}
	}
}
echo "OK";
