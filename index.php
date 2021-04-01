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
  <title>Anime Lover Gaming | Screenshots</title>
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
<body style="background-color: #101820FF;">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="http://www.algaming.tk">Anime Lover Gaming</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="http://www.algaming.tk">Home</a></li>
        <li class="active"><a href="http://www.algaming.tk/screenshots">Screenshots</a></li>
     	<li><a href="http://www.algaming.tk/statistics.php">Statistics</a></li>
        <li><a href="#" data-toggle="modal" data-target="#contactModal">Contact</a></li>
	<!-- Modal -->
      <div class="modal fade alert alert-info" id="contactModal" role="dialog">
        <div class="modal-dialog modal-sm">
          <div class="modal-content ">
            <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
            <div> <center>For any queries Contact<br><h2>[AL]Happy#9833</h2><br>At Discord</div>
          </div>
        </div>
      </div>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <!---<li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
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

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}

$per_page = 9;

$start_from = ($page - 1) * $per_page;
$stop_at = $start_from + $per_page - 1;

$files = scan_dir($src_folder);

$total_files = $files;
$tmp_files = array();

for($j=$start_from;$j<=$stop_at;++$j){
		if($j <= (count($files)-1) )
			array_push($tmp_files, $files[$j]);
	}

  $files = $tmp_files;

  $x = 1;
  foreach($files as $file) { 
	  echo	'<div class="col-sm-4">
						<div class="panel panel-primary">
						<div class="panel-heading">'. $file .'</div>
						<div class="panel-body"><img src="file_viewer.php?file='. base64_encode($src_folder . "/" . $file). '" class="img-responsive" style="width:100%; height: 250px;" alt="'. $file . '" data-toggle="modal" data-target="#'.$x.'myModal"></div>
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

<div class="container"><center>
<?php


$total_pages = ceil(count($total_files) / $per_page);


for($i=1;$i<=$total_pages;++$i){
	if($i == 1){
		echo '<ul class="pagination">';
	}
	if($page == $i){
		echo '<li class="active"><a href=?page='.$i.'>'.$i.'</a></li>';
	}else{
		echo '<li><a href=?page='.$i.'>'.$i.'</a></li>';
	}
	if($i >= $total_pages){
		echo "</ul>";
	}
}

?>

</center></div>

<br>

<footer class="container-fluid text-center">
  <p>Copyright 2020-2021 by <a href="http://algaming.tk">Algaming.tk</a>. All Rights Reserved.</p>  
</footer>

</body>
</html>
