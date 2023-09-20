<?php 
date_default_timezone_set("Asia/Tehran");
require __DIR__.'/vendor/autoload.php';
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
    'name'=>$input[0],//جمال غریب
    'zone'=>$input[1],//خانقا
    'address'=>$input[2],//آبان 28 
    'nat'=>substr_replace($input[3], "***", 3, 3),
    'phone'=>$input[4],
    ];
 // بارگذاری تصویر

$image = Image::make('/home/arambaar/public_html/post.jpg');
// first text
$image->text(renderText($data['name']), 800, 50, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb.ttf');
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});

// 2th text 
$image->text(renderText($data['address']), 850, 120, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb.ttf');
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});



// 3th text 
$image->text($data['nat'], 780, 220, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb.ttf');
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text(renderText($data['zone']), 830, 300, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});



// 4th text 
$image->text(substr_replace($data['phone'], "***", 3, 3), 750, 400, function($font) {
    $font->file('/home/arambaar/public_html/IRANSansWeb(FaNum).ttf');
    $font->size(35);
    $font->color('#30336b');
    $font->align('center');
    $font->valign('top');
});

// ذخیره تصویر در مسیر جدید
$image->save('ppost.jpg');
$caption=sprintf("🌺جناب آقای / سرکار خانم %s مرسوله شما به نامه رسان تحویل شده است ، جهت تحویل مرسوله با شماره زیر تماس بگیرید :\n📞09133563070- غریب \n لغو11", $data['name']);

$eita=new Eita("bot205514:60ae607d-f768-43a8-be99-e05b4f3e0c0a");
$eitaParams=[
    'file'=> new \CurlFile("ppost.jpg"),
    'chat_id'=> '9403093',
    'caption'=>$caption,

];
$eitaRes=$eita->sendPhoto($eitaParams);
//------------------------------------------------------------------------
try{  
    $message = $caption;
    $lineNumber = 3000859975; 
    $receptor = $data['phone'];
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  


