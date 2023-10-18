<?php 
date_default_timezone_set("Asia/Tehran");
require __DIR__.'/vendor/autoload.php';
$time=\Morilog\Jalali\Jalalian::now();
$input = file_get_contents('php://input');
$input=json_decode($input);

$data=[
    'bar'=>$input[0],//کاشی
    'dtonaj'=>$input[1],//1500
    'dest'=>$input[2],//یزد
    'baraddress'=>$input[3],//آدرس دقیق بارگیری
    'dname'=>$input[4],//مجتبی غریب
    'dphone'=>$input[5],//شماره راننده
    'machingir'=>$input[6],//پلاک خودرو 
    'time'=>$time,
    ];

    
     $message  = sprintf("راننده گرامی آقای %s حواله بارنامه محموله %s به تناژ %d و به مقصد %s برای شما صادر شد. مسئول هماهنگی %s\nلغو :11 ",
     $data['dname'],
     $data['bar'],
     $data['dtonaj'],
     $data['dest'],
     $data['machingir']);

     try{  
    $message = "\n".$message;
    $lineNumber = 3000859975; 
    $receptor = $data['dphone'];
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  


