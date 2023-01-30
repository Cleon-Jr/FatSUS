<?php

$url = "http://ws.hubdodesenvolvedor.com.br/v2/cnpj/?cnpj=13481309005192&token=53441345aLwyUpMxAQ96486728"; 
//$url = "https://sintegraws.com.br/api/v1/execute-api.php?token=" . $token . "&cnpj=" . $cnpj . "&plugin=" . $plugin;
    
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_HEADER, false); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch,CURLOPT_TIMEOUT,450); 
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,10); 
$result = curl_exec($ch); 
curl_close($ch); 
//Decodifica o JSON 
$result = @json_decode($result); 
//Verifica se o resultado foi OK 
//if(@$result -> return == "OK" ){ 
//Exibe Razão Social 

echo $result->status."<br>";
echo $result->return;
//
//echo $result->result->nome."<br>";
//echo @$result->result->tipo;

