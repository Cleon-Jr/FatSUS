<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/User.php';

$db = new Database();
$conn = $db->Connect();

$user = new User($conn);


    if((isset($_GET['iduser']))&&(!empty($_GET['iduser']))){
        if($_GET['iduser'] != 0){
            $title_page = "Editando Usuário";
            
            $id = $_GET['iduser'];
            
            $stmt = $user->getID($id);
            
                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                        $id = $row['use_id'];
                        $nome = $row['use_nome'];
                        $cpf = $row['use_cpf'];
                        $cns = $row['use_cns'];
                        $setor = $row['use_setor'];
                        $email = $row['use_email'];
                        //$senha = $row['use_senha'];
                    }
                }
            }
            else{
                $title_page = "Adicionando Usuário";                
            }        
    }    
    
        if(!empty($_POST)){
            $id = $_POST['H_id'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $cns = $_POST['cns'];
            $setor = $_POST['setor'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            // Se o ID contiver valor, entrará na condição para edição de registro
            if(!empty($id)){
                // Se o campo senha contiver valor, o registro será editado, incluindo este campo (senha)
                if(!empty($senha)){
                    // Chamada do método update com alteração da senha
                    $stmt = $user->updateIDfull($id, $nome, $cpf, $cns, $setor, $email, $senha);
                
                        if($stmt){
                            echo "<script>"
                            ."alert('Usuário editado com sucesso!');"
                            ."location.href='grid_user.php';"
                            ."</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao tentar salvar as alterações!');"
                            ."location.href='grid_user.php';"
                            . "</script>";

                        }
                }
                else{
                    //Se o campo senha estiver vazio, será chamado o método para edição sem o campo senha
                    // Chamada do método update sem alteração da senha
                    $stmt = $user->updateIDoffPass($id, $nome, $cpf, $cns, $setor, $email);

                        if($stmt){
                            echo "<script>"
                            ."alert('Usuário editado com sucesso!');"
                            ."location.href='grid_user.php';"
                            ."</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao tentar salvar as alterações!');"
                            ."location.href='grid_user.php';"
                            . "</script>";
                        }

                    }
                
            }
            else{
                //Senão, se o ID estiver vazio, entrará na condição de insert
                // Método insert
                $stmt = $user->addUser($nome,$cpf,$cns,$setor,$email,$senha);
                
                    if($stmt){
                        echo "<script>"
                        ."alert('Usuário adicionado com sucesso!');"
                        ."location.href='grid_user.php';"
                        . "</script>";
                    }
                    else{
                        echo "<script>"
                        ."alert('Erro ao tentar adicionar usuário!');"
                        ."location.href='grid_user.php';"
                        . "</script>";
                    }
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
        <link rel="stylesheet" href="../assets/css/frm_style.css">
        
    </head>
    <body>
        <div class="content-page">
            <div class="container">
            <h4 align="right"><?php echo @$title_page;?></h4>
            <hr>
            
            <!-- form -->            
            <form action="frm_user.php" method="post"> 
                
<!--                <div class="form-row">-->
<!--                    <div class="form-group col-md-1">
                        <label>ID</label>-->
                        <input type="hidden" name="H_id" value="<?php echo @$id;?>">
<!--                        <input type="text" name="id" class="form-control" value="<?php echo @$id;?>" disabled="">-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Nome Completo</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo @$nome;?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>CPF</label>
                        <input type="text" name="cpf" class="form-control" value="<?php echo @$cpf;?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label>CNS</label>
                        <input type="text" name="cns" class="form-control" value="<?php echo @$cns;?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Setor</label>
                        <input type="text" name="setor" class="form-control" value="<?php echo @$setor;?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>e-mail</label>
                        <input type="text" name="email" class="form-control" value="<?php echo @$email;?>">
                    </div>                
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Senha de Acesso</label>
                        <input type="text" name="senha" id="senha" class="form-control" value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Confirmar Senha</label>
                        <input type="text" name="conf_senha" id="conf_senha" class="form-control" value="" onblur="equalPass();">
                    </div>
                </div>
                <hr>
                <!-- button -->
                <div class="control-bar">
                    <button type="submit" class="btn btn-success" title="Salvar Usuário"><i class="material-icons">save</i> Salvar</button>
                    <button type="reset" class="btn btn-light" title="Cancelar" onclick="javascript:history.go(-1);"><i class="material-icons">clear</i> Cancelar</button>
                </div>
            
            </form>
            
            </div>
            
        </div>
        
        
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Java script para conparação da senha -->
        <script type="text/javascript">
            function equalPass(){
                var vl1 = document.getElementById('senha').value;
                var vl2 = document.getElementById('conf_senha').value;
                
                    if(vl1 != vl2){
                        alert('Comparação de senha inválida. Tente novamente!');
                        document.getElementById('senha').value = "";
                        document.getElementById('conf_senha').value = "";
                        document.getElementById('senha').focus();
                    }
            }            
        </script>
    </body>
</html>
