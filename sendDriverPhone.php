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

$input = file_get_contents('php://input');
$input=json_decode($input);

$data=[
    'bar'=>$input[0],//کاشی
    'dtonaj'=>$input[1],//1500
    'dest'=>$input[2],//یزد
    'trackLink'=>$input[3],//31.922581649401153,54.358989322176825
    'baraddress'=>$input[4],//آدرس دقیق بارگیری
    'dnational'=>$input[5],//4480115617
    'dname'=>$input[6],//مجتبی غریب
    'dphone'=>$input[9],//شماره راننده
    'dpluck'=>$input[10],//پلاک خودرو 
    'carType'=>$input[11],//نوع خودرو
    'dsmart'=>$input[12],//هوشمند ماشین 
    'company'=>$input[13],//نام شرکت 
    'sahebbarphone'=>$input[18],//شماره صاحب بار 
    'carTracker'=>$input[20],//ماشین گیر
    'companyphone'=>$input[25]//شماره هماهنگی شرکت 

    ];
    
     $characters = preg_split("/ع|ایران/", $data['dpluck']);
 // بارگذاری تصویر
$image = Image::make(realpath('./pluck.jpg'));

$image->text(renderText($data['dest'])."-".renderText($data['carType']), 300, 28, function($font) {//مقصد
    $font->file(realpath('./Ray-ExtraBlack.ttf'));
    $font->size(40);
    $font->color('#ee484a');
    $font->align('center');
    $font->valign('top');
 });

$image->text(renderText($data['dname']), 280, 148, function($font) {// نام راننده 
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});

$image->text(renderText($data['company']), 280, 230, function($font) {// شرکت
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(40);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});

$image->text(($data['dtonaj']), 280, 304, function($font) {//تناژ
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(45);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});



 $image->text(($data['dnational']), 280, 380, function($font) {// کد ملی 
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});


$image->text($characters[2].renderText(" ایران").$characters[1].renderText("ع").$characters[0], 280, 450, function($font) {
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(40);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});


$image->text($data['dphone'], 280, 530, function($font) {// شماره راننده 
    $font->file( realpath('./Nian-Bold.ttf'));
    $font->size(40);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});

// ذخیره تصویر در مسیر جدید
$image->save('new.jpg');
//------------------------------------------------------------------------
$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
$caption="✈️ مقصد :".$data['dest']."\n"."⏲ تناژ :".$data['dtonaj']."\n"." 🚛نام راننده : ".$data['dname']."\n"." ✅ شماره پلاک :".$data['dpluck']."\n"
." 🏦 هوشمند :".$data['dsmart']."\n"." 👁‍🗨 کد ملی  : ".$data['dnational'] ."\n"."👤ماشین گیر:".$data['carTracker']."\n"."📞شماره راننده : ".$data['dphone']."\n"."⏰زمان:".$time."\n";
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
    $message = "اعلام پلاک جدید : \n".$caption;
    $lineNumber = 3000859975; 
    $receptor = "09133506955";
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  

