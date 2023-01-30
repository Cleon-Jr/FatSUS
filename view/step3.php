<!DOCTYPE html>
<?php
session_start();

date_default_timezone_set("America/Manaus");

require_once '../inc/Database.php';
require_once '../classes/Company.php';
require_once '../classes/Receipt.php';


    if(isset($_SESSION['usuario']) && empty($_SESSION['usuario']) == false){
        
        $db = new Database();
        $conn = $db->Connect();
        
        $recibo = new Receipt($conn);
        
        if(isset($_SESSION['processo']) && !empty($_SESSION['processo'])){
            $num_processo = $_SESSION['processo'];
        
        
            $company = new Company($conn);
            $stmt_comp = $company->getCompanyProcess($num_processo);
                if($stmt_comp->rowCount() > 0){
                    while($row_comp = $stmt_comp->fetch(pdo::FETCH_ASSOC)){
                        $cep = $row_comp['com_cep'];
                        $rua = $row_comp['com_rua'];
                        $num = $row_comp['com_numero'];
                        $bairro = $row_comp['com_bairro'];
                        $tels = $row_comp['com_tel1']." | ".$row_comp['com_tel2'];
                        $email = $row_comp['com_email'];
                        $cidade = $row_comp['com_cidade']."-".$row_comp['com_uf'];                    
                        $logomarca = $row_comp['logo'];
                    }
                }
                
            $stmt_rec = $recibo->getReceiptProcess($num_processo);
                if($stmt_rec->rowCount() > 0){
                    while($row = $stmt_rec->fetch(pdo::FETCH_ASSOC)){
                        $rec_id = $row['rec_id'];
                        $valor = $row['rec_valor'];
                        $data = $row['rec_data'];
                        $pagador = $row['rec_pagador'];
                        $cnpj_cpf_pag = $row['rec_cnpj_cpf'];
                        $importancia = $row['rec_valor_ex'];
                        $referencia = $row['rec_referente'];
                        $emissor = $row['rec_emissor'];
                        $cnpj_cpf_emiss = $row['rec_cnpj_cpf_em'];
                        $tel = $row['rec_tel'];
                        $forma_pag = $row['rec_forma_pag'];
                    }
                }
        }
        
        if(isset($_POST) && !empty($_POST)){
            $rec_id = @$_POST['recid'];
            
            $valor = $_POST['valor'];
            $data = $_POST['data'];
            $pagador = $_POST['pagador'];
            $cnpj_cpf_pag = $_POST['cnpj_cpf_pag'];
            $importancia = $_POST['importancia'];
            $referencia = $_POST['referencia'];
            $emissor = $_POST['emissor'];
            $cnpj_cpf_emiss = $_POST['cnpj_cpf_emiss'];
            $tel = $_POST['tel'];
            $forma_pag = $_POST['forma_pag'];
        
        
            if($_POST['recid'] == ""){
                $stmt_rec = $recibo->addReceipt($num_processo, $data, $valor, $pagador, $cnpj_cpf_pag, $importancia, $referencia, $emissor, $cnpj_cpf_emiss, $tel, $forma_pag);
                    if($stmt_rec->rowCount() > 0){
                        echo "<script>"
                        ."alert('Recibo registrado com sucesso!');"
                                ."location.href='step3.php';"
                        . "</script>";
                    }
                    else{
                        echo "<script>"
                        ."alert('Falha ao registrar recibo!');"                                
                        . "</script>";
                    }
            }
            else{
                $stmt_rec = $recibo->editRecepit($data, $valor, $pagador, $cnpj_cpf_pag, $importancia, $referencia, $emissor, $cnpj_cpf_emiss, $tel, $forma_pag, $rec_id);
                    if($stmt_rec->rowCount() > 0){
                        echo "<script>"
                        ."alert('Recibo editado com sucesso!');"
                                ."location.href='step3.php';"
                        . "</script>";                        
                    }
                    else{
                        echo "<script>"
                        ."alert('Falha ao editar recibo!');"                                
                        . "</script>";                        
                    }
                
            }
        }
        
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/steps_style.css">
        
    </head>
    <body>
        
        <header>
            <ul class="timeline">                
                <li class="active"><span class="badge-pill badge-success">1</span></li>
                <li class="active"><span class="badge-pill badge-success">2</span></li>
                <li class="active"><span class="badge-pill badge-success">3</span></li>
                <li class="active"><span class="badge-pill badge-light">4</span></li>
                <li class="active"><span class="badge-pill badge-light">5</span></li>
                <li class="active"><span class="badge-pill badge-light">6</span></li>
            </ul>
            <br>
            
            <h2>Recibo</h2>            
            <h4 align="right">Processo: <?php echo @$_SESSION['processo'];?></h4>
        </header>
        
        <div class="container">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <fieldset id="fieldset">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <div class="logo"><img class="img-thumbnail" src="../upload/logos/<?php echo @$logomarca;?>"></div>
                        </div>
                        <div class="form-group offset-4 col-md-5">
                            <div class="endereco" align='right'>
                                <p><?php echo @$rua.", nº ".@$num." - ".@$bairro;?><br>
                                    <?php echo "Contato: ".@$tels;?><br>
                                    <?php echo "E-mail: ".@$email;?><br>
                                    <?php echo "CEP: ".@$cep." - ".@$cidade;?></p>
                            </div>
                            <hr>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input type="hidden" name="recid" value="<?php echo @$rec_id;?>">
                            <label>Valor</label>
                            <input type="text" name="valor" class="form-control" value="<?php echo @$valor;?>">
                        </div>
                        <div class="form-group offset-8 col-md-2">
                            <label>Data</label>
                            <input type="date" name="data" class="form-control" value="<?php echo @$data;?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Pagador</label>
                            <input type="text" name="pagador" class="form-control" value="<?php echo @$pagador;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>CNPJ/CPF</label>
                            <input type="text" name="cnpj_cpf_pag" class="form-control" value="<?php echo @$cnpj_cpf_pag;?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label>Importância por Extenso</label>
                            <input type="text" name="importancia" class="form-control" value="<?php echo @$importancia;?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md">
                            <label>Referente à</label>
                            <input type="text" name="referencia" class="form-control" value="<?php echo @$referencia;?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label>Emissor</label>
                            <input type="text" name="emissor" class="form-control" value="<?php echo @$emissor;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>CNPJ/CPF</label>
                            <input type="text" name="cnpj_cpf_emiss" class="form-control" value="<?php echo @$cnpj_cpf_emiss;?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Telefone</label>
                            <input type="text" name="tel" class="form-control" value="<?php echo @$tel;?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Forma de Pagamento</label>
                            <select name="forma_pag" id="formaPag" class="form-control">
                                <option value="<?php echo @$forma_pag;?>"><?php
                                    if(@$forma_pag == 1){
                                        echo "1 - Empenho";
                                    }
                                    if(@$forma_pag == 2){
                                        echo "2 - Dinheiro";
                                    }
                                    if(@$forma_pag == 3){
                                        echo "3 - Transferência/Depósito";
                                    }
                                    if(@$forma_pag == 4){
                                        echo "4 - Cartão de Crédito/Débito";
                                    }                                    
                                ?></option>
                                <option value="1">1 - Empenho</option>
                                <option value="2">2 - Dinheiro</option>
                                <option value="3">3 - Cheque</option>
                                <option value="4">4 - Transferência/Depósito</option>
                                <option value="5">5 - Cartão de Crédito/Débito</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group offset-7 col-md-5">
                            <br><br>                           
                            <h6 align="center">Assinatura</h6>
                        </div>
                    </div>
                    
                </fieldset>
                <div class="control_bar form-row">
                    <div class="col-md">
                        <a href="step1.php" class="btn btn-light" title="Voltar" style="float: left;"><i class="material-icons">keyboard_arrow_left</i> Voltar</a>
                        <button type="button" class="btn btn-secondary" title="Imprimir/Salvar PDF"><i class="material-icons">picture_as_pdf</i> Imprimir</button>
                        <button type="submit" class="btn btn-success" title="Salvar"><i class="material-icons">save</i> Salvar</button>
                        <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar</button>
                        <a href="step4.php" class="btn btn-secondary" title="Continuar"><i class="material-icons">keyboard_arrow_right</i>Continuar</a>
                    </div>
                </div>
                <br>
            </form>            
        </div>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>

<?php
    }
    else{
        header("location:frm_login.php");
    }
?>
