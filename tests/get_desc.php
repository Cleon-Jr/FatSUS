<?php

require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();

$cnae = new Cnae($conn);

$num_cnae = $_POST['ncnae'];

$stmt = $cnae->getNumCnae($num_cnae);

    while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
        //echo $row['desc_cnae'];
        
    }