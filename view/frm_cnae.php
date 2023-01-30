<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();

$cnae = new Cnae($conn);

    if((isset($_GET['id_cnae'])) && !empty($_GET['id_cnae'])){
        if($_GET['id_cnae'] != 0){
            $title_page = "Editando CNAE...";
            
            $id_cnae = $_GET['id_cnae'];
            
            $stmt = $cnae->getIDCnae($id_cnae);
                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                        $idcnae = $row['id'];
                        $num = $row['num_cnae'];
                        $desc = $row['desc_cnae'];
                    }
                }
        }
        else{
            $title_page = "Adicionando CNAE...";
        }
    }
    
    
        if(!empty($_POST)){
            $id_cnae = $_POST['h_idcnae'];
            $num_cnae = $_POST['n_cnae'];
            $desc_cnae = $_POST['descricao'];            
            
                if(!empty($id_cnae)){
                    // se ID não estiver vazio, entrar no modo de edição
                    $stmt = $cnae->editCNAE($num_cnae, $desc_cnae, $id_cnae);
                        if($stmt){
                            echo "<script>"
                            ."alert('Alterações salvas com sucesso!');"
                            ."location.href='grid_cnae.php';"
                            . "</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao tentar salvar alterações!');"
                            ."location.href='grid_cnae.php';"
                            . "</script>";
                        }
                }
                else{
                    // senão, condição para inserção
                    $stmt = $cnae->addCNAE($num_cnae, $desc_cnae);
                        if($stmt){
                            echo "<script>"
                            ."alert('CNAE adicionado com sucesso!');"
                            ."location.href='grid_cnae.php';"
                            . "</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao tentar adicionar CNAE!');"
                            ."location.href='grid_cnae.php';"
                            . "</script>";
                        }
                }
        }


?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/frm_style.css">
        
    </head>
    <body>
        
        <div class="content-page">
            <h4 align="right"><?php echo @$title_page;?></h4>
            <hr>
            
            <form method="post">
                
                <div class="form-row">
                    <div class="form-group col-md-1">
                        <label>ID</label>
                        <input type="hidden" name="h_idcnae" value="<?php echo @$idcnae;?>">
                        <input type="text" name="id" class="form-control" value="<?php echo @$idcnae;?>" disabled="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Nº CNAE</label>
                        <input type="text" name="n_cnae" class="form-control" value="<?php echo @$num;?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label>Descrição</label>
                        <input type="text" name="descricao" class="form-control" value="<?php echo @$desc;?>">
                    </div>
                </div>
                <hr>
                <div class="control-bar">
                    <button type="submit" class="btn btn-success" title="Salvar"><i class="material-icons">save</i> Salvar</button>
                    <button type="reset" class="btn btn-light" title="Cancelar" onclick="javascript:history.go(-1);"><i class="material-icons">clear</i> Cancelar</button>
                </div>
            </form>
            
        </div>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
                
    </body>
</html>
