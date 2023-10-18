
<?php 
date_default_timezone_set("Asia/Tehran");
require __DIR__.'/vendor/autoload.php';
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Intervention\Image\ImageManagerStatic as Image;
use \Ghasedak\GhasedakApi;
require ('Eita.php');
$time=\Morilog\Jalali\Jalalian::now();

$input = file_get_contents('php://input');
$input=json_decode($input);

$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');





return false;
$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
$caption="✈️ مقصد :".$data['dest']."\n"."⏲ تناژ :".$data['dtonaj']."\n"." 🚛نام راننده : ".$data['dname']."\n"." ✅ شماره پلاک :".$data['dpluck']."\n"
." 🏦 هوشمند :".$data['dsmart']."\n"." 👁‍🗨 کد ملی  : ".$data['dnational'] ."\n"."⏰زمان:".$time."\n";
$params = [
          'chat_id'=> '-1001714934522',
          'photo'=> new InputFile("new.jpg"),
          'caption'=> $caption
         ];
         
$response = $telegram->sendPhoto($params);