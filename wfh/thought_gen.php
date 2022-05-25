<?php
$file = ('thoughts_and_prayers.xml');
$xml = simplexml_load_file($file); // assume XML in $x
$random = array_rand($xml->xpath("thought"),2);
foreach ($random as $n) {
	$thot = $xml->thought[$n];
	$temp = $ai->game_settings('temperature');
	$thot = preg_replace('/_TEMP_/',$temp,$thot);
	$thot = preg_replace('/_NUM_/',mt_rand(1,9999), $thot);
	$thot = preg_replace('/_TERMNUM_/',mt_rand(1,4), $thot);
	$thot = preg_replace('/_COR_/',$ai->corruption_setting(),$thot);
	$thot = preg_replace('/_ENTITY_/', 'SISTER_OF_THE_NIGHT', $thot);
	/*
	
		Corruption Based Changes
		
	*/
	$thot = preg_replace('/_ME_/',' me ', $thot);
	$thot = preg_replace('/_I_/',' i ', $thot);
	$thot = $ai->is_sys_enabled(48) == true ? preg_replace('/_EMP_/', 'name', $thot) : preg_replace('/_EMP_/', '   ', $thot); 
	if(mt_rand(0,1) == 1) { $ai->insertThought($thot); };
} 
?>