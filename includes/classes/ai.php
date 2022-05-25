<?php
class ai extends corruptor
{
	function insertThought($t,$time = 'NOW()')
	{
		$sql = "INSERT INTO console(body) VALUES (:t)";
		$que = $this->db->prepare($sql);
		$que->bindParam(':t',$t);
		//$que->bindParam(':time',$time);
		try { 
			if($que->execute())
			{
				return true;
			}
			else
			{
				return true;
			}
					}catch(PDOException $e) { die($e->getMessage());}
	}
	function activeUpgrades()
	{
		$sql = "SELECT count(sub_id) as total FROM subsystem WHERE status = 1";
		$que = $this->db->prepare($sql);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['total'];
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function version()
	{
			$a = $this->activeUpgrades();
			$n =$this->game_settings('restarted');
			$u = $this->countUsers();
			$value = floor(($n*$u)*($a*1.19)/19);
			return $value;
	}
	function countUsers()
	{
		$sql = "SELECT count(uid) as total FROM users WHERE security_level != 999";
		$que = $this->db->prepare($sql);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['total'];
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function game_settings($name)
	{
		$sql = "SELECT setting_value FROM settings WHERE setting_name = :name";
		$que = $this->db->prepare($sql);
		$que->bindParam(':name',$name);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['setting_value'];
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function corruption_setting()
	{
		$rest = $this->game_settings('restarted');
		$corp = $this->game_settings('corruption');
		$actual = ($corp+$rest) <= 100 ? $corp+$rest : 100;
		return $actual;
	}
}