<?php


class RowExtractor
{

      private $string ;
      public function __construct($string)
      {
        $this->string=$string;
      }
     public function ExtractCell()  {
        $pattern = '/(\d+)/'; 
        if (preg_match($pattern, $this->string, $matches)) {
            $number = $matches[0]; // عدد یافت شده
            $beforeNumber = strstr($this->string, $number, true); // رشته قبل از عدد
            $afterNumber = strstr($this->string, $number); // رشته بعد از عدد
            $string = str_replace($number, '', $this->string); // حذف عدد از رشته اصلی
            return (object)[
                'number'=>$number,
                'beforeNumber'=>$beforeNumber,
                'afterNumber'=>$afterNumber,
                'remianString'=>$string
            ];

            $this->string=$string;
        

        }
        return null;


        
     }


     public function ExtractByCharacter(){
        
        return explode("~",$this->string);
     }
}
