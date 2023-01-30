<!DOCTYPE html>
<?php
session_start();

//$num_processo = $_SESSION['num_processo'];
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
        <link rel="stylesheet" href="uploadfilemulti.css">
                
        
    </head>
    <body>
        <div class="header">
            <h1>Requerimento</h1>
            <ul class="timeline">
                <li><a href="grid_process.php" title="Voltar para lista de processos"><strong>Lista de Processos|</strong></a> <span class="badge badge-info"></span></li>
                <li><a href="frm1_processo.php">Processo</a> <span class="badge badge-info"></span></li>
                <li><a href="frm2_company.php">Empresa</a> <span class="badge badge-info"></span></li>
                <li><a href="frm3_receipt.php">Recibo</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Requerimento</a> <span class="badge badge-info">4</span></li>
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
                <form>
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-5">
                            <label>Mês de Competência Conforme Nota Fiscal</label>
                            <select id="Mes" name="mes" class="form-control">
                                <option value="">Selecione uma opção...</option>
                                <option value="1">1 - Janeiro</option>
                                <option value="2">2 - Fevereiro</option>
                                <option value="3">3 - Março</option>
                                <option value="4">4 - Abril</option>
                                <option value="5">5 - Maio</option>
                                <option value="6">6 - Junho</option>
                                <option value="7">7 - Julho</option>
                                <option value="8">8 - Agosto</option>
                                <option value="9">9 - Setembro</option>
                                <option value="10">10 - Outubro</option>
                                <option value="11">11 - Novembro</option>
                                <option value="12">12 - Dezembro</option>                                
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
    </body>
</html>
