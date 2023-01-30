<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/User.php';

$db = new Database();
$conn = $db->Connect();

$user = new User($conn);

    // Mensagem de confirmação da exclusão
    if((isset($_GET['action']))&&(!empty($_GET['action']))){
        $action = $_GET['action'];       
            if($action == "deleted"){
                $msg = "<div class='alert-success'>Usuário excluído com sucesso!</div>";
            }
            if($action == "nodeleted"){
                $msg = "<div class='alert-danger'>Erro ao tentar excluir!</div>";
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
        <link rel="stylesheet" href="../assets/css/grid_style.css">        
                
    </head>
    <body>
        <div class="content-page">
            <h4 align="right">Usuários Cadastrados</h4>
            <hr>
            
            <div class="container-fluid">
                <!-- button -->
                <a href="frm_user.php?iduser='0'" class="btn btn-success" title="Adicionar usuário"><i class="material-icons">note_add</i>Adicionar</a>
                
                <!-- Barra de mensagens -->                                
                    <?php 
                        echo @$msg;
                    ?>
                
                <!-- table -->
                <table class="table table-hover table-bordered">
                    <tr id="tb_head">
                        <td align="center">ID</td>
                        <td>Nome</td>
                        <td>CPF</td>
                        <td>Setor</td>
                        <td>E-mail</td>
                        <td colspan="3" align="center">Ações</td>
                    </tr>
                    <?php
                        $stmt = $user->getAll();
                        
                            if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                                
                            
                    ?>
                    <tr>
                        <td align="center"><?php echo $row['use_id'];?></td>                        
                        <td><?php echo $row['use_nome'];?></td>
                        <td><?php echo $row['use_cpf'];?></td>
                        <td><?php echo $row['use_setor'];?></td>
                        <td><?php echo $row['use_email'];?></td>
                        <td align="center" width="120"><a href="view_user.php?iduser=<?php echo $row['use_id'];?>" class="btn btn-info" title="Visualizar"><i class="material-icons">visibility</i></a></td>
                        <td align="center" width="120"><a href="frm_user.php?iduser=<?php echo $row['use_id'];?>" class="btn btn-warning" title="Editar"><i class="material-icons">edit</i></a></td>
                        <td align="center" width="120"><a href="#" onclick="delete_user('<?php echo $row['use_id'];?>')" class="btn btn-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
                    </tr>
                    <?php
                            }
                        }                    
                    ?>
                    <tr id="status">
                        <td colspan="5"></td>
                        <td colspan="3" align="right"><strong><?php echo "Nº de usuários cadastrados: ".$stmt->rowCount();?></strong></td>
                    </tr>
                </table>
                
            </div>
        </div>
        <?php
        // Chamada do método disconnect
                    $disconnect = $db->Disconnect();
        ?>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            function delete_user(id){
                var answer = cofirm('Tem certeza que deseja excluir este usuário?');
                    if(answer){
                        window.location = '../classes/del_usuario.php=' + id;
                    }
            }
        </script>
    </body>
</html>
