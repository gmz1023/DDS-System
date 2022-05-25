<!doctype html>
<?php include($_SERVER['DOCUMENT_ROOT'].'/includes/db.php');
?>
<html>
<head>
<meta charset="utf-8">
<title>Remote Desktop</title>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/jquery-ui.js"></script>
<link rel='stylesheet' href='../assets/style/desktop/stylesheets/screen.css' >
<link rel="stylesheet" href="https://use.typekit.net/dse5nnw.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
	<script src='../assets/js/base.js'></script>

	<script src='../assets/js/desktop.js'></script>

</head>

<body >
<?php
	$off = 1;
	if($off == 0)
	{
		?>
	<h1 style='color:white'>SYSTEM OFF LINE BE BACK SOON</h1>
	<?php
	}
	else
	{
		?>
<div id='container' class='active'>
	<?php if(!isset($_SESSION['uid'])) { ?> <div class='bootloader'></div> <?php } ?>
</div>
<?php } ?>
</body>
</html>