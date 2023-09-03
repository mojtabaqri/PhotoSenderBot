<?php 
date_default_timezone_set("Asia/Tehran");
require __DIR__.'/vendor/autoload.php';
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;
use Intervention\Image\ImageManagerStatic as Image;
use \Ghasedak\GhasedakApi;
require ('Eita.php');
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

$json = '[[["ابادان"]],[[5479894080]],[["امیرحمزه مشایخ"]],[["49ع462ایران73"]],[["شمس+جواهر"]],[[27]]]';
$array = json_decode($json, true);
$info = array_merge(...$array);


$data=[
    'dest'=>$info[0][0],
    'dnational'=>$info[1][0],
    'dname'=>$info[2][0],
    'dpluck'=>$info[3][0],
    'dsmart'=>$info[4][0],
    ];
    
     $characters = preg_split("/ع|ایران/", $data['dpluck']);
     
 // بارگذاری تصویر
$image = Image::make('image.jpg');


// first text
$image->text(renderText($data['dest']), 800, 40, function($font) {
    $font->file('IRANSansWeb.ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});

// 2th text 
$image->text(renderText($data['dname']), 735, 120, function($font) {
    $font->file('IRANSansWeb.ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 3th text 
$image->text($characters[2].renderText(" ایران").$characters[1].renderText("ع").$characters[0], 735, 215, function($font) {
    $font->file('IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text($data['dsmart'], 710, 300, function($font) {
    $font->file('IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text(($data['dnational']), 730, 400, function($font) {
    $font->file('IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});
$image->text(("31000"), 810, 480, function($font) {
    $font->file('IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});
// ذخیره تصویر در مسیر جدید
$image->save('new.jpg');

//------------------------------------------------------------------------
$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
$caption="✈️ مقصد :".$data['dest']."\n"." 🚛نام راننده : ".$data['dname']."\n"." ✅ شماره پلاک :".$data['dpluck']."\n"
." 🏦 شرکت :".$data['dsmart']."\n"." 👁‍🗨 کد ملی  : ".$data['dnational'] ."\n"."⏰زمان:".$time."\n";
$params = [
          'chat_id'=> '-1001714934522',
          'photo'=> new InputFile("new.jpg"),
          'caption'=> $caption
         ];
         
$response = $telegram->sendPhoto($params);
//---------------------------------------------------------------------
$eita=new Eita("bot193441:582790a7-a51d-4543-a673-81d1dddebfc4");
$eitaParams=[
    'file'=> new \CurlFile("new.jpg"),
    'chat_id'=> '9353793',
    'caption'=>$caption,

];
$eitaRes=$eita->sendPhoto($eitaParams);
//------------------------------------------------------------------------
try{  
    $message =     "اعلام پلاک جدید : \n".$caption;
    $lineNumber = 3000859975; 
    $receptor = "09134576502";
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  
