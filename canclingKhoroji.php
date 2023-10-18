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
    'baraddress'=>$input[4],//آدرس دقیق بارگیری
    'dname'=>$input[6],//مجتبی غریب
    'dphone'=>$input[9],//شماره راننده
    'machingir'=>$input[20],
    'time'=>$time,
    'why'=>$input[32],
    ];

    $message  = sprintf("☹️کنسلی  جدید : 
    مقصد %s | تناژ %d | نام راننده : %s |  ماشین گیر: %s |علت : %s | تاریخ کنسلی : %s | %s",
     $data['dest'],
     $data['dtonaj'],
     $data['dname'],
     $data['machingir'],
     $data['why'],
     $data['time'],
     'لغو:11');
try{  
    $message = "\n".$message;
    $lineNumber = 3000859975; 
    $receptor = '09133506955';
    $api = new \Ghasedak\GhasedakApi('24e1baaec4e55a766478d8131a1bd5400f97d7eb03cd95954eb1ec177cdec853');
    $api->SendSimple($receptor,$message,$lineNumber);  
   }
   catch(\Ghasedak\Exceptions\ApiException $e){  
    echo $e->errorMessage();  
   }  
   catch(\Ghasedak\Exceptions\HttpException $e){  
    echo $e->errorMessage();  
   }  


