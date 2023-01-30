<?php

if($_FILES["file"]["name"] != ""){
    $test = explode(".", $_FILES['file']['name']);
    
    $extension = end($test);
    $name = date('dmyhis')."logo.".$extension;
    $location = '../assets/uploads/logomarca/'.$name;
    
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
    
//    echo '<img src="'.$location.'"height="150" width="255" class="img-thumbnail">';
      //echo "<embed id='viewpdf' src='./upload/$name' type='application/pdf' width='50%'>";
    echo $name;
}
