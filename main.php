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
$json;
if ($input) {
    file_put_contents('file.json', $input);
    $json = json_decode($input, true);
} else {
    echo "No data.";
}
$array = $json;
$info = array_merge(...$array);


$data=[
    'dest'=>$info[0][0],
    'dnational'=>$info[1][0],
    'dname'=>$info[2][0],
    'dpluck'=>$info[3][0],
    'dsmart'=>$info[4][0],
    'dtonaj'=>$info[5][0],
    ];
    
     $characters = preg_split("/ع|ایران/", $data['dpluck']);
 // بارگذاری تصویر
$image = Image::make('/home/arambaar/public_html/image.jpg');


// first text
$image->text(renderText($data['dest']), 480, 15, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb.ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});

// 2th text 
$image->text(renderText($data['dname']), 420, 80, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb.ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 3th text 
$image->text($characters[2].renderText(" ایران").$characters[1].renderText("ع").$characters[0], 420, 150, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text(renderText($data['dsmart']), 440, 220, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text(($data['dnational']), 480, 290, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});



//tonaj 
$image->text(($data['dtonaj']), 480, 300, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(26);
    $font->color('#ff4242');
    $font->align('center');
    $font->valign('top');
});

// ذخیره تصویر در مسیر جدید
$image->save('new.jpg');

//------------------------------------------------------------------------
$telegram = new Api('6479029477:AAFFAmZrEpsgJHic785dogmHIsQ4VgknqIE');
$caption="✈️ مقصد :".$data['dest']."\n"."⏲ تناژ :".$data['dtonaj']."\n"." 🚛نام راننده : ".$data['dname']."\n"." ✅ شماره پلاک :".$data['dpluck']."\n"
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


