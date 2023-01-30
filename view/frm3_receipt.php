<!DOCTYPE html>
<?php
session_start();

$num_processo = $_SESSION['num_processo'];

require_once '../inc/Database.php';
require_once '../classes/Receipt.php';

$db = new Database();
$conn = $db->Connect();

$receipt = new Receipt($conn);


    if((isset($_POST) && !empty($_POST))){
        $data = $_POST['data'];
        $valor = $_POST['valor'];
        $pagador = $_POST['pagador'];
        $cnpj_cpf = $_POST['cnpj_cpf'];
        $valor_ex = $_POST['valor_ex'];
        $referente = $_POST['referente'];
        $emissor = $_POST['emissor'];
        $cnpj_cpf_em = $_POST['cnpj_cpf_em'];
        $tel = $_POST['tel'];
        $forma_pag = $_POST['forma_pag'];
        
        $stmt = $receipt->addReceipt($num_processo, $data, $valor, $pagador, $cnpj_cpf, $valor_ex, $referente, $emissor, $cnpj_cpf_em, $tel, $forma_pag);
        
            if($stmt->rowCount() > 0){
                echo "<script>"
                ."alert('Recibo Salvo com sucesso!');"
                        ."location.href='frm4_requerimento.php';"
                . "</script>";
            }
            else{
                echo "<script>"
                ."alert('Falha ao salvar o recibo!');"
                . "</script>";
            }
        
    }


?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chorme=1">
        <meta name="viewport" content="width=device-width, initialscale=1, shrink-to-fit=no">
               
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/process_style.css">
        
    </head>
    <body>
        <div class="header">
            <h1>Recibo</h1>
            <ul class="timeline">
                <li><a href="grid_process.php" title="Voltar para lista de processos"><strong>Lista de Processos|</strong></a> <span class="badge badge-info"></span></li>
                <li><a href="frm1_processo.php">Processo</a> <span class="badge badge-info"></span></li>
                <li><a href="frm2_company.php">Empresa</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Recibo</a> <span class="badge badge-info">3</span></li>
                <li><a href="frm4_requerimento.php">Requerimento</a> <span class="badge badge-info"></span></li>
                <li><a href="frm5_nf.php">Nota Fiscal</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Certidões</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Relação Pacientes</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Contratos</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Produção</a> <span class="badge badge-info"></span></li>
            </ul>
            <h4 align="right">Processo - <?php echo @$num_processo;?></h4>
            <hr>
        </div>
        
        <div class="content-page">
            <div class="container">
                
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-2">
                            <input type="hidden" name="idrecibo" value="">                            
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control" value="">
                        </div>
                        <div class="form-group offset-6 col-md-2">                            
                            <label>Data</label>
                            <input type="date" name="data" class="form-control" value="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-5">
                            <label>Nome do Pagador</label>
                            <input type="text" name="pagador" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label>CNPJ ou CPF</label>
                            <input type="text" name="cnpj_cpf" class="form-control" value="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-10">
                            <label>Importância por Extenso</label>
                            <input type="text" name="valor_ex" class="form-control" value="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-10">
                            <label>Referente à</label>
                            <input type="text" name="referente" class="form-control" value="">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-3">
                            <label>Emissor</label>
                            <input type="text" name="emissor" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label>CNPJ ou CPF</label>
                            <input type="text" name="cnpj_cpf_em" class="form-control" value="">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Telefone</label>
                            <input type="text" name="tel" class="form-control" value="" onkeypress="Mask(this,'## #####-####');">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-3">
                            <label>Forma de Pagamento</label>
                            <select name="forma_pag" id="F_pagamento" class="form-control">
                                <option value="">Selecione uma opção</option>
                                <option value="1">1 - Dinheiro</option>
                                <option value="2">2 - Cheque</option>
                                <option value="3">3 - Transferência/Depósito</option>
                                <option value="4">4 - Cartão de Crédito/Débito</option>
                            </select>
                        </div>                        
                    </div>
                    
                    <div class="form-row control-bar">
                        <div class="form-group offset-1 col-md-10">
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
        
        <script type="text/javascript">
            function Mask(t, mask){
                var i = t.value.length;
                var saida = mask.substring(1,0);
                var texto = mask.substring(i);
                    if(texto.substring(0,1) != saida){
                        t.value += texto.substring(0,1);
                    }
            }
        </script>
                
    </body>
</html>
