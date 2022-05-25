<!doctype html>
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.php');
$ai = new comrad($db);
if(isset($home))
{
	$style = 'logo';
}
?>
<html>
	<head>
	<meta charset="utf-8">
	<title><?php echo PAGE_NAME($v); ?></title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Terminal+Dosis" />
		<?php
		echo "<link rel='stylesheet' href='/assets/style/dd/css.css'>";
?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type='text/javascript' src='../../assets/js/TimeCircles.js'></script>
		<script type="text/javascript" src='../../assets/js/base.js'></script>

	</head>
	<?php echo "<body class='{$body}'>
		<div id='container' class='{$style}'>"; ?>
	
	