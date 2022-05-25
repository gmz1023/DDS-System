<?php
class corruptor
{
	function __construct($db)
	{
		$this->db = $db;
	}
	function reset_counter()
	{
		$sql = "SELECT setting_value FROM settings WHERE setting_name = 'restarted' LIMIT 1";
		$que = $this->db->prepare($sql);
		try {
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			
			return $row['setting_value'];
		}catch(PDOException $e) { die($e->getMessage());}
	}
}