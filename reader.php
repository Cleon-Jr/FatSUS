<!DOCTYPE html>
<?php
require_once './classes/csv.class.php';
require_once './inc/Database.php';

$db = new Database();

$conn = $db->Connect();

//$csv = new \ARQUIVOS\Csv('movimentos_financeiros.csv',',','"');

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        

<!--        <style> 
#Progress_Status { 
  width: 50%; 
  background-color: #ddd; 
} 
  
#myprogressBar { 
  width: 2%; 
  height: 20px; 
  background-color: #4CAF50; 
}
</style> -->
    </head>
  
    <body>
  <!--      <p>Download Status of a File:</p> 
  
            <div id="Progress_Status"> 
              <div id="myprogressBar"></div> 
            </div> 

            <br> 
            <button onclick="update()">Start Download</button>  
            <br>
            <br>-->
        <?php
        
        $arquivo = fopen('./file_cnae.csv', 'r');
        $contador = 0;
            if($arquivo){
                
                while($line = fgets($arquivo)){                                                            
                    $partes = explode(",", $line);
                    $num_cnae = @$partes[0];
                    $desc_cnae = @$partes[1];
                    
                    $sql = "insert into tb_cnae values(null,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array($num_cnae,$desc_cnae));
                        if($stmt){
                            echo "Ok";
                        }
                        else{
                            return false;
                        }
                }
                
            }
            fclose($arquivo);
        
               
        
        //  $i++;
    //$percent = intval($i/$num_rows * 100)."%"
        
        /////////////////////////////////////////////
//        $arquivo = fopen('./file_cnae.csv', 'r');
//        
//            while(!feof($arquivo)){
//                $linha = fgets($arquivo,1024);                
//                echo str_replace(",", "", $linha)."<br>";
//            }
        ////////////////////////////////////////////////    
        
        
        
        
        /////////////////////////////////////////////////////////////////////// 
       /* $lines = file ('file_cnae.csv',FILE_SKIP_EMPTY_LINES);
        
            // Percorre o array, mostrando o fonte HTML com numeração de linhas.
        
            foreach ($lines as $line_num => $line) {
             
                    echo htmlspecialchars($line) . "<br>\n";
            }                   */     
        ////////////////////////////////////////////////////////////////////////
        
//            while($linha = fgets($arquivo)){
//                var_dump($linha);
//                //echo $linha."<br>";
//            }
//                
                
            
//            while(!feof($arquivo)){
//                $linha = fgets($arquivo);
//                echo $linha."<br>";
//            }
                                    
        
        
        /*
        $csv = new \ARQUIVOS\Csv('paptclin.jan',',','"');
        //$data = $importer->ler();
        //$data = $importer->numRows();
        //print_r($data);
        foreach($csv->ler('paptclin.jan')as $linha){
        var_dump($linha);}
            /*
            $idmovimento = $linha['idmovimento'];
            $idusuario = $linha['idusuario'];
            $data = $linha['data'];
            $valor = $linha['valor'];
            $liquidado = $linha['liquidado'];
                if($linha['descricao'] == ""){
                    $descricao = "0";
                }
                else{
                    $descricao = $linha['descricao'];                    
                }            
            $idcategoria = $linha['idcategoria'];
            $status = $linha['status'];
            
            
            try {
                $sql = "insert into tbgrana values(?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array($idmovimento,$idusuario,$data,$valor,$liquidado,$descricao,$idcategoria,$status));
                    if($stmt){
                        echo "ok<br>";                        
                    }
                    else{
                        echo "Error!";
                    }
                
            } catch (Exception $e) {
                echo "Error. ".$e->getMessage();
            }                        
            
        }
             
        $sql = "select * from tbgrana";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
                        
        $num = $stmt->rowCount();
            
        echo "Número de registros: ".$num;
        */
        ?>
        
        
        <script type="text/javascript">
            function update() { 
                var element = document.getElementById("myprogressBar");    
                var width = 1; 
                var identity = setInterval(scene, 10); 
                function scene() { 
                  if (width >= 100) { 
                    clearInterval(identity); 
                  } else { 
                    width++;  
                    element.style.width = width + '%';  
                  } 
                } 
            } 
        </script>
        
    </body>
</html>
