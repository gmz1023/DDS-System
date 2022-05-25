<?php
spl_autoload_register(function ($name) {
	$file = $name.'.php';

		$path = $_SERVER['DOCUMENT_ROOT'].'/includes/classes/'.$file;
	
	
try {
   	if (file_exists($path)) {
       require_once($path);
	  
   	} else {
       die("The file {$file} could not be found! \n");

   	}
}catch(exception $e) { echo $e->getMessage();}
});

function PAGE_NAME($V)
{
	echo 'ASLO TECHNOLOGIES-'.ucwords($V);
}
?>