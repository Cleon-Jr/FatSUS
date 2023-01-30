<!DOCTYPE html>
<?php
 $arquivo = "679276comp.pdf";
 var_dump($_POST);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <style type="text/css">
        .container{
            width: 800px;
            margin: 30px auto;
            font-family: tahoma;
        }
        
        #viewpdf{
            width: 60%;
            height: 500px;
            border: 1px solid rgba(0,0,0,.2);
        }
    </style>
    <body>
                
        <div class="container">
        <div class="row">

        <div class="col-md-8">

        <h1><a href="#" target="_blank"><img src="logo.png" width="80px"/>Ajax File Uploading with Database MySql</a></h1>
        <hr> 

        <form id="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="name">NAME</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
        </div>
        <div class="form-group">
        <label for="email">EMAIL</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required />
        </div>
            
        <input id="uploadImage" type="file" accept="" name="image" />
        <div id="preview"><img src="filed.png" /></div><br>
        <input id="button" class="btn btn-success" type="submit" value="Upload">
        </form>

        <div id="err"></div>
        <hr>        
        </div>
        </div>
        </div>
        
        
        
        <div class="container">
            <h1>View PDF With jQuery</h1>        
            <embed id="viewpdf" src="../assets/uploads/<?php echo $arquivo;?>" type="application/pdf" width="100%">
        </div>
        

        <script type="text/javascript" src="../assets/js/jquery-3.4.0.min.js"></script>        
        
        <script type="text/javascript">
            $(document).ready(function (e) {                
 $("#form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "ajaxupload.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
    if(data=='invalid')
    {
     // invalid file format.
     $("#err").html("Invalid File !").fadeIn();
    }
    else
    {
     // view uploaded file.
     $("#preview").html(data).fadeIn();
     //$("#form")[0].reset(); 
     $("#viewpdf").attr('src','../assets/uploads/'+data);
     console.log(data);
    }
      },
     error: function(e) 
      {
    $("#err").html(e).fadeIn();
      }          
    });
 }));
});
        </script>
    </body>
</html>
