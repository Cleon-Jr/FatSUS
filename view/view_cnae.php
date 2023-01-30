<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();

$cnae = new Cnae($conn);

$cnae_id = $_GET['id_cnae'];

    $stmt = $cnae->getIDCnae($cnae_id);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                $num_cnae = $row['num_cnae'];
                $desc_cnae = $row['desc_cnae'];
            }
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/view_style.css">
        
    </head>
    <body>
        
        <div class="content-page">
            <h4>CNAE: <?php echo @$num_cnae;?></h4>
            <hr>
            
            <div class="container">
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>ID</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$cnae_id;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>Nº CNAE</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$num_cnae;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>Descrição</label>  
                    </div>
                    <div class="form-group col-md-8 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$desc_cnae;?>">
                    </div>
                </div>                                
                <hr>
                <div class="form-row" id="bar-control">
                    <div class="form-group col-md-4 badge-light">

                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <a href="frm_cnae.php?id_cnae=<?php echo $cnae_id;?>" class="btn btn-warning" title="Editar CNAE"><i class="material-icons">edit</i> Editar</a>
                        <a href="#" class="btn btn-light" title="Voltar" onclick="javascript:history.go(-1);"><i class="material-icons">arrow_back</i> Voltar</a>
                    </div>
                </div>
                
            </div>
        </div>
        
        
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>
