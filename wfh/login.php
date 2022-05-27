<?php
include('bootstra.php');
$ai = new comrad($db);

if(!isset($_POST['username']) || !isset($_POST['password']))
{
	return false;
}
else
{
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$sql = "SELECT uid,security_level,password FROM users WHERE username = :user LIMIT 1";
	$que = $db->prepare($sql);
	$que->bindParam(':user',$user);
	try { 
		if($que->execute()){ 
			if($que->rowCount() == 0)
			{
				echo false;
			}
			else{$row = $que->fetch(PDO::FETCH_ASSOC);
			if(password_verify($_POST['password'],$row['password']))
			{
				$_SESSION['uid'] = $row['uid'];
				$_SESSION['sl']  = $row['security_level'];
								$username = $ai->getUsername($_SESSION['uid']);
				$msg = $username." has accessed the system";
				$date = 'now()'; 
				$ai->insertThought($msg,$date);
				echo true;

			}
			else
			{
				echo false;
			}
			
			}
		}
			else
			{
				echo false;
			}

		
	}catch(PDOException $e) { die($e->getMessage());}
}

?>