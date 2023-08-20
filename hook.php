<?php
date_default_timezone_set("Asia/Tehran");
require __DIR__.'/vendor/autoload.php';
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Intervention\Image\ImageManagerStatic as Image;
use \Ghasedak\GhasedakApi;
require ('Eita.php');
require ('RowExtractor.php');

$time=\Morilog\Jalali\Jalalian::now();

function renderText($txt)
{
    $persian_text_rev = \PersianRender\PersianRender::render($txt);
    $persian_text = '';
    for ($i = mb_strlen($persian_text_rev); $i >= 0; $i--) {
        $persian_text .= mb_substr($persian_text_rev, $i, 1);
    }
    return $persian_text;
}
$input = file_get_contents('php://input');
$data=json_decode($input);
$adminArray=[
    'gharib'=>5884978535,
    'Shaterian'=>5844990260
];
$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
//$response = $telegram->setWebhook(['url' => 'https://c36f-5-218-253-203.ngrok-free.app/appscript/PhotoSenderBot/PhotoSenderBot/hook.php']);
$text=$data->message->text;

$row=new RowExtractor();
$result=$row->ExtractCell($text);
echo $result->beforeNumber;
//--------------------------------------
