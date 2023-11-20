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
    'companyphone'=>$input[25]//شماره هماهنگی شرکت 

    ];

     
     $characters = preg_split("/ع|ایران/", $data['dpluck']);

$string = sprintf('راننده گرامی ضمن عرض سلام و خسته نباشید ، شماره صاحب بار بارنامه %s به تناژ %d با احترام تقدیم حضور میگردد %s  شرکت حمل نقل آرام بار ' , $data['bar'], $data['dtonaj'], $data['sahebbarphone']);
try{  
    $message = "\n".$string;
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


