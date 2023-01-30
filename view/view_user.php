<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/User.php';

$db = new Database();
$conn = $db->Connect();

$user = new User($conn);

$id = $_GET['iduser'];

    $stmt = $user->getID($id);
        if($stmt){
            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                $id = $row['use_id'];
                $nome = $row['use_nome'];
                $cpf = $row['use_cpf'];
                $cns = $row['use_cns'];
                $setor = $row['use_setor'];
                $email = $row['use_email'];
            }
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initia-scale=1, shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/view_style.css">
        
    </head>
    <body>
        <div class="content-page">
            <h4>Usuário: <?php echo @$nome;?></h4>
            <hr>
            
            <div class="container">
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>ID</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$id;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>Nome</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$nome;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>CPF</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$cpf;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>CNS</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$cns;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>Setor</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$setor;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4 badge-light">
                        <label>E-mail</label>  
                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <input class="form-control-plaintext" value="<?php echo @$email;?>">
                    </div>
                </div>
                <hr>
                <div class="form-row" id="bar-control">
                    <div class="form-group col-md-4 badge-light">

                    </div>
                    <div class="form-group col-md-5 badge-light">
                        <a href="frm_user.php?iduser=<?php echo $id;?>" class="btn btn-warning" title="Editar usuário"><i class="material-icons">edit</i> Editar</a>
                        <a href="#" class="btn btn-light" title="Voltar" onclick="javascript:history.go(-1);"><i class="material-icons">arrow_back</i> Voltar</a>
                    </div>
                </div>
                
            </div>
        </div>
        
        
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>
