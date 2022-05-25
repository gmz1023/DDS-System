<?php
class email extends documents
{
	function getEmployeeName($eid)
	{
		$sql = "SELECT username FROM users WHERE uid = :eid";
		$que = $this->db->prepare($sql);
		$que->bindParam(':eid',$eid);
		try { $que->execute();
				$row = $que->fetch(PDO::FETCH_ASSOC);
			 return $row['text'];
			
			}catch(PDOException $e) { die($e->getMessage());}
	}
}