<?php
include('bootstra.php');
function recusion($db, $sid = 0)
{
	$sql = "SELECT * FROM subsystem WHERE requires = :sid";
	$que = $db->prepare($sql);
	$que->bindParam(':sid',$sid);
	try { 
		$que->execute();
		while($row = $que->fetch(PDO::FETCH_ASSOC))
		{
			echo "<li>{$row['sub_id']} ".$row['text'].'<ul>';
			recusion($db,$row['sub_id']);
			echo "</ul>";
		}
	}catch(PDOException $e) { die($e->getMessage());}
	
}
?>
<style>
	ul {
		margin: 10px;
		padding: 0;
		list-style: none;
		
	}
</style>

<ul>
<?= recusion($db); ?>