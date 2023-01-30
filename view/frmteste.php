<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Company.php';

$db = new Database();
$conn = $db->Connect();

$com = new Company($conn);

    if(isset($_POST['salvar'])&& !empty($_POST['salvar'])){
        $fantasia = @$_POST['fantasia'];
        $socios = @$_POST['socios'];
        
       
        $stmt = $com->addCompany($fantasia, $socios);
            if($stmt){
                echo "Adicionado com sucesso!";
            }
            else{
                echo "Erro.";
            }
    }
    
    if(isset($_GET['action'])== "mostrar"){
        $stmt = $com->getID(3);
        
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                    $fantasia = $row['emp_fantasia'];
                    $socios = $row['emp_socios'];
                    $soc = explode(",", $socios);
                }
            }
    }
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="frmteste.php" method="post">
            <label>Nome fantasia</label>
            <input type="text" name="fantasia" value="<?php echo @$fantasia;?>">
            <br>
            <label>Sócios</label>
            <input type="text" name="socios" value="<?php echo @$soc[];?>" size="100">
            <input type="submit" name="salvar" value="Salvar">
            <a href="frmteste.php?action=mostrar">Mostrar</a>
        </form>
    </body>
</html>
