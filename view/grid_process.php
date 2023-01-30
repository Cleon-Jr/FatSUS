<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Process.php';

$db = new Database();
$conn = $db->Connect();

$process = new Process($conn);


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
        <link rel="stylesheet" href="../assets/css/timeline_style.css">
        
    </head>
    <body>
        <div class="content-page">
            <h4 align="right">Processos Registrados</h4>
            <hr>
            
            <div class="container-fluid">
                <!-- button -->
                <a href="process_register.php" class="btn btn-success" title="Abrir novo processo"><i class="material-icons">note_add</i> Novo Processo</a>
                
                <table class="table table-bordered table-hover">
                    <tr id="tb_head">
                        <td align="center">ID</td>
                        <td align="center">Nº do Processo</td>
                        <td align="center">Data de Abertura</td>
                        <td align="center">Hora de Abertura</td>
                        <td>Status</td>
                        <td align="center" colspan="3">Ações</td>
                    </tr>
                    <?php 
                        $stmt = $process->getAllProcess();                         
                            if($stmt->rowCount() > 0){
                                while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td align="center"><?php echo $row['pro_id'];?></td>
                        <td align="center"><?php echo $row['pro_numero'];?></td>                        
                        <td align="center"><?php echo $row['pro_data'];?></td>
                        <td align="center"><?php echo $row['pro_hora'];?></td>
                        <td><?php echo $row['pro_status'];?></td>
                        <td align="center" width="120"><a href="#" class="btn btn-info" title="Visualizar processo"><i class="material-icons">visibility</i></a></td>
                        <td align="center" width="120"><a href="#" class="btn btn-warning" title="Editar processo"><i class="material-icons">edit</i></a></td>
                        <td align="center" width="120"><a href="#" class="btn btn-danger" title="Excluir processo"><i class="material-icons">delete</i></a></td>
                    </tr>
                    <?php                                
                                }
                            }
                            else{
                                echo "<td align='center' colspan=7><div class='alert-danger'><strong>Não foram encontrados processos registrados!</strong></div></td>";
                            }
                    ?>
                    <tr id="status">
                        <td colspan="5"></td>
                        <td colspan="3" align="right"><strong><?php echo "Nº de processos registrados: ".$stmt->rowCount();?></strong></td>
                    </tr>
                </table>
            </div>
        </div>        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            function showProgress(){                
                document.getElementById('myProgressbar').classList.toggle('showbar');
                document.getElementById('boxTimeline').classList.toggle('showTimeline');
            }
        </script>
    </body>
</html>
