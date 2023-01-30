<!DOCTYPE html>
<?php
session_start();

$usuario = $_SESSION['usuario'];

require_once '../inc/Database.php';
require_once '../classes/Process.php';

$db = new Database();
$conn = $db->Connect();

$processo = new Process($conn);
date_default_timezone_set("America/Manaus");

$data = date('d/m/Y');
$hora = date('H:i');
$numi = date('dmYHis');

    if((isset($_POST) && !empty($_POST))){        
        $numi = $_POST['numi'];
        $num_processo = $_POST['numpro'];
        $data = $_POST['data'];
        $hora = $_POST['hora'];
        $user = $_POST['usuario'];
        $status = $_POST['status'];
        
        $_SESSION['num_processo'] = $num_processo;
        
        
        $stmt = $processo->addProcess($numi, $num_processo, $data, $hora, $user, $status);
        
            if($stmt->rowCount() > 0){
                echo "<script>"
                ."alert('Abertura de Processo realizado com sucesso!');"
                        ."location.href='frm2_company.php';"
                ."</script>";
                    
            }
            else{
                echo "<script>"
                ."alert('Falha na abertura de processo!');"
                . "</script>";
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
        <link rel="stylesheet" href="../assets/css/process_style.css">
        
    </head>
    <body>
        <div class="header">
            <h1>Abertura de Processo</h1>
            <ul class="timeline">
                <li><a href="grid_process.php" title="Voltar para lista de processos"><strong>Lista de Processos|</strong></a> <span class="badge badge-info"></span></li>
                <li><a href="#">Processo</a> <span class="badge badge-info">1</span></li>
                <li><a href="frm2_company.php">Empresa</a> <span class="badge badge-info"></span></li>
                <li><a href="frm3_receipt.php">Recibo</a> <span class="badge badge-info"></span></li>
                <li><a href="frm4_requerimento.php">Requerimento</a> <span class="badge badge-info"></span></li>
                <li><a href="frm5_nf.php">Nota Fiscal</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Certidões</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Relação Pacientes</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Contratos</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Produção</a> <span class="badge badge-info"></span></li>
            </ul>
            <hr>
        </div>
        
        <div class="content-page">
            <div class="container">
                
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input type="hidden" name="idpro" value="">
                            <input type="hidden" name="numi" value="<?php echo @$numi;?>">
                            <label>Número do Processo</label>
                            <input type="text" name="numpro" class="form-control" value="">
                        </div>
                        <div class="form-group offset-4 col-md-2">
                            <label>Data</label>
                            <input type="text" name="data" class="form-control" value="<?php echo @$data;?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Hora</label>
                            <input type="text" name="hora" class="form-control" value="<?php echo @$hora;?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Usuário</label>
                            <input type="text" name="usuario" class="form-control" value="<?php echo @$usuario;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Status</label>
                            <select name="status" id="combobox" class="form-control">
                                <option value="">Selecione uma opção...</option>
                                <option value="1">1 - Em aberto</option>
                                <option value="2">2 - Fechado</option>
                                <option value="3">3 - Cancelado</option>                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row control-bar">
                        <div class="form-group col-md-10">
                            <hr>
                            <button type="submit" class="btn btn-success" title="Salvar e avançar">Avançar >></button>
                            <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
