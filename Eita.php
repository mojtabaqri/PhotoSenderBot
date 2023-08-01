<?php

class Eita {

    private $token;

public function __construct ( $token)
{
    $this->token=$token;
}
public function sendPhoto($param){
 $request = curl_init('https://eitaayar.ir/api/'.$this->token.'/sendFile');
 curl_setopt($request, CURLOPT_POST, true);
 curl_setopt($request, CURLOPT_SSL_VERIFYHOST, 0);
 curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt(
     $request, CURLOPT_POSTFIELDS,
     array(
         'file' => $param['file'],
         'chat_id' => $param['chat_id'],
         'title' => "ArambarPkuck",
         'caption' => $param['caption'],
         'date' => time()+2, 
     ));
 curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
 echo curl_exec($request);
 curl_close($request);    

}

}