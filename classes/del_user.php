<?php
require_once '../inc/Database.php';
require_once '../classes/User.php';


$db = new Database();
$conn = $db->Connect();

$user = new User($conn);

    
    $id = $_GET['id'];
    echo "Enviando o ID: ".$id;
    
    
    $stmt = $user->delUser($id);
    
        if($stmt){
            header("location: ../view/grid_user.php?action=deleted");
        }
        else{
            header("location: ../view/grid_user.php?action=nodeleted");
        }
    
        
?>
