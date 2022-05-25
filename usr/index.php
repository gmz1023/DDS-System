<?php
$max = 15;
require_once('tracker.php');
$_SESSION['tracker'] = 3;
?>
<html>
<head>
<title>ASLO Employee File Directory</title>
<link rel='stylesheet' href="style.css">
	<script src="assets/jquery.js"></script>
	<script src='assets/js.js'></script>
	</head>

<body>
<div class="container">
	<div class='hidden content'></div>
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div id="logo-container">ASLO FILE DIRECTORY</div>
      <div class="col-sm-12 col-md-10 col-md-offset-1">
      	<form method="get" action='search.php'>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input class="form-control" type="text" name='file'>          
          </div>
            <input type='submit' value='search' <?php if($_SESSION['tracker'] == 3) { echo "onClick='test()'"; } ?> />
          </div>
        </form>        
      </div>  
    </div>    
  </div>
</div>
</body>
	
</html>