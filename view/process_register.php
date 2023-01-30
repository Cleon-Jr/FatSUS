<!DOCTYPE html>
<?php
session_start();

date_default_timezone_set("America/Manaus");

require_once '../inc/Database.php';
require_once '../classes/Process.php';
require_once '../classes/Company.php';
require_once '../classes/Receipt.php';


    if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
        
        $db = new Database();
        $conn = $db->Connect();
        
        $processo = new Process($conn);        
        $company = new Company($conn);
        $recibo = new Receipt($conn);
        
        
        
        $usuario = $_SESSION['usuario'];
        $hora = date('h:i');
        $data_reg = date('d/m/Y');
        
        //Carregamentos ///////////////////////////////////////////////////////////////////////////////
        //Se houver a session com o número do processo, carrega-se este processo para pouplar os campos
        if(isset($_SESSION['process_number']) && !empty($_SESSION['process_number'])){
            $process_number = $_SESSION['process_number'];
            //Carregando as informações de processo
            $stmt = $processo->getNumProcess($process_number);
                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                        @$pro_numero = $row['pro_numero'];
                        @$data_reg = $row['pro_data'];
                        @$hora = $row['pro_hora'];
                        @$usuario = $row['pro_user'];
                        @$pro_com_cnpj = $row['pro_com_cnpj'];
                        @$com_cnpj = @$pro_com_cnpj;
                            if($row['pro_status'] == 1){
                                $status = "1 - Em aberto";
                            }
                            if($row['pro_status'] == 2){
                                $status = "2 - Concluído";
                            }
                            if($row['pro_status'] == 3){
                                $status = "3 - Cancelado";
                            }
                    }
                }               
                
            //Carregando as informações da empresa
                $stmt = $company->getCNPJ($com_cnpj);
                    if($stmt->rowCount() > 0){
                        while($row_comp = $stmt->fetch(pdo::FETCH_ASSOC)){
                            
                            $com_id = $row_comp['com_id'];
                            $com_cnpj = $row_comp['com_cnpj'];
                            $com_logo = $row_comp['com_logo'];
                            $com_razao = $row_comp['com_razao'];
                            $com_fantasia = $row_comp['com_fantasia'];
                            $com_dtabertura = $row_comp['com_dtabertura'];
                            $com_ies = $row_comp['com_ies'];
                            $com_nat_jur = $row_comp['com_natjur'];
                            $com_cnae = $row_comp['com_cnae'];
                            $com_atividade_p = $row_comp['com_atv_principal'];
                            $com_atividade_s = $row_comp['com_atv_secundaria'];
                            $com_cep = $row_comp['com_cep'];
                            $com_rua = $row_comp['com_logradouro'];
                            $com_num = $row_comp['com_num'];
                            $com_complemento = $row_comp['com_complemento'];
                            $com_bairro = $row_comp['com_bairro'];
                            $com_cidade = $row_comp['com_cidade'];
                            $com_uf = $row_comp['com_uf'];
                            $com_tel1 = $row_comp['com_tel1'];
                            $com_tel2 = $row_comp['com_tel2'];
                            $com_email = $row_comp['com_email'];
                            $com_site = $row_comp['com_site'];
                            $com_obs = $row_comp['com_obs'];
                            $com_situacao = $row_comp['com_situacao'];
                            $com_dtsituacao = $row_comp['com_dtsituacao'];
                            $com_motivo_situacao = $row_comp['com_motivo_situacao'];
                            $com_situacao_especial = $row_comp['com_situacao_especial'];
                            $com_dtsituacao_especial = $row_comp['com_dtsituacao_especial'];
                            $com_capital_social = $row_comp['com_capital_social'];
                            $com_qsa = $row_comp['com_qsa'];
                                if($row_comp['flag'] == 1){
                                    @$icon1 = "check";
                                }
                        }
                        
                    }
                    
                    
                    
                //Carregando as informações do recibo
                    $stmt = $recibo->getReceiptProcess($process_number);
                    
                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
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
                                    if($rec_id != ""){
                                        $icon2 = "check";
                                    }
                            }
                        }
                    
                    
                    

                    
                    
                    
    }
        
        
        
        
        
        // Área dos posts ///////////////////////////////////////////////////////////////////////////////////////
        if(isset($_POST) && !empty($_POST)){
            
            if($_POST['save'] == 1){
                
                $pro_num = $_POST['num_processo'];
                $data = $_POST['data_processo'];
                $hora = $_POST['hora_processo'];
                $usuario = $_POST['usuario'];
                $pro_com_cnpj = "***";
                $status = $_POST['status'];
                
                $stmt = $processo->addProcess($data_reg, $pro_num, $data, $hora, $usuario, $pro_com_cnpj, $status);
                    if($stmt->rowCount() > 0){
                        
                        //Após o registro de processo, cria-se a session com o número do processo
                        $_SESSION['process_number'] = $pro_num;
                        $process_number = $_SESSION['process_number'];
                        
                        echo "<script>"
                        ."alert('Abertura de processo realizada com sucesso!');"
                                ."location.href='process_register.php';"
                        . "</script>";
                        }
                    else{
                        echo "<script>"
                        ."alert('Falha ao tentar realizar abertura do processo!');"
                        . "</script>";
                    }
                
                
                
            }
            if($_POST['save'] == 2){
                                
                    $com_cnpj = $_POST['cnpj'];
                    $com_logo = $_POST['logo'];
                    $com_razao = $_POST['razao'];
                    $com_fantasia = $_POST['fantasia'];
                    $com_dtabertura = $_POST['dtabertura'];
                    $com_ies = $_POST['ies'];
                    $com_nat_jur = $_POST['nat_jur'];
                    $com_cnae = $_POST['num_cnae'];
                    $com_atividade_p = $_POST['atividade_p'];
                    $com_atividade_s = $_POST['atividade_s'];
                    $com_cep = $_POST['cep'];
                    $com_rua = $_POST['rua'];
                    $com_num = $_POST['num'];
                    $com_complemento = $_POST['complemento'];
                    $com_bairro = $_POST['bairro'];
                    $com_cidade = $_POST['cidade'];
                    $com_uf = $_POST['uf'];
                    $com_tel1 = $_POST['tel1'];
                    $com_tel2 = $_POST['tel2'];
                    $com_email = $_POST['email'];
                    $com_site = $_POST['site'];
                    $com_obs = $_POST['obs'];
                    $com_situacao = $_POST['situacao'];
                    $com_dtsituacao = $_POST['dtsituacao'];
                    $com_motivo_situacao = $_POST['motivo_situacao'];
                    $com_situacao_especial = $_POST['situacao_especial'];
                    $com_dtsituacao_especial = $_POST['dtsituacao_especial'];
                    $com_capital_social = $_POST['capital_social'];
                    $com_qsa = $_POST['qsa'];
                    $flag = 1;

                    $stmt = $company->addCompany($com_cnpj, $com_logo, $com_razao, $com_fantasia, $com_dtabertura, $com_ies, $com_nat_jur, $com_cnae, $com_atividade_p, $com_atividade_s, $com_cep, $com_rua, $com_num, $com_complemento, $com_bairro, $com_cidade, $com_uf, $com_tel1, $com_tel2, $com_email, $com_site, $com_obs, $com_situacao, $com_dtsituacao, $com_motivo_situacao, $com_situacao_especial, $com_dtsituacao_especial, $com_capital_social, $com_qsa, $flag);

                        if($stmt->rowCount() > 0){
                            //Aletra a tabela de processos inclusindo o CNPJ da empresa neste processo
                            $stmt = $processo->updateProcess($com_cnpj, $process_number);
                                if($stmt->rowCount() > 0){
                                    
                                    $icon1 = "check";                                    
                                    
                                    echo "<script>"
                                    ."alert('Registro e inclusão realizados com sucesso!');"
                                            . "location.href='process_register.php';"
                                    . "</script>";
                                }
                        }
                        else{
                            echo "<script>"
                            ."alert('Erro ao tentar salvar empresa!');"
                            . "</script>";
                        }
                    
                }// fim post empresa
                
                if($_POST['save'] == 3){
                                        
                    $data = $_POST['data'];
                    $valor = $_POST['valor'];
                    $pagador = $_POST['pagador'];
                    $cnpj_cpf_pag = $_POST['cnpj_cpf_pag'];
                    $valor_ext = $_POST['valor_ext'];
                    $referencia = $_POST['referencia'];
                    $emissor = $_POST['emissor'];
                    $cnpj_cpf_emiss = $_POST['cnpj_cpf_emiss'];
                    $tel = $_POST['tel'];
                    $forma_pag = $_POST['forma_pag'];
                    
                    $stmt = $recibo->addReceipt($process_number, $data, $valor, $pagador, $cnpj_cpf_pag, $valor_ext, $referencia, $emissor, $cnpj_cpf_emiss, $tel, $forma_pag);
                    
                        if($stmt->rowCount() > 0){
                            $icon2 = "check";                            
                            
                            echo "<script>"
                            ."alert('Recibo salvo com sucesso!');"
                                    . "location.href='process_register.php';"
                            . "</script>";
                        }
                        else{
                            echo "<script>"
                            ."alert('Falha ao salvar o recibo!');"
                            ."</script>";
                        }
                    
                }//Fim do post recibo
                            
                
                
                
            }// fim dos posts
                                      
                
            

