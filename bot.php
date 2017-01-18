<?php
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\GuzzleHTTPClient;

// Set these
$config = [
    'channelId' => '1496021296',
    'channelSecret' => '515995d49d4801e7c580b8c914709b35',
];
$sdk = new LINEBot($config, new GuzzleHTTPClient($config));

$postdata = @file_get_contents("php://input");
$messages = $sdk->createReceivesFromJSON($postdata);

// Verify the signature
// REF: http://line.github.io/line-bot-api-doc/en/api/callback/post.html#signature-verification
$sigheader = 'LineBot';
// REF: http://stackoverflow.com/a/541450
$signature = @$_SERVER[ 'HTTP_'.strtoupper(str_replace('-','_',$sigheader)) ];
if($signature && $sdk->validateSignature($postdata, $signature)) {
    // Next, extract the messages
    if(is_array($messages)) {
        foreach ($messages as $message) {
            if ($message instanceof LINEBot\Receive\Message\Text) {
                $text = $message->getText();
                if ($text == "hi") {

                    // Send the mid back to the sender and check if the message was delivered
                    $result = $sdk->sendText([$text], $text);
                    if(!$result instanceof LINE\LINEBot\Response\SucceededResponse) {
                        error_log('LINE error: ' . json_encode($result));
                    }
                } else {
                    // Process normally, or do nothing
                    $result = $sdk->sendText([$text], $text);
                    if(!$result instanceof LINE\LINEBot\Response\SucceededResponse) {
                        error_log('LINE error: ' . json_encode($result));
                    }
                }
            }
        }
    } // Else, error
} else {
    error_log('LINE signatures didn\'t match');
}