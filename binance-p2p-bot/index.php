<?php

require_once 'functions.php';

$botToken = getenv('BOT_TOKEN');
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
echo $_SERVER['SERVER_NAME'] ;
switch($message) {
    case "/start":
        $response = "Welcome to the bot!";
        sendMessage($chatId, $response);
        break;
    case "/help":
        $response = "This is a simple bot to help you.";
        sendMessage($chatId, $response);
        break;
    default:
        $response = "I don't understand. Please type /help for more information.";
        sendMessage($chatId, $response);
        break;
}

function sendMessage($chatId, $response) {
    $url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($response);
    file_get_contents($url);
}

?>