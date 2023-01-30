<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/material-icons.css">
        <link rel="stylesheet" href="assets/css/timeline_style.css">
        
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Indicador</h2>
                <div class="progress-container">
                    <div class="progress-bar" role="progressbar" id="myBar"></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Time Line</h4>
                    
                    <ul class="timeline">
                        <li>
                            <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                            <a href="#" class="float-right">21 March, 2014</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>
                        
                        <li>
                            <a href="#">21 000 Job Seekers</a>
                            <a href="#" class="float-right">4 March, 2014</a>
                            <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                        </li>
                        
                        <li>
                            <a href="#">Awesome Employers</a>
                            <a href="#" class="float-right">1 April, 2014</a>
                            <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                            <a href="#" class="float-right">21 March, 2014</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>
                        
                        <li>
                            <a href="#">21 000 Job Seekers</a>
                            <a href="#" class="float-right">4 March, 2014</a>
                            <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                        </li>
                        
                        <li>
                            <a href="#">Awesome Employers</a>
                            <a href="#" class="float-right">1 April, 2014</a>
                            <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                        </li>
                        <br>
                        <li>
                            <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                            <a href="#" class="float-right">21 March, 2014</a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                        </li>
                        
                        <li>
                            <a href="#">21 000 Job Seekers</a>
                            <a href="#" class="float-right">4 March, 2014</a>
                            <p>Curabitur purus sem, malesuada eu luctus eget, suscipit sed turpis. Nam pellentesque felis vitae justo accumsan, sed semper nisi sollicitudin...</p>
                        </li>
                        
                        <li>
                            <a href="#">Awesome Employers</a>
                            <a href="#" class="float-right">1 April, 2014</a>
                            <p>Fusce ullamcorper ligula sit amet quam accumsan aliquet. Sed nulla odio, tincidunt vitae nunc vitae, mollis pharetra velit. Sed nec tempor nibh...</p>
                        </li>
                    </ul>
                </div>
            </div>                        
        </div>
        
        <div class="text-muted mt-5 mb-5 text-center small">by : <a class="text-muted" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>
        
        
        
        
        <script type="text/javascript" src="assets/js/jquery-3.4.0.min.js"></script>
        <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            // When the user scrolls the page, execute myFunction 
            window.onscroll = function() {myFunction()};

                function myFunction() {
                  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                  var scrolled = (winScroll / height) * 100;
                  document.getElementById("myBar").style.width = scrolled + "%";                  
                }
        </script>
    </body>
</html>
