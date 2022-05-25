<?php
class site
{
	function getPage($pid)
	{
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
		$sql = "SELECT template FROM page_info WHERE page_id = :pid OR pseudo = :pid LIMIT 1";
		$que = $this->db->prepare($sql);
		$que->bindParam(':pid',$pid);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row;
		}catch(PDOException $e) { die($e->getMessage());	}
	}


}