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
        <link rel="stylesheet" href="../assets/css/grid_style.css">
        
    </head>
    <body>
        <div class="content-page">            
            <h4 align="right">Empresas Cadastradas</h4>
            <hr>
            <div class="container-fluid">
                <!-- button -->
                <a href="frm_company.php" target="iframe" class="btn btn-success" title="Adicionar empresa"><i class="material-icons">note_add</i>Adicionar</a>
                
                <table class="table table-hover table-bordered">
                    <tr id="tb_head">
                        <td align="center">ID</td>         
                        <td>Nome Fantasia</td>                        
                        <td>Atividade Principal</td>                        
                        <td>Telefone 1</td>
                        <td>Telefone 2</td>
                        <td>E-mail</td>
                        <td colspan="3" align="center">Ações</td>                        
                    </tr>
                    
                    <tr>
                        <td align="center"></td>
                        <td></td>
                        <td align="center"></td>
                        <td></td>
                        <td></td>
                        <td></td>                        
                        <td align="center"><a href="#" class="btn btn-info" title="Visualizar"><i class="material-icons">visibility</i></a></td>
                        <td align="center"><a href="#" class="btn btn-warning" title="Editar"><i class="material-icons">edit</i></a></td>
                        <td align="center"><a href="#" class="btn btn-danger" title="Excluir"><i class="material-icons">delete</i></a></td>
                    </tr>
                    
                    <tr id="status">
                        <td colspan="6"></td>
                        <td colspan="3" align="right"><strong>Nº de empresas cadastradas: 87</strong></td>
                    </tr>
                </table>
                
            </div>
        </div>
        
        
        
        
        
        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>
