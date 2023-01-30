<?php
session_start();

require_once '../inc/Database.php';

    if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
        
        $db = new Database();
        $conn = $db->Connect();
        
        
        if($_FILES["file"]["name"] != ""){
            $arq = explode(".", $_FILES["file"]["name"]);
        
            $extension = end($arq);
            $name_arq = $_SESSION['process_number']."_nfe.".$extension;
            $location = "../assets/uploads/nfe/".$name_arq;
            
            //move_uploaded_file($_FILES["file"]["tmp_name"], $location); 
            
            echo $name_arq;
            
        }
        
    }
    else{
        header("location:../view/frm_login.php");
    }

    