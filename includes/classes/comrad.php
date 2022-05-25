<?php
class comrad extends config
{
	
	public function __construct($db)
	{
		$this->db = $db;
	}
	private function count_titles($tid)
	{
		$sql = "INSERT INTO title_counter VALUES (:tid,1) ON DUPLICATE KEY UPDATE appearances = appearances+1;";
		$que = $this->db->prepare($sql);
		$que->bindParam(':tid',$tid);
		try {
			$que->execute();
		}catch(PDOException $e) { die($e->getMessage());}
	}
	public function random_title()
	{
		$sql = "SELECT 
					t.tit_id,
					t.title_text,
					t.title_weight,
					c.appearances
				FROM
					titles as t,
					title_counter as c
				WHERE
					(t.title_weight+c.appearances) >= (RAND() * (SELECT appearances FROM title_counter ORDER BY appearances DESC LIMIT 1) + 1)
				ORDER BY RAND()";
		$que = $this->db->prepare($sql);
		try {
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			$this->count_titles($row['tit_id']);
			return $row['title_text'];
			
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function isLoggedIn()
	{
		if(isset($_SESSION['uid']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function getUsername($uid)
	{
		$sql = "SELECT username FROM users WHERE uid = :uid";
		$que = $this->db->prepare($sql);
		$que->bindParam(':uid',$uid);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['username'];
		}catch(PDOException $e) {die($e->getMessage());}
	}
	function nonemptyDirectory($uid,$img)
	{  
		$sql = "SELECT 
					da.program_name as name,
					da.pid as progid
				FROM
					desktop_applications as da,
					user_documents as ud
				WHERE
					da.pid = ud.program_id
					AND
					ud.uid = :uid
				GROUP BY
					name;
		";
		$html = '';
		$que = $this->db->prepare($sql);
		$que->bindParam(':uid',$uid);
		try {
			$que->execute();
			while($row = $que->fetch(PDO::FETCH_ASSOC))
			{
				$html .= "<li ";
				$html .= !$img ? "class='mitem-cont prog' data-prog='{$row['progid']}'>" : "><i class='material-icons'>folder</i>"; 
				$html .= "{$row['name']}</li>";
			}
		}catch(PDOException $e){ die($e->getMessage());}
		return $html;			
	
	}
}
