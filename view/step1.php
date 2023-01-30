<!DOCTYPE html>
<?php
session_start();

date_default_timezone_set("America/Manaus");

require_once '../inc/Database.php';
require_once '../classes/Process.php';

$db = new Database();
$conn = $db->Connect();

$processo = new Process($conn);

$data = date('d/m/Y');
$hora = date('H:i');

    if(isset($_SESSION['usuario']) && empty($_SESSION['usuario']) == false){
        $usuario = $_SESSION['usuario'];                
        
            if(isset($_POST) && !empty($_POST)){
                $data = date('d/m/Y');
                $hora = date('H:i');
                
                $id_pro = @$_POST['idpro'];
                $num_int = date('dmYHis');
                $num_pro = $_POST['num_pro'];
                $data = $_POST['data'];
                $hora = $_POST['hora'];
                $usuario = $_POST['usuario'];
                $status = $_POST['status'];
                
                if($_POST['idpro'] == ""){
                    // Se o campo idpro estiver vazio, é chamado o método add
                    $stmt = $processo->addProcess($num_int, $num_pro, $data, $hora, $usuario, $status);
                        if($stmt->rowCount() > 0){
                            $_SESSION['processo'] = $num_pro;

                            echo "<script>"
                            ."alert('Abertura de processo realizado com sucesso!');"
                            . "</script>";
                        }
                        else{ 
                            echo "<script>"
                            ."alert('Erro ao fazer abertura do processo!');"
                            . "</script>";
                        }
                }
                else{// se campo idpro não estiver vazio é chamado o método update
                    $stmt = $processo->editProcess($num_int, $num_pro, $data, $hora, $usuario, $status, $id_pro);
                        if($stmt->rowCount() > 0){
                            $_SESSION['processo'] = $num_pro;
                            
                            echo "<script>"
                            ."alert('Processo editado com sucesso!');"
                            . "</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao editar processo!');"
                            . "</script>";                            
                        }
                                        
                }
                
                
            }
            
            if(isset($_SESSION['processo']) && !empty($_SESSION['processo'])){
                $num_pro = $_SESSION['processo'];
                $stmt = $processo->getNumProcess($num_pro);
                    if($stmt->rowCount() > 0){
                        while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                            $id_pro = $row['pro_id'];
                            $pro_numero = $row['pro_numero'];
                            $data = $row['pro_data'];
                            $hora = $row['pro_hora'];
                            $status = $row['pro_status'];
                                if($status == 1){
                                    $desc_status = "1 - Em aberto";
                                }
                                if($status == 2){
                                    $desc_status = "2 - Fechado";
                                }
                                if($status == 3){
                                    $desc_status = "3 - Cancelado";
                                }
                        }
                    }
            }
                    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="Ie=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/material-icons.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/steps_style.css">
        
    </head>
    <body>
        
        <header>
            <ul class="timeline">                
                <li class="active"><span class="badge-pill badge-success">1</span></li>
                <li class="active"><span class="badge-pill badge-light">2</span></li>
                <li class="active"><span class="badge-pill badge-light">3</span></li>
                <li class="active"><span class="badge-pill badge-light">4</span></li>
                <li class="active"><span class="badge-pill badge-light">5</span></li>
                <li class="active"><span class="badge-pill badge-light">6</span></li>
            </ul>
            <br>
            
            <h2>Abertura de Processo</h2>            
            <h4 align="right">Processo: <?php echo @$_SESSION['processo'];?></h4>
            
        </header>
        <div class="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <input type="hidden" name="idpro" value="<?php echo @$id_pro;?>">
                <input type="hidden" name="num_int" value="">
                
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Número do Processo</label>
                        <input type="text" name="num_pro" class="form-control" value="<?php echo @$pro_numero;?>">                        
                    </div>
                    <div class="form-group offset-5 col-md-2">
                        <label>Data</label>
                        <input type="text" name="data" class="form-control" value="<?php echo @$data;?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Hora</label>
                        <input type="text" name="hora" class="form-control" value="<?php echo @$hora;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Usuário</label>
                        <input type="text" name="usuario" class="form-control" value="<?php echo @$_SESSION['usuario'];?>">
                    </div>
                    <div class="form-group offset-4 col-md-4">
                        <label>Status</label>
                        <select name="status" id="Status" class="form-control">
                            <option value="<?php if(isset($_SESSION['processo'])&&!empty($_SESSION['processo'])){
                                echo $status;}else{echo "1";};?>">
                                <?php
                                    if(isset($_SESSION['processo'])&&!empty($_SESSION['processo'])){
                                        echo $desc_status;
                                    }
                                    else{
                                        echo "1 - Em aberto";
                                    }
                                ?>
                            </option>
                            <option value="1">1 - Em aberto</option>
                            <option value="2">2 - Fechado</option>
                            <option value="3">3 - Cancelado</option>
                        </select>
                    </div>
                </div>
                
                <div class="control_bar form-row">                    
                    <div class="col-md">
                        <hr>
                        <a href="grid_process.php" class="btn btn-light" title="Voltar" style="float: left;"><i class="material-icons">keyboard_arrow_left</i> Voltar</a>
                        <button type="submit" class="btn btn-success" title="Salvar"><i class="material-icons">save</i> Salvar</button>
                        <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar</button>
                        <a href="step2.php" class="btn btn-secondary" title="Continuar"><i class="material-icons">keyboard_arrow_right</i>Continuar</a>
                    </div>
                </div>
                
            </form>
            
            
        </div>
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html


<?php
    }
    else{
        header("location:frm_login.php");        
    }
?>
