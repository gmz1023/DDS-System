<?php
require_once('tracker.php');
?>
<html>
<head>
<title>ASLO Employee File Directory</title>
<link rel='stylesheet' href="style.css">
	<script src="assets/jquery.js"></script>
	<script src='assets/js.js'></script>
</head>

<?php	
$xml =  simplexml_load_file('justlook.xml');
if($_SESSION['tracker'] >= 5)
{
	include('404.php');
	$_SESSION['tracker'] = 0;
	exit;
}
foreach($xml as $xml)
{
	if($_GET['file'] == $xml->name)
	{
		$file = $xml->fileloc;
		header('location:dump/'.$file);
	}
	else
	{
		echo "<div class='container'><div class='information'>
		<h1>No File Found</h1>
		<p>If you are not redirected soon, please <a href='index.php'>click here</a>
		</div></div>";
		?>
		<script type="text/javascript">
		window.setTimeout(function() {
			window.location.href='index.php';
		}, 5000);
	</script>
	<?php
		header('refresh:5; url:index.php;');
	}
}
