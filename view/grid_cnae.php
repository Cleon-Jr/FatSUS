<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();


$cnae = new Cnae($conn);

//Total de registros
$sql = "select * from tb_cnae";
$stmt = $conn->query($sql);
$total_reg = $stmt->rowCount();

    //Pegando o valor da action para exibição da mensagem de exclusão
    if((isset($_GET['action'])) && !empty($_GET['action'])){
        $action = $_GET['action'];
            if($action == 'deleted'){
                $msg = "<div class='alert-success'>CNAE excluído com sucesso!</div>";
            }
            else{
                $msg = "<div class='alert-danger'>Erro ao tentar excluir!</div>";
            }
    }
//Limite de reigtsros por página    
$limit_reg = 50;

$page = intval(@$_GET['pag']);
    if(isset($_GET['pag'])){
        $page = ($_GET['pag']-1)*$limit_reg;
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
        <link rel="stylesheet" href="../assets/css/grid_style.css">
        
    </head>
    <body>
        <div class="content-page">
            <h4 align="right">Descrição CNAE</h4>
            <hr>
            
            <div class="container-fluid">
                <!-- Buttons -->
                <form method="post" id="form_search">
                    <div class="form-row">
                    <div class="form-group col-md-5">
                        <a href="frm_cnae.php?id_cnae='0'" class="btn btn-success" title="Adicionar CNAE"><i class="material-icons">note_add</i>Adicionar</a>
                    </div>
                    <div class="form-group offset-4 col-md-3" align="right">
                        <input type="text" name="pesquisar" class="form-control" value="">
                        <button type="submit" id="btn_search" class="btn btn-success" title="Pesquisar"><i class="material-icons">search</i></button>
                    </div>
                    </div>
                </form>
                       

                <!-- Barra de mensagem -->
                <?php
                    echo @$msg;               
                ?>
                

                <!-- table -->
                <table class="table table-hover table-bordered">
                    
                    <!-- Paginação -->
                    <ul class="pagination"> <?php                    
                            $total_pag = ceil($total_reg / $limit_reg);
                            $current_pag = 1;
                            
                                if(isset($_GET['pag'])){
                                    $current_pag = $_GET['pag'];
                                    $previous = $current_pag - 1;
                                    $next = $current_pag + 1;
                                }                                
                                if(($current_pag > 1) && ($current_pag < $total_pag)){
                                    ?>
                        <li><a href="?pag=1" class="btn btn-light" title="Primeiro registro"><i class="material-icons">first_page</i></a></li>
                        <li><a href="?pag=<?php echo $previous;?>" class="btn btn-light" title="Registro anterior"><i class="material-icons">keyboard_arrow_left</i></a></li>
                        <li><a href="?pag=<?php echo $next;?>" class="btn btn-light" title="Próximo registro"><i class="material-icons">keyboard_arrow_right</i></a></li>
                        <li><a href="?pag=<?php echo $total_pag;?>" class="btn btn-light" title="Último registro"><i class="material-icons">last_page</i></a></li>
                        <?php
                                }
                                if($current_pag == 1){                                    
                                    $previous = $current_pag - 1;
                                    $next = $current_pag + 1;
                                    ?>
                        <li><a href="?pag=1" class="btn btn-light disabled" title="Primeiro registro"><i class="material-icons">first_page</i></a></li>
                        <li><a href="?pag=<?php echo $previous;?>" class="btn btn-light disabled" title="Registro anterior"><i class="material-icons">keyboard_arrow_left</i></a></li>
                        <li><a href="?pag=<?php echo $next;?>" class="btn btn-light" title="Próximo registro"><i class="material-icons">keyboard_arrow_right</i></a></li>
                        <li><a href="?pag=<?php echo $total_pag;?>" class="btn btn-light" title="Último registro"><i class="material-icons">last_page</i></a></li>                                
                    
                    
                    <?php
                                }
                                if($current_pag == $total_pag){
                                    ?>
                    <li><a href="?pag=1" class="btn btn-light" title="Primeiro registro"><i class="material-icons">first_page</i></a></li>
                        <li><a href="?pag=<?php echo $previous;?>" class="btn btn-light" title="Registro anterior"><i class="material-icons">keyboard_arrow_left</i></a></li>
                        <li><a href="?pag=<?php echo $next;?>" class="btn btn-light disabled" title="Próximo registro"><i class="material-icons">keyboard_arrow_right</i></a></li>
                        <li><a href="?pag=<?php echo $total_pag;?>" class="btn btn-light disabled" title="Último registro"><i class="material-icons">last_page</i></a></li>                                
                    </ul>
                    
                    <?php
                                }
                        
                    ?>
                    
                    <tr id="tb_head">
                        <td align="center">ID</td>
                        <td align="center" width="120">Número CNAE</td>
                        <td>Descrição</td>
                        <td colspan="3" align="center">Ação</td>
                    </tr>
                    <?php                              
                    if((isset($_POST['pesquisar'])) && !empty($_POST['pesquisar'])){
                        $result = "%{$_POST['pesquisar']}%";
        
                        $sql = "select * from tb_cnae where num_cnae like '$result' limit $page, $limit_reg";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute(array($result));
                    }
                    else{
                        $stmt = $cnae->getAll($page, $limit_reg);                        
                    }
                    
                    
                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td aling="center"><?php echo $row['id'];?></td>
                        <td align="center"><?php echo $row['num_cnae'];?></td>
                        <td><?php echo $row['desc_cnae'];?></td>
                        <td align="center" width="120"><a href="view_cnae.php?id_cnae=<?php echo $row['id'];?>" class="btn btn-info" title="Visualizar"><i class="material-icons">visibility</i></a></td>
                        <td align="center" width="120"><a href="frm_cnae.php?id_cnae=<?php echo $row['id'];?>" class="btn btn-warning" title="Editar"><i class="material-icons" width="120">edit</i></a></td>
                        <td align="center" width="120"><a href="#" class="btn btn-danger" title="Excluir" onclick="delCNAE('<?php echo $row['id'];?>')"><i class="material-icons">delete</i></a></td>
                    </tr>
                    <?php
                            }
                        }
                        else{
                            echo "<td colspan=6><div class=alert-danger>Não foram encontrados registros!</div></td>";
                        }
                    ?>
                    
                    <tr id="status">
                        <td colspan="6" align="right"><strong><?php echo "Nº de CNAE registrados: ".@$stmt->rowCount();?></strong></td>
                    </tr>                                        
                    
                </table>
                                
            </div>
            
        </div>
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- interação com o usuário para exclusão de registro -->
        <script type="text/javascript">
            function delCNAE(id_cnae){
                var answer = confirm('Você tem certeza que deseja excluir este registro?');
                    if(answer){
                        window.location = '../classes/del_cnae.php?id_cnae=' + id_cnae;
                    }
            }
        </script>
        
        
        <script type="text/javascript">
            $(function(){
                $("#btn_search").click(function(){
                    var pesquisa = $("#pesquisar").val();
                    
                        if(pesquisa != ""){
                            var dados ={
                                palavra: pesquisa
                            }
                        $.post("../classes/search_cnae.php",dados,function(retorna){
                            $(".resultado").html(retorna);
                            console.log("ok");
                        });
                    }
                    else{
                        $(".resultado").html("");
                    }
                });
            });
        </script>
    </body>
</html>
