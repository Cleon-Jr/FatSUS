<!DOCTYPE html>
<?php
require_once '../inc/Database.php';
require_once '../classes/Cnae.php';

$db = new Database();
$conn = $db->Connect();

$cnae = new Cnae($conn);

$self = $_SERVER['PHP_SELF'];
$start_p = 0;

$limit =50;

    $sql = "select * from tb_cnae";
    $stmt = $conn->query($sql);
    
$total_records = $stmt->rowCount();

$total_pages = ($total_records / $limit);

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <?php
            if($total_records > 0){
        ?>
        <div class="pagination">
        
            <?php
                $current_page = 1;
                    if(isset($_GET['page_no'])){
                        $current_page = $_GET['page_no'];
                    }
                    if($current_page != 1){
                        $previous = $current_page - 1;
                        echo "<li><a href='".$self."?page_no=1'>First</a></li>";
                        echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
                    }                      
//                    for($i = 1; $i < $total_pages; $i++){
//                        if($i == $current_page){
//                            echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
//                        }
//                        else{
//                            echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
//                        }
//                    }
                       if($current_page!=$total_pages)
                       {
                           $next=$current_page+1;
                           echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
                           echo "<li><a href='".$self."?page_no=".$total_pages."'>Last</a></li>";
                        }
                    ?></ul><?php
            }
                echo "<br><< Total de páginas -".$total_pages." >><br>";
                
                ?>
        </div>
                    
    </body>
</html>
