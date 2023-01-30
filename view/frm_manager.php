<!DOCTYPE html>
<?php
session_start();

require_once '../inc/Database.php';
require_once '../classes/Manager.php';


if(isset($_GET['action'])){
        if($_GET['action'] == "logout"){
                        
            session_unset(@$_SESSION['usuario']);
            session_unset(@$_SESSION['userid']);
            session_unset(@$_SESSION['setor']);
            
            session_destroy();
            
            header("location:../index.php");
        }
    }

$db = new Database();
$conn = $db->Connect();

$man = new Manager($conn);


$stmt = $man->getManager();
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
            $m_id = $row['man_id'];
            $data = $row['man_data'];
            $m_razao = $row['man_razao'];
            $m_fantasia = $row['man_fantasia'];
            $m_cnpj = $row['man_cnpj'];
            $m_cnes = $row['man_cnes'];
            $m_logo = $row['man_logo'];
            $m_cep = $row['man_cep'];
            $m_rua = $row['man_rua'];
            $m_num = $row['man_num'];
            $m_comp = $row['man_comp'];
            $m_bairro = $row['man_bairro'];
            $m_cidade = $row['man_cidade'];
            $m_uf = $row['man_uf'];
            $m_tel1 = $row['man_tel1'];
            $m_tel2 = $row['man_tel2'];
            $m_email = $row['man_email'];                        
        }
        
        
    }

            
        if((isset($_POST) && !empty($_POST))){
        
        $data = date("d/m/Y");
        
        $id = md5($data);
        
        $razao = $_POST['razao'];
        $fantasia = $_POST['fantasia'];
        $cnpj = $_POST['cnpj'];
        $cnes = $_POST['cnes'];
//        $logo = $_POST['logo'];
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
        $flag = 0;
        
        
        //pegando upload da imagem
        $arquivo = isset($_FILES['logo'])?$_FILES['logo']:"";
        
            if($_FILES['logo']){
                $nome = $arquivo['name'];                
                $tipos = array('jpg','jpeg','png');
                $tamanho = $arquivo['size'];
                $extensao = explode('.', $nome);
                $extensao = end($extensao);
                $novo_nome = date("dmyhis").".".$extensao;                
                    if(in_array($extensao, $tipos)){
                        //7340032 bytes -> 7mb
                        if($tamanho > 2097152){
                            echo "<script>"
                            ."alert('Tamanho de arquivo maior que o permitido!');"
                            . "</script>";
                        }
                        else{
                            move_uploaded_file($_FILES['logo']['tmp_name'], '../assets/uploads/'.$novo_nome);
                            $logo = $novo_nome;
                        }
                    }
                    else{
                        echo "<script>"
                        ."alert('Tipo de arquivo não permitido!');"
                        . "</script>";
                    }
            }
            
            
            $stmt = $man->addManager($id, $razao, $fantasia, $cnpj, $cnes, $logo, $cep, $rua, $num, $comp, $bairro, $cidade, $uf, $tel1, $tel2, $email, $data, $flag);
            
                if($stmt){
                    session_unset(@$_SESSION['id_manager']);
                    session_unset(@$_SESSION['usuario']);
                    session_unset(@$_SESSION['userid']);
                    session_unset(@$_SESSION['setor']);

                    session_destroy();
            
                    echo "<script>"
                    ."alert('Registro de gestão realizado com sucesso!');"
                            ."location.href='../';"                            
                    . "</script>";
                }
                else{
                    echo "<script>"
                    ."alert('Erro ao registrar a gestão no sistema!');"
                    . "</script>";                   
                }
        } // Fim post                    



    

