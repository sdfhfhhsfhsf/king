<?php
// تنظیمات ربات
$botToken = "8963293263:AAEdeYYtjOLH323-ollWlgB7Ensx68ot7l0";
$adminId = 8854073031;
$website = "https://api.telegram.org/bot" . $botToken;

// دریافت درخواست‌های تلگرام (Webhook)
$content = file_get_contents("php://input");
$update = json_decode($content, TRUE);

if(!$update) {
    exit;
}

$chatId = $update["message"]["chat"]["id"] ?? null;
$messageText = $update["message"]["text"] ?? null;
$userId = $update["message"]["from"]["id"] ?? null;
$firstName = $update["message"]["from"]["first_name"] ?? "";

if($chatId && $messageText) {
    if($messageText == "/start") {
        $reply = "سلام {$firstName} عزیز!\nربات با موفقیت فعال شد.";
        sendPlainText($chatId, $reply);
    } elseif($messageText == "/id") {
        sendPlainText($chatId, "آیدی عددی شما: {$userId}");
    }
}

function sendPlainText($chatId, $text) {
    global $website;
    $url = $website . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($text);
    file_get_contents($url);
}
?>
