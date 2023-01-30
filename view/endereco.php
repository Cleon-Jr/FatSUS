<!DOCTYPE html>
<?php
    function getEndereco($cep){
        //removendo os caracteres nao numéricos
        $cep = preg_replace("/[^0-9]/", "", $cep);
        $url = "http://viacep.com.br/ws/$cep/xml/";
        
        $xml = simplexml_load_file($url);
        
        return $xml;
    }
    
        if(!empty($_POST)){
            $cep = $_POST['cep'];
            $end = getEndereco($cep);
            
            $rua = $end->logradouro;
			$complemento = $end->complemento;
			$bairro = $end->bairro;
			$uf = $end->uf;
            echo $rua;
        }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="post">
            CEP: <input type="text" name="cep" size="30" value="">
            <input type="submit" value="Procurar">
        </form>
        <form>
            Rua: <input type="text" name="rua" value="<?php echo @$rua;?>">
        </form>
    </body>
</html>
