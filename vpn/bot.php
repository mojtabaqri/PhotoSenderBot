<?php
session_start();

// تعریف متغیرها
$botToken = '6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE';
$adminChatId = '5884978535';
$jsonFilePath = realpath('./va.json');
 
// دریافت محتویات جدید از تلگرام
$content = file_get_contents("php://input");
$update = json_decode($content, true);

// بررسی درخواست ارسال شده
if (isset($update["message"])) {
    $message = $update["message"];
    $text = $message["text"];
    $chatId = $message["chat"]["id"];
    $chatType = $message["chat"]["type"];

    // بررسی ادمین بودن فرد
    if (($chatId == $adminChatId) && ($chatType == 'private')) {
        // اینجا می‌توانید کد و پاسخ مورد نظر برای ادمین را قرار دهید

        // بررسی دستورات ادمین
        if ($text == '/update') {
            // درخواست آپدیت از ادمین
            $response = "لطفاً نام سرور را وارد کنید:";
            $_SESSION['step'] = 'server_name';
        } elseif ($_SESSION['step'] === 'server_name') {
            // دریافت نام سرور از ادمین
            $serverName = $text;
            $response = "لطفاً لینک سرور را وارد کنید:";
            $_SESSION['server_name'] = $serverName;
            $_SESSION['step'] = 'server_link';
        } elseif ($_SESSION['step'] === 'server_link') {
            // دریافت لینک سرور از ادمین و ذخیره در فایل JSON
            $serverLink = $text;
            $data = file_get_contents($jsonFilePath);
            $jsonArray = json_decode($data, true);
            $newItem = [
                'server' => $_SESSION['server_name'],
                'link' => $serverLink
            ];
            $jsonArray[] = $newItem;
            $jsonData = json_encode($jsonArray, JSON_PRETTY_PRINT);
            file_put_contents($jsonFilePath, $jsonData);

            $response = "اطلاعات با موفقیت به فایل JSON اضافه شد!";

            // پاک کردن session
            session_unset();
            session_destroy();
        } else {
            $response = "دستور نامعتبر!";
        }
    } 

    // ارسال پاسخ به تلگرام
    sendMessage($botToken, $chatId, $response);
}

// تابع ارسال پیام به تلگرام
function sendMessage($token, $chatId, $message, $replyMarkup = null) {
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $params = [
        'chat_id' => $chatId,
        'text' => $message,
        'reply_markup' => $replyMarkup,
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>