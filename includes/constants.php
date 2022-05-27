<?php

ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
define("LIVE",'local');

switch(LIVE)
{
	case "local":
	define("DB_HOST", 'localhost');
	define("DB_USER", 'root');
	define("DB_PASS", '');
	define("DB_NAME", "aslo2");
		break;
	case "live":
		define("DB_HOST", 'localhost');
		define("DB_USER", 'terrible_lie');
		define("DB_PASS", '1j2F94wSY!oa');
		define("DB_NAME", "aslo2");
		break;
}
//Old Aslo Site Required Constants

define('INC',realpath( dirname( __FILE__ )).'/');
date_default_timezone_set("America/New_York");

	require_once('functions.php');

?>