<!DOCTYPE html>
<?php
session_start();

require_once '../inc/Database.php';
require_once '../classes/User.php';

$db = new Database();
$conn = $db->Connect();

$user = new User($conn);

    if(isset($_POST['usuario']) && empty($_POST['usuario']) == false){
        $email = addslashes($_POST['usuario']);
        $senha = addslashes($_POST['senha']);
        
        
        
        $stmt = $user->loginUser($email, $senha);
            
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                    $iduser = $row['use_id'];
                    $nome = $row['use_nome'];      
                    $cns = $row['use_cns'];
                    $setor = $row['use_setor'];
                    
                    $_SESSION['iduser'] = $iduser;
                    $_SESSION['usuario'] = $nome;
                    $_SESSION['cns'] = $cns;
                    $_SESSION['setor'] = $setor;
                    
                    
                    echo "<script>"
                    ."alert('Seja bem vindo(a), {$nome}!');"                    
                    ."location.href='../';"
                    . "</script>";
                }
            }
            else{
                echo "<script>"
                ."alert('Usuário inválido!');"                        
                . "</script>";
                
            }
        
        
    }   
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">
        <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
                
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/login_style.css">
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                
                <div class="col-md">
                    
                    <div class="box">
                        <img class="img-fluid" src="../assets/images/user2.png">
                        <br>
                        <h3 align="center">Login</h3>
                        <form action="frm_login.php" method="post" onsubmit="return validField(this);">
                                                        
                            <div class="form-group">
                                <input type="text" name="usuario" class="form-control" value="">
                                <label for="usuario">Seu E-mail</label>                                
                            </div>                                
                            <div class="form-group">
                                <input type="password" name="senha" class="form-control" value="">
                                <label for="senha">Senha</label>
                            </div>
                            <div class="form-group">                                
                                <button type="submit" class="btn btn-block">Entrar</button>
                                <br>
                                <a href="#">Recuperação de senha.</a>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>        
                        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            function validField(frm){
                if(frm.usuario.value == ""){
                    alert('Informe o seu E-mail para efetuar o login!');
                    frm.usuario.focus();
                    return false;
                }
                if(frm.senha.value == ""){
                    alert('Insira sua senha!');
                    frm.senha.focus();
                    return false;
                }
                return true;
            }
        </script>
        
    </body>
</html>