?>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-language" content="pt_br">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/process_register_style.css"> 
        
        
    </head>
    <body>
        <header>
            <h2>Processo</h2>
            <h4 align="right"><?php echo "Número do processo ".@$_SESSION['process_number'];?></h4>
        </header>
        
        <div class="container">
            <br>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="form-row">
                    <div class="col-md-3">
                        <h4>Informações do Processo</h4>                        
                        <br>
                    </div>      
                </div>                                
                
                <div class="form-row">
                    <input type="hidden" name="idprocesso" value="<?php echo @$pro_id;?>">                    
                    <div class="form-group col-md-3">
                        <label>Número do Processo</label>
                        <input type="text" name="num_processo" class="form-control" value="<?php echo @$pro_numero;?>">
                    </div>
                    <div class="form-group offset-5 col-md-2">
                        <label>Data</label>
                        <input type="date" name="data_processo" class="form-control" value="<?php echo @$data_reg;?>">
                        
                    </div>
                    <div class="form-group offset-1 col-md-1">
                        <label>Hora</label>
                        <input type="text" name="hora_processo" class="form-control" value="<?php echo @$hora;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Usuário</label>
                        <input type="text" name="usuario" class="form-control" value="<?php echo @$usuario;?>">
                    </div>
                    <div class="form-group offset-5 col-md-4">
                        <label>Status do Processo</label>
                        <select name="status" id="Status" class="form-control">
                            <option value="<?php
                                if(isset($_SESSION['process_number'])){
                                    echo @$row['pro_status'];
                                }
                                else{
                                    echo "1";
                                }
                            ?>"><?php
                                if(isset($_SESSION['process_number']) && !empty($_SESSION['process_number'])){
                                    echo @$status;
                                }
                                else{
                                    echo "1 - Em aberto";
                                }
                            ?></option>               
                            <option value="1">1 - Em Aberto</option>
                            <option value="2">2 - Concluído</option>
                            <option value="3">3 - Cancelado</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row control-bar">
                    <div class="col-md">
                        <hr>
                        <button type="reset" class="btn btn-light btn_processo" title="Limpar campos"><i class="material-icons">clear</i> Limpar campos</button>
                        <button type="submit" name="save" value="1" class="btn btn-success btn_processo" title="Salvar processo"><i class="material-icons">save</i> Salvar</button>                        
                    </div>
                </div>
                <br>
            </form>
            
            
            <div class="accordion" id="Accordion">
                <!-- Collapse 1-->
                <div class="card-header">
                    <button class="btn btn-link text-light" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" title="Registrar empresa no processo"><i class="material-icons">business</i> Empresa</button>
                </div>
                
                <!-- Conteúdo do 1 collapsável|  incluir a classe Show depois de salvar a empresa -->
                <div id="collapseOne" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        <!-- Tablist da sessão Empresa -->
                        <ul class="nav nav-tabs" id="Mytabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-identificacao" href="#panel1" data-toggle='tab' role='tab' aria-controls='panel1' aria-selected='true'>Identificação</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="tab-endereco" href="#panel2" data-toggle='tab' role='tab' aria-controls='panel2' aria-selected='false'>Endereço</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="tab-contato" href="#panel3" data-toggle='tab' role='tab' aria-controls='panel3' aria-selected='false'>Contato</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" id="tab-situacao" href="#panel4" data-toggle='tab' role='tab' aria-controls='panel4' aria-selected='false'>Situação Cadastral</a>
                            </li>
                        </ul>
                        <form id="form_empresa" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <!-- end tabs -->
                            <!-- Conteúdo das tabs -->
                            <div class="tab-content" id="myTabContent">
                                <!-- Ítens com conteúdo -->
                                <div class="tab-pane fade show active" id="panel1" role='tabpanel1' aria-labelledby='lab-id'>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Digite um CNPJ - somente números</label>
                                            <input type="hidden" name="idcom" value="<?php echo @$com_id;?>">
                                            <input type="text" name="cnpj" id="cnpj" class="form-control" value="">
                                            <button type="button" class="btn btn-success" id="btn_search" title="Procurar CNPJ"><i class="material-icons">search</i></button>
                                            <span class="load"></span>
                                        </div>
                                        <div class="form-group offset-1 col-md-2">
                                            <label>Logomarca da Empresa</label>
                                            <div id="logo_file" class="material-icons" align="center">
                                                camera
                                                <input type="file" name="file" id="file">
                                                <input type="hidden" id="logo" name="logo" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- view da logomarca da empresa -->
                                    <span id="viewlogo">
                                        <img class="img-thumbnail small" id="view_logo" src="<?php echo "../assets/uploads/logomarca/".@$com_logo;?>">
                                        <span class="upload_file"></span>
                                    </span>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label>Razão Social</label>
                                            <input type="text" name="razao" id="razao" class="form-control" value="<?php echo @$com_razao;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Nome Fantasia</label>
                                            <input type="text" name="fantasia" id="fantasia" class="form-control" value="<?php echo @$com_fantasia;?>">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Data de Abertura</label>
                                            <input type="text" name="dtabertura" id="dtabertura" class="form-control" value="<?php echo @$com_dtabertura;?>">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>CNPJ</label>
                                            <input type="text" name="ies" id="ies" class="form-control" value="<?php echo @$com_cnpj;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Natureza Jurídica</label>
                                            <input type="text" name="nat_jur" id="nat_jur" class="form-control" value="<?php echo @$com_nat_jur;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>Número CNAE</label>
                                            <input type="text" name="num_cnae" id="cnae" class="form-control" value="<?php echo @$com_cnae;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Atividade Principal</label>
                                            <input type="text" name="atividade_p" id="atividade_p" class="form-control" value="<?php echo @$com_atividade_p;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Atividade Secundária</label>
                                            <textarea name="atividade_s" id="atividade_s" cols="25" rows="5" class="form-control"><?php echo @$com_atividade_s;?></textarea> 
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <!-- ... -->
                                    </div>
                                    
                                </div>
                                <!-- end panel identificação -->
                                <!-- begin panel endereço -->
                                <div class="tab-pane fade show" id="panel2" role='tabpanel2' aria-labelledby='lab-id'>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label>CEP</label>
                                            <input type="text" name="cep" id="cep" class="form-control" value="<?php echo @$com_cep;?>">
                                            <a href="#" class="btn btn-success" id="btn_search" title="Procurar CEP"><i class="material-icons">search</i></a>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Rua</label>
                                            <input type="text" name="rua" id="rua" class="form-control" value="<?php echo @$com_rua;?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>Número</label>
                                            <input type="text" name="num" id="num" class="form-control" value="<?php echo @$com_num;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Complemento</label>
                                            <input type="text" name="complemento" id="complemento" class="form-control" value="<?php echo @$com_complemento;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Bairro</label>
                                            <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo @$com_bairro;?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Município</label>
                                            <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo @$com_cidade;?>">
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label>UF</label>
                                            <input type="text" name="uf" id="uf" class="form-control" value="<?php echo @$com_uf;?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show" id="panel3" role='tabpanel3' aria-labelledby='lab-id'>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Telefones</label>
                                            <input type="text" name="tel1" id="tel1" class="form-control" value="<?php echo @$com_tel1;?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>&nbsp;</label>
                                            <input type="text" name="tel2" id="tel2" class="form-control" value="<?php echo @$com_tel2;?>">
                                        </div>                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label>E-mail</label>
                                            <input type="text" name="email" id="email" class="form-control" value="<?php echo @$com_email;?>">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Site</label>
                                            <input type="text" name="site" id="site" class="form-control" value="<?php echo @$com_site;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-8">
                                            <label>Observações</label>
                                            <textarea name="obs" id="obs" cols="25" rows="5" class="form-control" onkeyup="limite_textarea(this.value)"><?php echo @$com_obs;?></textarea>
                                            <span id="cont_char"><span id="cont">150</span> caracteres restantes.</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade show" id="panel4" role='tabpanel4' aria-labelledby='lab-id'>
                                    <br>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Situação Cadastral</label>
                                            <input type="text" name="situacao" id="situacao" class="form-control" value="<?php echo @$com_situacao;?>">
                                        </div>                                        
                                        <div class="form-group offset-7 col-md-2">
                                            <label>Data Situação Cadastral</label>
                                            <input type="text" name="dtsituacao" id="dtsituacao" class="form-control" value="<?php echo @$com_dtsituacao;?>">
                                        </div>                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label>Motivo da Situação Cadastral</label>                                            
                                            <input type="text" name="motivo_situacao" id="motivo_situacao" class="form-control" value="<?php echo @$com_motivo_situacao;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Situação Especial</label>
                                            <input type="text" name="situacao_especial" id="situacao_especial" class="form-control" value="<?php echo @$com_situacao_especial;?>">
                                        </div>
                                        <div class="form-group offset-7 col-md-2">
                                            <label>Data Situação Especial</label>
                                            <input type="text" name="dtsituacao_especial" id="dtsituacao_especial" class="form-control" value="<?php echo @$com_dtsituacao_especial;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md">
                                            <label>Capital Social</label>
                                            <input type="text" name="capital_social" id="capital_social" class="form-control" value="<?php echo @$com_capital_social;?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-5">
                                            <label>Quadro de Sócios</label>
                                            <input type="text" name="qsa" id="qsa" class="form-control" value="<?php echo @$com_qsa;?>">
                                        </div>
                                    </div>
                                    
                            </div>
                            <!-- and Tablist -->
                            
                            <div class="form-row control-bar">
                                <div class="col-md">
                                    <hr>
                                    <button type="reset" class="btn btn-light btn_processo" title="Limpar campos"><i class="material-icons">clear</i> Limpar campos</button>
                                    <button type="submit" name="save" value="2" class="btn btn-success btn_processo" title="Salvar e incluir no processo"><i class="material-icons">save</i> Salvar</button>
                                </div>
                            </div>
                                                
                    </div>                            
                        </form>
                </div>
                </div>
                <!-- and Collapse 1 -->
                
                <!-- Collapse 2 ////////////////////////////////////////////////////////////////////-->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" title="Gerar e enviar recibo"><i class="material-icons">receipt</i> Recibo</button>                    
                </div>
                <!-- Conteúdo colapsável -->
                <div id="collapseTwo" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <fieldset id="fieldset">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <div class="logo"><img class="img-thumbnail" src="../assets/uploads/logomarca/<?php echo @$com_logo;?>"></div>
                                    </div>
                                    <div class="form-group offset-4 col-md-5">
                                        <div class="endereco" align='right'>
                                            <p><?php echo @$com_rua.", nº ".@$com_num." - ".@$com_bairro;?><br>
                                                <?php echo "Contato: ".@$com_tel1." | ".@$com_tel2;?><br>
                                                <?php echo "E-mail: ".@$com_email;?><br>
                                                <?php echo "CEP: ".@$com_cep." - ".@$com_cidade;?></p>
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
                                        <input type="text" name="valor_ext" class="form-control" value="<?php echo @$importancia;?>">
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
                                        <h6 align="center" id="sign">Assinatura</h6>
                                    </div>
                                </div>

                            </fieldset>
                            <div class="form-row control-bar">
                                <div class="col-md">
                                    <hr>
                                    <button type="reset" class="btn btn-light btn_processo" title="Limpar campos"><i class="material-icons">clear</i> Limpar campos</button>
                                    <button type="submit" name="save" value="3" class="btn btn-success btn_processo" title="Salvar recibo"><i class="material-icons">save</i> Salvar</button>
                                    <button type="button" name="print" class="btn btn-secondary" title="Imprimir recibo"><i class="material-icons">print</i> Imprimir</button>
                                </div>
                            </div>
                            <br>
                        </form>
                    </div>
                </div>
                
                
                
                <!-- Collapse 3 //////////////////////////////////////////////////////////////////////-->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" title="Gerar e enviar requerimento"><i class="material-icons">insert_drive_file</i> Requerimento</button>
                </div>
                
                <!-- Conteúdo colapsável do Collapse 3 -->
                <div id="collapseThree" class="collapse show" data-parent="#Accordion">
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <h4>Informações do Requerimento</h4>
                                    <br>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Competência</label>
                                    <select id="competencia" name="competencia" class="form-control">
                                        <option value="">Selecione...</option>
                                        <option value="1">Janeiro - <?php echo date('Y');?></option>
                                        <option value="2">Fevereiro - <?php echo date('Y');?></option>
                                        <option value="3">Março - <?php echo date('Y');?></option>
                                        <option value="4">Abril - <?php echo date('Y');?></option>
                                        <option value="5">Maio - <?php echo date('Y');?></option>
                                        <option value="6">Junho - <?php echo date('Y');?></option>
                                        <option value="7">Julho - <?php echo date('Y');?></option>
                                        <option value="8">Agosto - <?php echo date('Y');?></option>
                                        <option value="9">Setembro - <?php echo date('Y');?></option>
                                        <option value="10">Outubro - <?php echo date('Y');?></option>
                                        <option value="11">Novembro - <?php echo date('Y');?></option>
                                        <option value="12">Dezembro - <?php echo date('Y');?></option>
                                    </select>                                    
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>CNPJ do Requerente</label>
                                    <input type="text" name="cnpj_req" class="form-control" value="<?php echo @$com_cnpj;?>">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Razão Social</label>
                                    <input type="text" name="razao_req" class="form-control" value="<?php echo @$com_razao;?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nome Fantasia</label>
                                    <input type="text" name="fantasia_req" class="form-control" value="<?php echo @$com_fantasia;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md">                                    
                                    <div class="paper">
                                        <fieldset>
                                            <img src="../assets/images/logo_fatsus.jpg">
                                            <p></p>
                                            <p style="text-align: end;">Manaus (AM), 12 de julho de 2019.</p>
                                            <p style="text-indent: 0px; margin-left: 50px;">À <strong>Secretaria do Estado de Saúde - SUSAM</strong><br>
                                                Ilmo. Sr. Direto do Departamento Financeiro<br>
                                                Referente ao Requerimento</p>
                                            <br><br><br><br>
                                            <p>
                                                <?php echo @$com_razao;?>, CNPJ nº <?php echo @$com_cnpj;?>, localizado na <?php echo @$com_rua.", ".@$com_num." ".@$com_bairro;?>, vem com o devido respeito, acatamento e na melhor forma de direito requerer o pagamento dos serviços laboratoriais prestados, no total de R$(quarenta e cinco mil, oitocentos e cinco reais e trinta e seis centavos), referente ao pagamento dos serviços prestados no mês de abril de 2019.
                                            </p>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row control-bar">
                                <div class="col-md">
                                    <hr>
                                    <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar Campos</button>
                                    <button type="submit" name="save" class="btn btn-success" value="4" title="Salvar requerimento"><i class="material-icons">save</i> Salvar</button>
                                    <button type="button" name="print" class="btn btn-secondary" title="Imprimir requerimento"><i class="material-icons">print</i> Imprimir</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                                
                
                
                <!-- Collapse 4 //////////////////////////////////////////////////////////////////////-->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseFour" arial-expanded="false" atial-controls="collapseFour" title="Registrar e enviar NFe"><i class="material-icons">attach_money</i> Nota Fiscal</button>
                </div>
                
                <!-- Countúdo colapsável do Collapse 4 -->
                <div id="collapseFour" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        <form>
                            <input type="hidden" name="notaid" value="">
                            <input type="hidden" name="nota_cnpj" value="">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <h4>Informações da Nota Fiscal</h4>
                                    <br>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Nº da Nota Fiscal</label>
                                    <input type="text" name="num_nfe" class="form-control" value="">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Valor da Nota Fiscal</label>
                                    <input type="text" name="valor_nfe" class="form-control" value="">
                                </div>
                                <div class="form-group offset-5 col-md-2">
                                    <label>Data de Emissão</label>
                                    <input type="date" name="data_emissao" class="form-control" value="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Enviar PDF da NFe</label>
                                    <button type="button" id="btn_up_nfe" class="btn btn-info">Enviar NFe</button>
                                    <input type="file" id="nfe_file" accept="application/pdf" />
                                    <input type="hidden" id="nfe_filename" name="nfe_f" value=""> <!-- mudar para hidden -->                                                                        
                                </div>
                                <div class="form-group col-md-10">                                    
                                    <img src="" class="up_nfe">
                                    <embed id="viewpdf" src="" type="application/pdf" width="" height="">
                                </div>
                            </div>
                            <div class="form-row control-bar">
                                <div class="col-md">
                                    <hr>
                                    <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar Campos</button>
                                    <button type="submit" name="save" class="btn btn-success" value="5" title="Salvar NFe"><i class="material-icons">save</i> Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                
                <!-- Collapse 5 ////////////////////////////////////////////////////////////////////// -->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseFive" arial-expanded="false" aria-controls="collapseFive" title="Enviar certidões negativas"><i class="material-icons">filter_none</i> Certidões Negativas</button>
                </div>
                
                <!-- Conteúdo colapsável do Collapse 5 -->
                <div id="collapseFive" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        Conteúdo ...
                    </div>
                </div>
                
                
                
                <!-- Collapse 6 /////////////////////////////////////////////////////////////////// -->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" title="Importar relação de pacientes"><i class="material-icons">list</i> Relação de Pacientes</button>
                </div>
                
                <!-- Conteúdo colapsável do Collapse 6 -->
                <div id="collapseSix" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        Conteúdo ...
                    </div>
                </div>
                
                
                <!-- Collapse 7 ////////////////////////////////////////////////////////////////////// -->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven" title="Enviar contrato e aditivos"><i class="material-icons">description</i> Contrato</button>
                </div>
                
                <!-- Conteúdo do colapsável do Collapse 7 -->
                <div id="collapseSeven" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        Conteúdo ...
                    </div>
                </div>
                
                
                
                <!-- Collapse 8 /////////////////////////////////////////////////////////////////////// -->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight" title="Enviar síntese de produção"><i class="material-icons">report</i> Síntese de Produção</button>
                </div>
                
                
                <!-- Conteúdo do colapsável do Collapse 8 -->
                <div id="collapseEight" class="collapse" data-parent="#Accordion">
                    <div class="card-body">
                        Conteúdo ...
                    </div>
                </div>
                
                
                
                <!-- Collapse 9 ////////////////////////////////////////////////////////////////////// -->
                <div class="card-header">
                    <button type="button" class="btn btn-link text-light" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine" title="Enviar termo de execução"><i class="material-icons">playlist_add_check</i> TES - Termo de Execução de Serviço</button>
                </div>
                
                <!-- Conteúdo do colapsável do Collapse 9 -->
                <div class="collapse" id="collapseNine" data-parent="#Accordion">
                    <div class="card-body">
                        Conteúdo ...
                    </div>
                </div>
                
                
                <!-- Fim do Acordeon ///////////////////////////////////////////////////////////////// -->
            </div>
            <br>
            <div class="form-row">
                <div class="col-md-3">
                    <h4>Conclusão do Processo</h4>                    
                </div>
            </div>
            <div class="form-row control-bar">
                <div class="col-md">
                    <hr>                    
                    <button type="submit" name="save" value="" class="btn btn-success" title="Concluir e fechar processo"><i class="material-icons">save</i> Concluir</button>
                </div>
            </div>
            <br>
                
                
            
            
        </div>
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Busca de CNPJ -->
        <script type="text/javascript">
            $('#btn_search').click(function(e){ //Esta linha com evento onclick do botão
//            $('#cnpj').on("blur",function(e){ //aqui o evento é onblur (saída do campo)
                var cnpj = $('#cnpj').val();
//                console.log(cnpj);
                $.ajax({
                    url:"http://ws.hubdodesenvolvedor.com.br/v2/cnpj/?cnpj="+cnpj+"&token=53441345aLwyUpMxAQ96486728",
                    type:"get",
                    dataType:"json",
                    data:$('#form_empresa').serialize(),
                    
                    beforeSend:function(){
                                        $('.load').html("<label class='text-success'>Procurando...</label>");
                                    },
                    success: function(data){ 
                        $('.load').html("<label class='text-success'></label>");
//                        console.log(data.result.nome);
//                        console.log(data.result.fantasia);  
                        if(data.status == true){
                            $('#razao').val(data.result.nome);
                            $('#fantasia').val(data.result.fantasia);
                            $('#dtabertura').val(data.result.abertura);
                            $('#ies').val(data.result.numero_de_inscricao);
                            $('#nat_jur').val(data.result.natureza_juridica);
                            $('#cnae').val(data.result.atividade_principal.code);
                            $('#atividade_p').val(data.result.atividade_principal.text);
                            // percorrendo array das atividades secundárias
                            var lista = data.result.atividades_secundarias;                            
                            var conteudo = "";
                                for(i = 0; i < lista.length; i++){
                                    conteudo = conteudo + lista[i].code + ": " + lista[i].text + "\n";
                                }
                                $('#atividade_s').html(conteudo);
                                $('#cep').val(data.result.cep);
                                $('#rua').val(data.result.logradouro);
                                $('#num').val(data.result.numero);
                                $('#complemento').val(data.result.complemento);
                                $('#bairro').val(data.result.bairro);
                                $('#cidade').val(data.result.municipio);
                                $('#uf').val(data.result.uf);
                                $('#tel1').val(data.result.telefone);
                                $('#email').val(data.result.email);
                                $('#situacao').val(data.result.situacao);
                                $('#motivo_situacao').val(data.result.motivo_situacao_cadastral);
                                $('#situacao_especial').val(data.result.situacao_especial);
                                $('#dtsituacao_especial').val(data.result.data_situacao_especial);
                                $('#capital_social').val(data.result.capita_social);                            
                                $('#qsa').val(data.result.quadro_socios);                            
                        }
                        else{                            
                            alert("Não houve sucesso na busca do CNPJ!");
                            
                            $('#razao').val("");
                            $('#fantasia').val("");
                            $('#dtabertura').val("");
                            $('#ies').val("");
                            $('#nat_jur').val("");
                            $('#cnae').val("");
                            $('#atividade_p').val("");
                            $('#atividade_s').html("");
                            $('#cep').val("");
                            $('#rua').val("");
                            $('#num').val("");
                            $('#complemento').val("");
                            $('#bairro').val("");
                            $('#cidade').val("");
                            $('#uf').val("");
                            $('#tel1').val("");
                            $('#email').val("");
                            $('#situacao').val("");
                            $('#motivo_situacao').val("");
                            $('#situacao_especial').val("");
                            $('#dtsituacao_especial').val("");
                            $('#capital_social').val("");
                            $('#qsa').val("");
                    }
                }
                
                });
            });
        </script>       
        
        <!-- Contador de caracteres do campo Observações -->
        <script type="text/javascript">
            function limite_textarea(valor) {
                quant = 150;
                total = valor.length;
                    if(total <= quant) {
                        resto = quant - total;
                        document.getElementById('cont').innerHTML = resto;
                    }
                    else {
                        document.getElementById('obs').value = valor.substr(0,quant);
                    }
                }                        
        </script>
        <!-- Envio de logomarca -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change','#file',function(){
                    var property = document.getElementById('file').files[0];
                    var image_name = property.name;
                    var image_extension = image_name.split('.').pop().toLowerCase();
                        if(jQuery.inArray(image_extension,['jpg']) > -1){
                        //    alert('Tipo de arquivo inválido!');                                                
                        var image_size = property.size;
                            if(image_size > 1000000){
                                alert('Tamanho de arquivo inválido!');
                            }
                            else{
                                var form_data = new FormData();
                                form_data.append("file",property);
                                $.ajax({
                                    url:"../classes/upload.php",
                                    method:"POST",
                                    data:form_data,
                                    contentType:false,
                                    cache:false,
                                    processData:false,
                                    beforeSend:function(){
                                        $('.upload_file').html("<label class='text-success'>Enviando...</label>");
                                        
                                    },
                                    success:function(data){
                                        $('.upload_file').html($logo = data);
                                        $('#view_logo').attr('src','../assets/uploads/logomarca/'+data);
                                        $('#logo').val(data);
                                        //$('#logomarca').attr('value',data);
                                    }
                                });
                            }
                        }
                        else{
                            alert('Tipo de arquivo inválido!');
                        }
                });
            });
        </script>
        
        <!-- Envio da NFE ////////////////////////////////////////////////////////////////////////////-->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_up_nfe').on('click',function(){
                    $('#nfe_file').trigger('click');
                });
                $(document).on('change','#nfe_file',function(){
                    var property = document.getElementById('nfe_file').files[0];
                    var image_name = property.name;
                    var image_extension = image_name.split('.').pop().toLowerCase();
                        if(jQuery.inArray(image_extension,['pdf']) > -1){
                        //    alert('Tipo de arquivo inválido!');                                                
                        var image_size = property.size;
                            if(image_size > 5000000){
                                alert('Tamanho de arquivo inválido!');
                            }
                            else{
                                var form_data = new FormData();
                                form_data.append("file",property);
                                $.ajax({
                                    url:"../classes/upload_nfe.php",
                                    method:"POST",
                                    data:form_data,
                                    contentType:false,
                                    cache:false,
                                    processData:false,
                                    beforeSend:function(){                                        
                                        $('.up_nfe').attr('src','../assets/images/loading.gif');
                                    },
                                    success:function(data){
                                        $('#nfe_file').html(data);
                                        $("#viewpdf").attr('src','../assets/uploads/nfe/'+data);
                                        $('#viewpdf').attr('width','100%');
                                        $('#viewpdf').attr('height','480');
                                        $('.up_nfe').attr('src','');
                                    }                                    
                                });
                            }
                        }
                        else{
                            alert('Tipo de arquivo inválido!');
                        }
                });
            });
        </script>
        
    </body>
</html>

<?php
    }
    else{
        header("location:frm_login.php");
    }
?>
