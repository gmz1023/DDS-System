<?php
require_once('bootstra.php');
$ai = new comrad($db);
				$username = $ai->getUsername($_SESSION['uid']);
	$msg = $username." has left the system";

	$ai->insertThought($msg,'now()');
session_destroy();
header('location:index.php');
?>