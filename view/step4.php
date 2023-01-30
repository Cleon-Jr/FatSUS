<!DOCTYPE html>
<?php
session_start();

date_default_timezone_set("America/Manaus");

    if(isset($_SESSION['usuario']) && empty($_SESSION['usuario']) == false){
        
    
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome=1">
        <meta name="viewport" content="width=device-width,  initial-scale=1, shrink-to-fit=no">
        
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
                <li class="active"><span class="badge-pill badge-success">4</span></li>
                <li class="active"><span class="badge-pill badge-light">5</span></li>
                <li class="active"><span class="badge-pill badge-light">6</span></li>
            </ul>
            <br>
            
            <h2>Requerimento</h2>            
            <h4 align="right">Processo: <?php echo @$_SESSION['processo'];?></h4>
        </header>
        
        
        <div class="container">            
            <form>
                <div class="row">  

                    <div class="col-md-4">
                        <label>Mês de Competência</label>
                        <select name="competencia" id="competencia" class="form-control">
                            <option value="">Selecione...</option>
                        </select>
                        <br>
                        <label>Enviar Documento</label>
                        
                        
                    </div>                                        

                    <div class="col-md-8">
                        <embed id="viewpdf" src="" type="application/pdf" width="40%" height="450">
                    </div>

                </div>
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