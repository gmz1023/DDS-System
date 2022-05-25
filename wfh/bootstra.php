<?php
// Define Absolute Directory
if(!defined('ABS')){
	define('ABS',$_SERVER['DOCUMENT_ROOT']);
}
//DEFINES Directory Shortcuts
	define('AT_INC',ABS.'/includes/');
	define('AT_CONTENT',ABS.'/content/');
	define('AT_CLASS',AT_INC.'classes/');
//* Final Includes *//

include(AT_INC.'/functions.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/db.php');
define("OS_DRIVE",ABS.'\operating_system');

$base = new comrad($db);
?>