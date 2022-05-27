<?php 
require_once('bootstra.php');
$ai = new comrad($db);
$corrupt = $ai->active_corruption();
if(mt_rand(0,10) == 1)
{
	if($ai->is_sys_enabled(43)) {
	include('thought_gen.php');
	}
}
else
{
	//do nothing
}
$sql = "SELECT * FROM console ";
$sql .=	"ORDER BY date ASC";
$que = $db->prepare($sql);
try { 
	$que->execute();
	$html = '';
	while($row = $que->fetch(PDO::FETCH_ASSOC))
	{
		
		$date  =  date_format(date_create($row['date']),"Y/m/d H:i:s");
		if($corrupt)
		{
			$text = 'AAAAAAAAAAAAAAAAAAAAAAAAAA';
			$date = '6/6/2006 07:06:69';
		}
		else
		{
			$text = $row['body'];
		}
		$array[] = array('msg'=>$text,'date'=>$date);
	}
	$html = json_encode($array);

}catch(PDOException $e) { die($e->getMessage()); }
	echo $html;


?>
