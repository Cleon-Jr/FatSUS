<!DOCTYPE html>
<?php
//session_start();
//
//    if(isset($_SESSION['usuario']) && empty($_SESSION['usuario']) == false){
//        
//                
//        
//    if(isset($_GET['action'])){
//        if($_GET['action'] == "logout"){
//            
//            session_unset($_SESSION['id_manager']);
//            session_unset($_SESSION['usuario']);
//            session_unset($_SESSION['userid']);
//            session_unset($_SESSION['setor']);
//            
//            session_destroy();
//            
//            header("location: ./");
//        }
//    }
//    
//require_once './inc/Database.php';
//require_once './classes/User.php';
//require_once './classes/Manager.php';
//
//$db = new Database();
//$conn = $db->Connect();
//
//$user = new User($conn);
//$stmt = $user->getAll();
//
//$man = new Manager($conn);
//$stmt_man = $man->getManager();
//    if($stmt_man->rowCount() > 0){
//        while($row = $stmt_man->fetch(pdo::FETCH_ASSOC)){
//            $id_manager = $row['man_id'];
//            $fantasia = $row['man_fantasia'];
//            $cnpj = $row['man_cnpj'];
//            $cnes = $row['man_cnes'];                        
//        }
//        $notification = "";
//        $_SESSION['id_manager'] = $id_manager;
//        $_SESSION['fantasia'] = $fantasia;
//        $_SESSION['cnpj'] = "CNPJ - ".$cnpj;
//        $_SESSION['cnes'] = "CNES - ".$cnes;
//    }
//    else{
//        echo "<script>"
//        ."alert('Nenhum Gestor foi registrado ainda. Registre um Gestor para o sistema!');"
//        . "</script>";
//        $notification = 1;        
//    }
//
//?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>FatSUS Processos</title>
        
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/material-icons.css">
        <link rel="stylesheet" href="assets/css/general_style.css">
        <link rel="stylesheet" href="assets/css/timeline_style.css">
        
    </head>
    <body>
        <!-- Barra de navegação -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top">
            <!-- Navbar-brand -->            
            <a class="navbar-brand" href="view/start_page.html" target="iframe">
                <img class="img-fluid" src="assets/images/logo_fatsus-white-t1.png">
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
                        <a class="nav-link" href="view/start_page.html" target="iframe"><span class="sr-only"></span>Home</a>
                    </li>                    
                    <li class="nav-item" id="config">
                        <a class="nav-link" href="#">Configurações <span class="badge badge-danger"><?php echo @$notification;?></span></a><!-- Submenu configurações -->
                        <div id="submenu_config">
                            <ul>
                                <li class="nav-item"><a href="view/frm_manager.php" target="_parent"><i class="material-icons">account_box</i> Gestor do Sistema <span class="badge badge-danger"><?php echo $notification;?></span></a></li>
                            </ul>                            
                        </div>
                        
                    </li>
                    <li class="nav-item">
                        <!-- Chamando a pergunta para decisão de logout -->
                        <a class="nav-link" href="#" onclick="logout();" title="Sair do sistema">Sair</a>
                    </li>                    
                </ul>
            </div>            
        </nav>
        <!-- end Navbar -->
        
        <!-- Menu Button -->
        <i class="material-icons"><a href="#" onclick="showMenu()" title="Abrir Menu">reorder</a></i>        
        
        <!-- Side Menu -->        
        <div class="box-menu" id="boxMenu">
            <div class="user-reg" align="center">
                <!-- Button Close -->
                <i class="material-icons"><a href="#" title="Fechar" onclick="showMenu()">close</a></i>
                
                <img class="img-fluid" src="assets/images/user2-t.png">
                <h4 align="center"><?php echo @$_SESSION['usuario'];?></h4>
                <h6 align="center"><?php echo @$_SESSION['setor'];?></h6>
                <span align="center" style="font-size: 12px;"><?php echo "CNS: ".@$_SESSION['cns'];?></span>                
                <hr width="70%">
            </div>
            <!-- Items -->
            <div id="menuItems">
                <ul>
                    <a href="view/start_page.html" target="iframe" onclick="showMenu()"><li><i class="material-icons">home</i> Home</li></a>
                    <a href="view/grid_process.php" target="iframe" onclick="showMenu()"><li><i class="material-icons">library_books</i> Processos</li></a>
                    <a href="#cadastros" data-toggle="collapse" aria-expanded="false" aria-controls="cadastros"><li><i class="material-icons">create</i> Cadastros</li></a>
                    <div class="collapse" id="cadastros">
                        <ul id="sub_menu">                            
                            <a href="view/grid_company.php" target="iframe" onclick="showMenu()"><li><i class="material-icons">business</i> Empresa</li></a>
                            <a href="view/grid_user.php" target="iframe" onclick="showMenu()"><li><i class="material-icons">person</i> Usuários</li></a>
                            <a href="view/grid_cnae.php" target="iframe" onclick="showMenu()"><li><i class="material-icons">format_list_bulleted</i> CNAE</li></a>
                        </ul>
                    </div>                    
                    <a href="#"><li>Item 3</li></a>
                    <a href="#"><li>Item 4</li></a>                    
                    <a href="#" onclick="logout();" title="Sair do sistema"><li><i class="material-icons">out</i> Sair</li></a>
                </ul>
            </div>
        </div>
        <!-- end Menu -->
                
        
        <!-- Iframe -->
                    
            <iframe name="iframe" id="Myframe" src="view/start_page.html" height="1" frameborder="0" width="100%" scrolling="yes" onLoad="calcHeight();"></iframe>
                    <?php                                                                              
                    /*
                        if($stmt->rowCount() > 0){
                            while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                                echo "Nome: ".$row['use_nome'];
                            }
                        }
                    */
                    ?>
        
        <!--<iframe id="Myframe" class="myframe" name="iframe" src="view/start_page.html" frameborder="0" width="100%" scrolling="no" style="height: 100vh;"></iframe>-->
            
                        
            
        <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
        
        <!-- Ajuste de altura do iFrame -->
        <script type="text/javascript">
            function calcHeight(){
                var the_Height = 0;
                    the_Height = document.getElementById('Myframe').contentWindow.document.body.scrollHeight;
                    document.getElementById('Myframe').height = the_Height;
                    
            }            
        </script> 
        
        <!-- Ativação do menu lateral -->
        <script type="text/javascript">
            function showMenu(){
                document.getElementById('boxMenu').classList.toggle('active');                
            }
        </script>                        
        
        
        <script type="text/javascript">
        function logout(){
                var answer = confirm('Tem certeza que deseja sair do sistema?');
                    if(answer){
                        //alert('Valor excluido é'+ id);
                        window.location = './?action=logout';
                    }
            }
        </script>  
                
        
        <!--  iFrame 100%...
        <iframe id="Myframe" class="myframe" src="view/frm_login.php" frameborder="0" width="100%" scrolling="no" onload="" style="height: 100vh;">
            
        </iframe> -->
    </body>
</html>
//<?php
//    }
//    else{        
//        header("location: ./view/frm_login.php");
//    }
//?>