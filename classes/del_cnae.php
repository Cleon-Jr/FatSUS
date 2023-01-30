<?php

require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();

$cnae = new Cnae($conn);

$id_cnae = $_GET['id_cnae'];

    $stmt = $cnae->delCNAE($id_cnae);
        
        if($stmt){
            header("location: ../view/grid_cnae.php?action=deleted");
        }
        else{
            header("location: ../view/grid_cnae.php?action=nodeleted");
        }
