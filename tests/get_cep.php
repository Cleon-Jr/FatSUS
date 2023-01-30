<?php

    if($_POST['cep']){
        $cep = $_POST['cep'];
    }
    
    function get_endereco($cep){
    
    $cep = preg_replace("/[^0-9]/", "", $cep);
    $url = "http://viacep.com.br/ws/$cep/xml/";

    $xml = simplexml_load_file($url);
    echo $xml;
    
    }  
    
    
    
     

