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
$message="";
// ساخت صورت بار 
foreach ($input as $row) {
    $type = $row[0];
    $load = $row[1];
    $tonnage = $row[2];
    $destination = $row[4];
    $loadingLocation = $row[5];
    $message.= sprintf("%s %s %s %s %s ", $type, $tonnage, $destination, $load, $loadingLocation)."\n";

}

echo $message;
// ساخت صورت بار 
return false;
    
    $telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
    $caption="✈️ مقصد :".$data['dest']."\n"."⏲ تناژ :".$data['dtonaj']."\n"." 🚛نام راننده : ".$data['dname']."\n"." ✅ شماره پلاک :".$data['dpluck']."\n"
    ." 🏦 شرکت :".$data['dsmart']."\n"." 👁‍🗨 کد ملی  : ".$data['dnational'] ."\n"."⏰زمان:".$time."\n";
    $params = [
              'chat_id'=> '-1001714934522',
              'text'=> $caption
             ];
             
    $response = $telegram->sendMessage($params);

try{  
    $message = "\n".$message;
    $lineNumber = 3000859975; 
    $receptor = $data['companyphone'];
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  


