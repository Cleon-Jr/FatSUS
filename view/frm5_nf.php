<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
            <h1>Nota Fiscal</h1>
            <ul class="timeline">
                <li><a href="grid_process.php" title="Voltar para lista de processos"><strong>Lista de Processos|</strong></a> <span class="badge badge-info"></span></li>
                <li><a href="#">Processo</a> <span class="badge badge-info"></span></li>
                <li><a href="frm2_company.php">Empresa</a> <span class="badge badge-info"></span></li>
                <li><a href="frm3_receipt.php">Recibo</a> <span class="badge badge-info"></span></li>
                <li><a href="frm4_requerimento.php">Requerimento</a> <span class="badge badge-info"></span></li>
                <li><a href="#">Nota Fiscal</a> <span class="badge badge-info">5</span></li>
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
                        <div class="form-group offset-1 col-md-3">
                            <label>Número da Nota</label>
                            <input type="text" name="num_nf" class="form-control" value="">                        
                        </div>                    
                        <div class="form-group offset-4 col-md-2">
                            <label>Data</label>
                            <input type="date" name="data" class="form-control" value="">                        
                        </div>                    
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group offset-1 col-md-8">
                            <label>Valor por Extenso</label>
                            <input type="text" name="valor_ex" class="form-control" value="">
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
