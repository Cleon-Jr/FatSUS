<?php

require_once '../inc/Database.php';
require_once '../classes/Cidades.php';

/*$db = new Database();
$conn = $db->Connect();

$id = $_POST['id'];

$cidade = new Cidades($conn);

    $stmt = $cidade->getIdCidades($id);
        if($stmt){
            echo "<option>Escolha uma cidade</option>";
            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){                
                echo "<option value='{$row['nome']}'>{$row['nome']}</option>";
                echo $row['nome'];
            }
            
        }
        else{
            echo "Error";
        }*/


if($_POST['cep']){
    echo $_POST['cep'];
}