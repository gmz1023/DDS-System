<?php
	
	require_once('bootstra.php');
	$sql = "INSERT INTO votes(uid,choice,sys,first_vote) VALUES (:uid,:val,:sys,:fv)";
	$que = $db->prepare($sql);
	$que->bindParam(':val',$_POST['val']);
	$que->bindParam(':sys',$_POST['sub']);
	$que->bindParam(':uid',$_POST['uid']);
	$time = new DateTime('NOW');
	$time->modify('+'.mt_rand(1,2880).' minutes');
	$time = $time->format('Y-m-d H:i:s');
	$que->bindParam(':fv',$time);
try {
	$que->execute();
}catch(PDOException $e) { die($e->getMessage());}

	echo $base->failsafereached();
?>