?>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=width-device, initial-scale=1, shrink-to-fit=no">
        
        <title></title>
        
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/material-icons.css">
        <link rel="stylesheet" href="../assets/css/frm_style.css">
        
        <style type="text/css">
                    /* start_page */
        .background_logo .img-fluid{
            position: static;
            margin-top: 100px;
        }
        /* start_page */
        .navbar-light{
            background-color: #0076a3;   
        }
        .navbar-brand .img-fluid{
            width: 100px;
        }
        .navbar-nav .nav-item .nav-link{
            color: #ebebeb;
        }
        
        .status-top{
            position: absolute;    
            right: 10px;    
            top: 0px;    
            font-size: 12px;
            color: #fff;
}
        
        .content-page{
            margin-top: 10px;
        }
        </style>
    </head>
    <body>
        
        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <!-- Navbar-brand -->            
            <a class="navbar-brand" href="../" target="_parent">
                <img class="img-fluid" src="../assets/images/logo_fatsus-white-t1.png">
            </a>           
            <div class="status-top"><?php echo @$_SESSION['fantasia']." | ".@$_SESSION['cnpj']." | ".@$_SESSION['cnes'];?></div>
            <!-- button -->
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menuCollapse" aria-controls="menuCollapse" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="menuCollapse">
                <ul class="navbar-nav ml-auto">                    
                    <li class="nav-item">
                        <!-- Chamando a pergunta para decisão de logout -->
                        <a class="nav-link" href="#" onclick="logout();" title="Sair do sistema">Sair</a>
                    </li>                    
                </ul>
            </div>            
        </nav>
        <!-- end Navbar -->
        
        
        <div class="content-page">
            <div class="container">
            <h4 align="right">Gestor do Sistema</h4>
            <hr>
            
            <form method="post" enctype="multipart/form-data" onsubmit="return validField(this);">
                <div class="form-row">
                    <div class="form-group offset-1 col-md-3">
                        <h4>Identificação</h4>                        
                        <hr>                        
                        <input type="hidden" name="id" value="<?php echo @$id;?>">                        
                    </div>
                    <div class="form-group offset-6 col-md-1">
                        <label>Data</label>
                        <input type="text" name="data" class="form-control" value="<?php echo @$data;?>" disabled="">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-5">                        
                        <label>Razão Social</label>
                        <input type="text" name="razao" class="form-control" value="<?php echo @$m_razao;?>">
                    </div>
                    <div class="form-group col-md-5">
                        <label>Nome Fantasia</label>
                        <input type="text" name="fantasia" class="form-control" value="<?php echo @$m_fantasia;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-3">
                        <label>CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" value="<?php echo @$m_cnpj;?>" onkeypress="Mask(this,'##.###.###/####-##')">
                    </div>
                    <div class="form-group col-md-3">
                        <label>CNES</label>
                        <input type="text" name="cnes" class="form-control" value="<?php echo @$m_cnes;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-3">                                                     
                        <input type="file" name="logo" class="btn-light" id="customFile">
                        <label id="labelFile" form="customFile" title="Escolha uma imagem da Logomarca">Logomarca</label>
                    </div>
                    <div class="form-group offset-3 col-md-3">
                        <div class="img-logo"><img src="../assets/uploads/<?php echo @$m_logo;?>" class="img-thumbnail"></div>                        
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group offset-1 col-md-3">
                        <h4>Endereço</h4>
                        <hr>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-2">
                        <label>CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" value="<?php echo @$m_cep;?>" onkeypress="Mask(this,'#####-###')">
                        <a href="#" class="btn btn-success" id="btn_search" title="Consultar"><i class="material-icons">search</i></a>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-6">
                        <label>Rua</label>
                        <input type="text" name="rua" id="rua" class="form-control" value="<?php echo @$m_rua;?>">               
                    </div>
                    <div class="form-group col-md-1">
                        <label>Número</label>
                        <input type="text" name="num" id="num" class="form-control" value="<?php echo @$m_num;?>">
                    </div>
                </div>
                
                <div class="form-row">                    
                    <div class="form-group offset-1 col-md-5">
                        <label>Complemento</label>
                        <input type="text" name="comp" id="comp" class="form-control" value="<?php echo @$m_comp;?>">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control" value="<?php echo @$m_bairro;?>">
                    </div>
                </div>
                
                <div class="form-row">                    
                    <div class="form-group offset-1 col-md-2">
                        <label>Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" value="<?php echo @$m_cidade;?>">
                    </div>
                    <div class="form-group col-md-1">
                        <label>UF</label>
                        <input type="text" name="uf" id="uf" class="form-control" value="<?php echo @$m_uf;?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-3">
                        <h4>Informações de Contato</h4>
                        <hr>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group offset-1 col-md-2">
                        <label>Telefone</label>
                        <input type="text" name="tel1" class="form-control" value="<?php echo @$m_tel1;?>" onkeypress="Mask(this,'#####-####')">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Telefone Celular</label>
                        <input type="text" name="tel2" class="form-control" value="<?php echo @$m_tel2;?>" onkeypress="Mask(this,'#####-####')">
                    </div>
                    <div class="form-group col-md-3">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control" value="<?php echo @$m_email;?>">
                    </div>
                </div>

                <hr>
                <div class="control-bar">
                    <button type="submit" class="btn btn-success" title="Salvar Gestor"><i class="material-icons">save</i> Salvar</button>
                    <button type="reset" class="btn btn-light" title="Limpar campos" onclick="javascript:history.go(-1);"><i class="material-icons">clear</i> Voltar</button>                   
                </div>
                
            </form>
            </div>
        </div>
        
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- Comparação de senha -->
        <script type="text/javascript">
            function passCompare(){
                var vl1 = document.getElementById('Senha').value;
                var vl2 = document.getElementById("Conf_senha").value;
                
                    if(vl1 != vl2){
                        alert('As senhas não conferem! Tente novamente.');
                        document.getElementById("Conf_senha").value = "";
                        document.getElementById("Senha").value = "";
                        document.getElementById("Senha").focus();
                    }
            }
        </script>
        <!-- Máscara -->
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
            $('#btn_search').click(function(){
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
        <!-- validação de form -->
        <script type="text/javascript">
            function validField(frm){
                if(frm.razao.value == ""){
                    alert('O campo Razão Social está vazio!');
                    frm.razao.focus();
                    return false;
                }
                if(frm.fantasia.value == ""){
                    alert('O campo Nome Fantasia está vazio!');
                    frm.fantasia.focus();
                    return false;
                }
                if(frm.cnpj.value == ""){
                    alert('O campo CNPJ está vazio!');
                    frm.cnpj.focus();
                    return false;
                }
                if(frm.cnes.value == ""){
                    alert('O campo CNES está vazio!');
                    frm.cnes.focus();
                    return false;
                }
                if(frm.tel1.value == ""){
                    alert('Insira pelo menos um número de telefone!');
                    frm.tel1.focus();
                    return false;
                }
                
                return true;
            }
        </script>
        
        <script type="text/javascript">
        function logout(){
                var answer = confirm('Tem certeza que deseja sair do sistema?');
                    if(answer){
                        //alert('Valor excluido é'+ id);
                        window.location = '?action=logout';
                    }
            }
        </script>  
            
    </body>
</html>
