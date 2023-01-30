<!DOCTYPE html>
<?php
session_start();

date_default_timezone_set("America/Manaus");

require_once '../inc/Database.php';
require_once '../classes/Company.php';

if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){


$db = new Database();
$conn = $db->Connect();

$company = New Company($conn);

    if(isset($_SESSION['processo']) && !empty($_SESSION['processo'])){
        $num_processo = $_SESSION['processo'];
        // Pegando as informações da empresa conforme o número de processo
        $stmt = $company->getCompanyProcess($num_processo);
            if($stmt->rowCount() > 0){
                while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                    $com_id = $row['com_id'];
                    $com_razao = $row['com_razao'];
                    $com_fantasia = $row['com_fantasia'];
                    $com_cnpj = $row['com_cnpj'];
                    $com_cnes = $row['com_cnes'];
                    $com_desc_cnes = $row['com_desc_cnes'];
                    $com_cnae = $row['com_cnae'];
                    $com_desc_cnae = $row['com_desc_cnae'];
                    $com_iest = $row['com_iest'];
                    $com_atuacao = $row['com_atuacao'];
                    $com_socios = $row['com_socios'];
                    $com_admin = $row['com_admin'];
                    $com_cep = $row['com_cep'];
                    $com_rua = $row['com_rua'];
                    $com_numero = $row['com_numero'];
                    $com_comp = $row['com_comp'];
                    $com_bairro = $row['com_bairro'];
                    $com_cidade = $row['com_cidade'];
                    $com_uf = $row['com_uf'];
                    $com_tel1 = $row['com_tel1'];
                    $com_tel2 = $row['com_tel2'];                    
                    $com_email = $row['com_email'];
                    $com_site = $row['com_site'];
                    $com_obs = $row['com_obs'];
                    $com_logo = $row['logo'];
                }
            }
    }


    if((isset($_POST)) && !empty($_POST)){
        $com_id = $_POST['comid'];
        $num_processo = $_SESSION['processo'];
        $razao = $_POST['razao'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];
        $cnes = $_POST['cnes'];
        $desc_cnes = $_POST['desc_cnes'];
        $cnae = $_POST['cnae'];
        $desc_cnae = $_POST['desc_cnae'];
        $iest = $_POST['insc_est'];
        $atuacao = $_POST['atuacao'];
        $socios = $_POST['socios'];
        $admin = $_POST['admin_empresa'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $num = $_POST['num'];
        $comp = $_POST['comp'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $tel1 = $_POST['tel1'];
        $tel2 = $_POST['tel2'];
        $email = $_POST['email'];
        $site = $_POST['site'];
        $obs = $_POST['obs'];
        $com_logo = $_POST['logomarca'];
        
//        var_dump($_POST);
            if($_POST['comid'] == ""){
                $stmt = $company->addCompany($num_processo, $razao, $fantasia, $cnpj, $cnes, $desc_cnes, $cnae, $desc_cnae, $iest, $atuacao, $socios, $admin, $cep, $rua, $num, $comp, $bairro, $cidade, $uf, $tel1, $tel2, $email, $site, $obs, $com_logo);
        
                if($stmt->rowCount() > 0){
                    echo "<script>"
                    ."alert('Empresa registrada com sucesso!');"
                            ."location.href='step2.php';"
                    . "</script>";                
                }
                else{
                    echo "<script>"
                    ."alert('Falha ao registrar empresa!');"
                    . "</script>";
                }                
            }
            else{//Update
                $stmt = $company->editCompany($num_processo, $razao, $fantasia, $cnpj, $cnes, $desc_cnes, $cnae, $desc_cnae, $iest, $atuacao, $socios, $admin, $cep, $rua, $num, $comp, $bairro, $cidade, $uf, $tel1, $tel2, $email, $site, $obs, $com_logo, $com_id);
                    if($stmt->rowCount() > 0){
                        echo "<script>"
                        ."alert('Empresa editada com sucesso!');"
                                ."location.href='step2.php';"
                        . "</script>";
                    }
                    else{
                        echo "<script>"
                        ."alert('Falha ao editar empresa!');"
                        . "</script>";                        
                    }
            }
        
    }

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
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
                <li class="active"><span class="badge-pill badge-light">3</span></li>
                <li class="active"><span class="badge-pill badge-light">4</span></li>
                <li class="active"><span class="badge-pill badge-light">5</span></li>
                <li class="active"><span class="badge-pill badge-light">6</span></li>
            </ul>
            <br>
            
            <h2>Registro de Empresa</h2>            
            <h4 align="right">Processo: <?php echo @$_SESSION['processo'];?></h4>
        </header>
        
        
            <div class="container">
                <!-- Tablist -->
                <ul class="nav nav-tabs" id="myTabs" role="tablist">
                <!-- items -->
                <li class="nav-item">
                    <a class="nav-link active" id="tab-id" href="#pane1" data-toggle="tab" role="tab" aria-controls="pane1" aria-selected="true">Identificação</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="tab-adress" href="#pane2" data-toggle="tab" role="tab" aria-controls="pane2" aria-selected="false">Endereço</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" id="tab-contact" href="#pane3" data-toggle="tab" role="tab" aria-controls="pane3" aria-selected="false">Contatos</a>
                </li>                
            </ul>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                    <div class="tab-content" id="myTabContent">
                        <!-- item 1 -->
                        <div class="tab-pane fade show active" id="pane1" role="tabpanel" aria-labelledby="lab-id">
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>CNPJ</label>
                                    <input type="hidden" name="comid" value="<?php echo @$com_id;?>">
                                    <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?php echo @$com_cnpj;?>" onkeypress="Mask(this,'##.###.###/####-##')">
                                    <a href="#" class="btn btn-success" id="search_cnpj" title="Procurar"><i class="material-icons">search</i></a>
                                </div>
                                <div class="form-group offset-2 col-md-3">
                                    <!-- inputfile e visualização da imagem-->
                                    
                                        <label>Logomarca da Empresa</label>
                                        <input type="file" name="file" id="file">
                                        <input type="hidden" id="logomarca" name="logomarca" value="">
                                </div>
                            </div>
                            
                            <span id="viewlogo">                                
                                <img class="img-thumbnail" id="logo" src="../upload/logos/<?php echo @$com_logo;?>">
                                <span class="upload_file"></span>
                            </span>                            
                            
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <input type="hidden" name="id_company" value="<?php echo @$com_id;?>">
                                    <label>Razão Social</label>
                                    <input type="text" name="razao" id="razao" class="form-control" value="<?php echo @$com_razao;?>">
                                </div>                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Nome Fantasia</label>
                                    <input type="text" name="fantasia" id="fantasia" class="form-control" value="<?php echo @$com_fantasia;?>">
                                </div>
                            </div>
                            
                            <div class="form-row">                                
                                <div class="form-group col-md-3">
                                    <label>Nº CNES</label>
                                    <input type="text" name="cnes" class="form-control" value="<?php echo @$com_cnes;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tipo de Prestador</label>
                                    <input type="text" name="desc_cnes" class="form-control" value="<?php echo @$com_desc_cnes;?>">
                                </div>                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Nº CNAE</label>
                                    <input type="text" name="cnae" class="form-control" value="<?php echo @$com_cnae;?>" onkeypress="Mask(this,'####-#/###')">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Descrição CNAE</label>
                                    <input type="text" name="desc_cnae" class="form-control" value="<?php echo @$com_desc_cnae;?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Inscrição Estadual</label>
                                    <input type="text" name="insc_est" class="form-control" value="<?php echo @$com_iest;?>">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Área de Atuação</label>
                                    <input type="text" name="atuacao" class="form-control" value="<?php echo @$com_atuacao;?>">
                                </div>                                
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Sócios/Proprietários</label>
                                    <input type="text" name="socios" class="form-control" value="<?php echo @$com_socios;?>">
                                </div>                                
                                <div class="form-group col-md-5">
                                    <label>Administrador da Empresa</label>
                                    <input type="text" name="admin_empresa" class="form-control" value="<?php echo @$com_admin;?>">
                                </div>                                
                            </div>
                            
                        </div>
                        
                        <div class="tab-pane fade show" id="pane2" role="tabpanel" aria-labelledby="lab-id">
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>CEP</label>
                                    <input type="text" id="cep" name="cep" class="form-control" value="<?php echo @$com_cep;?>" onkeypress="Mask(this,'#####-###')">
                                    <a href="#" class="btn btn-success" id="search_cep" title="Procurar"><i class="material-icons">search</i></a>                                    
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label>Rua</label>
                                    <input type="text" id="rua" name="rua" class="form-control" value="<?php echo @$com_rua;?>">
                                </div>
                                <div class="form-group col-md-1">
                                    <label>Número</label>
                                    <input type="text" id="num" name="num" class="form-control" value="<?php echo @$com_numero;?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Complemento</label>
                                    <input type="text" name="comp" class="form-control" value="<?php echo @$com_comp;?>">
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Bairro</label>
                                    <input type="text" id="bairro" name="bairro" class="form-control" value="<?php echo @$com_bairro;?>">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" id="cidade" name="cidade" class="form-control" value="<?php echo @$com_cidade;?>">
                                </div>
                                <div class="form-group col-md-1">
                                    <label>UF</label>
                                    <input type="text" id="uf" name="uf" class="form-control" value="<?php echo @$com_uf;?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="pane3" role="tabpanel" aria-labelledby="tab-contact">
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Telefones para Contato</label>
                                    <input type="text" name="tel1" class="form-control" value="<?php echo @$com_tel1;?>" onkeypress="Mask(this,'## #####-####')" placeholder="DDD 99999-9999"><span class="inf">Digite somente números.</span>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>&nbsp;</label>
                                    <input type="text" name="tel2" class="form-control" value="<?php echo @$com_tel2;?>" onkeypress="Mask(this,'## #####-####')" placeholder="DDD 99999-9999"> <span class="inf">Informe pelo menos um número para contato!</span>
                                </div>
                                <div class="form-group offset-3 col-md-5">
                                    <label>E-mail</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo @$com_email;?>">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Site</label>
                                    <input type="text" name="site" class="form-control" value="<?php echo @$com_site;?>">
                                </div>
                                <div class="form-group offset-3 col-md-5">
                                    <label>Observações</label>
                                    <textarea id="obs" name="obs" cols="25" rows="5" class="form-control"onkeyup=" limite_textarea(this.value)">
                                        <?php echo @$com_obs;?>
                                    </textarea>
                                    <strong><span id="cont">150</span> caracteres restantes.</strong>
                                </div>
                            </div>                            
                        </div>
                                               
                        
                    </div>
                    <!-- end content tabs -->
                    <div class="control_bar form-row">                    
                        <div class="col-md">
                            <hr>
                            <a href="step1.php" class="btn btn-light" title="Voltar" style="float: left;"><i class="material-icons">keyboard_arrow_left</i> Voltar</a>
                            <button type="submit" class="btn btn-success" title="Salvar"><i class="material-icons">save</i> Salvar</button>
                            <button type="reset" class="btn btn-light" title="Limpar campos"><i class="material-icons">clear</i> Limpar</button>
                            <a href="step3.php" class="btn btn-secondary" title="Continuar"><i class="material-icons">keyboard_arrow_right</i>Continuar</a>
                        </div>
                    </div>
                    <br>
                </form>            
                <!-- end form -->
            </div>
            <!-- end container -->                                    
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
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
        
        <script type="text/javascript">
            $('#search_cep').click(function(){
                $.ajax({                    
                    url: '../classes/consultar_cep.php',
                    type: 'post',
                    dataType: 'json',
                    data: 'cep=' + $('#cep').val(),                        
                    success: function(data){
                        if(data.sucesso == 1){
                            $('#rua').val(data.rua);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.cidade);
                            $('#uf').val(data.estado);                            
                            
                            $('#num').focus();
                        }
                    }
                });
                return false;
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change','#file',function(){
                    var property = document.getElementById('file').files[0];
                    var image_name = property.name;
                    var image_extension = image_name.split('.').pop().toLowerCase();
                        if(jQuery.inArray(image_extension,['jpg','png']) > -1){
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
                                        $('#logo').attr('src','../upload/logos/'+data); 
                                        $('#logomarca').attr('value',data);
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
