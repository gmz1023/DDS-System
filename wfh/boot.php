<?php
include('bootstra.php');
$boot = simplexml_load_file('boot.xml');
$array = [];
$base = new comrad( $db );
function replaceTxt($txt)
{
	$txt = preg_replace('^_NUM_^',mt_rand(1,10000),$txt);
	return $txt;
}
foreach($boot->item as $k)
{
	$at = $k->attributes();
	$ka = array('txt'=>(string)replaceTxt($at['txt']),'t'=>(string)$at['t']);
	if($at['repeat'] <> 0)
	{
		for($i = 0; $i < $at['repeat']; $i++)
		{
		array_push($array,$ka);
		}
	}
	else
	{
		array_push($array,$ka);
	}
}
echo json_encode($array);
?>