<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Estados.php';

$db = new Database();
$conn = $db->Connect();

$uf = new Estados($conn);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            //5cbfdd758e431b2e7817ab9fada59986
            //2e6911158115b5cb4c94323cfdde48bf
           $data = date('d-m-Y');
           echo $data."<br>";
            $token2 = bin2hex("cleon".$data);
             $token1 = md5("");
            //$token = bin2hex("123456");
            
            echo "Token 1 md5 ".$token1."<br>";
            echo "Token 2 bin2hex ".$token2;
            
                
        ?>
        <br>
        <hr>
            <label>Estados</label>
            <select name="uf" id="uf">
                <option value="">Escolha um Estado</option>
                <?php
                    $stmt = $uf->getAll();
                        while($row = $stmt->fetch(pdo::FETCH_ASSOC)){
                ?>                
                <option value="<?php echo $row['id'];?>"><?php echo $row['uf'];?></option>
                <?php
                        }
                ?>
            </select>
            <!--<input type="submit" value="getcnae" name="ok">-->
            <label>Cidades</label>
            <select name="Desc" id="cidade">
                <option value=""></option>
            </select>
            
            <div class="resultado"></div>
            <input type="submit" name="salvar" value="salvar">
        
        
            
            
            <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>
            <!--<script type="text/javascript">
                $(document).ready(function(){
                    $('#numero').change(function(){
                        //alert('Numero '+$('#numero').val());
                        $('#desc').load('get_desc.php?ncnae='+$('#numero').val());
                    });
                });
            </script> -->
            
        
        <script type="text/javascript">
            $('#uf').change(function(){
                var idEstado = $('#uf').val();
                //alert(idEstado);
                $.ajax({
                    url:'get_cidade.php',
                    type:'POST',
                    data:{id:idEstado},
                    beforeSend: function(){
                        $('.resultado').html('Carregando...');
                    },
                    success: function(data){
                        //$('#cidade').html(data);
                        $('.resultado').html(data);
                    }                    
                });
            });
        </script> 
        
    </body>
</html>
