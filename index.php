<?php

#██╗░░██╗░█████╗░██████╗░██████╗░██╗░░░██╗  
#██║░░██║██╔══██╗██╔══██╗██╔══██╗╚██╗░██╔╝
#███████║███████║██████╔╝██████╔╝░╚████╔╝░
#██╔══██║██╔══██║██╔═══╝░██╔═══╝░░░╚██╔╝░░
#██║░░██║██║░░██║██║░░░░░██║░░░░░░░░██║░░░
#╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░░░░╚═╝░░░░░░░░╚═╝░░░

$src_folder = 'C:\Users\WORK\Pictures\Screenshots'; # change to desired directory  ' /home/folder/images ' 


###################################
### DONT NOT CHANGE BELLOW CODE ###
###################################
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Screenshots</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>ALGAMING</h1>      
    <p>Free for all , Promod </p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://algaming.tk">ALGAMING.TK</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="http://algaming.tk">Home</a></li>
        <li class="active"><a href="http://algaming.tk/screenshots">Screenshots</a></li>
     <!--<li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li> -->
      </ul>
    </div>
  </div>
</nav>



<div class="container"> 
<div class="row">

<?php
function scan_dir($dir) {
	  $file_display = array('jpg', 'jpeg', 'png', 'gif');
      $files = array();
      foreach (scandir($dir) as $file) {
		  $tmp = explode('.', $file);
		  $file_type = strtolower(end($tmp));
          if (($file !== '.') && ($file !== '..') && (in_array($file_type, $file_display)))  {
			  $filemtime = filemtime($dir . '/' . $file);
			  $files[$file] = $filemtime; 
          }
      }

      arsort($files);
      $files = array_keys($files);

      return ($files) ? $files : false;
  }

  $files = scan_dir($src_folder);
  $x = 1;
  foreach($files as $file) { 
	  echo	'<div class="col-sm-4">
						<div class="panel panel-primary">
						<div class="panel-heading">'. $file .'</div>
						<div class="panel-body"><img src="file_viewer.php?file='. base64_encode($src_folder . "/" . $file). '" class="img-responsive" style="width:100%" alt="'. $file . '" data-toggle="modal" data-target="#'.$x.'myModal"></div>
						<div class="panel-footer">'. $file . ' - ' . date ("F d Y H:i:s.", filemtime($src_folder.'/'.$file)) .'</div>
						</div>
					</div>';
			$y = $x % 3;
			if($y == 0){
				echo '</div>    
					<div class="row">';
			}
			
	echo '<!-- Modal -->
		<div id="'.$x.'myModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">

					<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body">
						<img src="file_viewer.php?file='. base64_encode($src_folder . "/" . $file). '" class="img_responsive" style="width:100%;" alt="'. $file . '">
					</div>
				</div>

			</div>
		</div>';
		$x += 1;
  }
?>

</div>
</div><br>

<br>

<footer class="container-fluid text-center">
  <p>Copyright 2020-2021 by <a href="http://algaming.tk">Algaming.tk</a>. All Rights Reserved.</p>  
</footer>

</body>
</html>