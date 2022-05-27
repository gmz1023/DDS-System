<?php
include('bootstra.php');
echo "<pre>";
function updatePassword($db,$arr)
{
	$sql = "UPDATE users SET password = :password WHERE uid = :uid";
	$que = $db->prepare($sql);
	$pass = password_hash($arr['pass'],PASSWORD_DEFAULT);
	$que->bindParam(':password',$pass);
	$que->bindPAram(':uid',$arr['uid']);
	try { 
		if($que->execute())
		{
			echo "WOO";
		}
		else
		{
			echo $sql;
		}
	
	}catch(PDOException $e) { die($e->getMessage());}
}
$sql = "SELECT uid,password FROM users";
$que = $db->prepare($sql);
try { 
	$que->execute();
	while($row = $que->fetch(PDO::FETCH_ASSOC))
	{
		$arr = array('pass'=>$row['password'],'uid'=>$row['uid']);
		updatePassword($db,$arr);
	}
}catch(PDOException $e) { die($e->getMessage());}