<?php
class config extends documents {
	public $intelev;
	
	function __construct()
	{
	}
	private function returnAllFrom($table)
	{
		$sql = "SELECT * FROM {$table}";
		$que = $this->db->prepare($sql);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row;
		}catch(PDOException $e) { die($e->getMessage());}
	}
	public function userCount()
	{
		$sql = "SELECT count(uid) as tots FROM testers";
		$que = $this->db->prepare($sql);
		try { $que->execute();
			 	$row = $que->fetch(PDO::FETCH_ASSOC);
			 return $row['tots'];
			}catch(PDOException $e) { die($e->getMessage());}
	}

}