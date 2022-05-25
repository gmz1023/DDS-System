<?php
class upgrades extends email
{
	function autoUpdate()
	{
		$sql = "UPDATE 
					subsystem as s
				SET 
					s.status = 1 
				WHERE 
					(SELECT count(*) FROM votes WHERE sys = s.sub_id  AND choice = 1) >= votes_required";;
		try { $this->db->exec($sql);}catch(PDOException $e) { die($e->getMessage());}
	}
	function is_sys_enabled($sid)
	{
		if($sid == 0)
		{
			return -1;
		}
		else
		{
		$sql = "SELECT floor(sum(status)/count(status)) as status FROM subsystem WHERE sub_id IN ({$sid})";
		$que = $this->db->prepare($sql);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['status'];
		}catch(PDOException $e) { die($e->getMessage());}
		
		}
	}
	function hasAlreadyVoted($sid,$uid)
	{
		$sql = "SELECT count(vid) as total FROM votes WHERE uid = :uid AND sys=:sid";
		$que = $this->db->prepare($sql);
		$que->bindParam(':sid',$sid);
		$que->bindParam(":uid",$uid);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			return $row['total'];
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function NumberOfVotes($sid)
	{
		$sql = "SELECT
					sys,
					(SELECT count(*) FROM votes WHERE sys = :sid AND choice = 1) as yes,
					(SELECT count(*) FROM votes WHERE sys = :sid AND choice = 2) as no
				FROM
					votes
	 			";
		$que = $this->db->prepare($sql);
		$que->bindParam(':sid',$sid);
		try { $que->execute();
			 $v = $que->fetch(PDO::FETCH_ASSOC);
			 $n = !isset($v['no']) ? 0 : $v['no'];
			 $y = !isset($v['yes']) ? 0 : $v['yes'];
			 return array('y'=>$y,'n'=>$n);
			
			 }catch(PDOException $e) { die($e->getMessage());}
	}
	function firstVoteTime($sys)
	{
		$sql = "SELECT first_vote FROM votes WHERE sys = :sys ORDER BY first_vote ASC LIMIT 1";
		$que = $this->db->prepare($sql);
		$que->bindParam(':sys',$sys);
		try { 
			$que->execute();
			$row=$que->fetch(PDO::FETCH_ASSOC);
			
				return empty($row['first_vote']) ? 0 : $row['first_vote'] ;

		}catch(PDOException $e) { die($e->getMessage());}
	}
	function setStatus($sys,$d1,$va)
	{
		$d1 = new DateTime($d1);
		$now = new DateTime("NOW");
		if($d1 < $now)
		{
			$stat = $va['y'] > $va['n'] ? 1 : -1;
			$sql = "UPDATE subsystem SET status = :stat WHERE sub_id = :sys";
			$que = $this->db->prepare($sql);
			$que->bindParam(":sys",$sys);
			$que->bindParam(':stat',$stat);
			try { $que->execute();}catch(PDOException $e) { die($e->getMessage());}
		}
		else
		{
			return false;
		}
		die();
	}
	function getUpgrades()
	{
		$this->autoUpdate();
		$sql = "SELECT * FROM subsystem WHERE status = 0";
		$que = $this->db->prepare($sql);
		try { 
				$que->execute();
			$html = '';
			while($row = $que->fetch(PDO::FETCH_ASSOC))
			{
				
				$va = $this->NumberOfVotes($row['sub_id']);
				$en = $this->is_sys_enabled($row['requires']);
				$ds = $this->is_sys_enabled($row['disallow']);
				$o_time = $this->firstVoteTime($row['sub_id']);
				if($en == 0 || $ds == 1)
				{
				}
				else
				{
				$disabled = $this->hasAlreadyVoted($row['sub_id'],$_SESSION['uid']) <> 0 ? 'disabled' : 'enabled';
					$html .= "<div class='upgrade'>";
					$html .= "<h1>{$row['text']}</h1>";
					$html .= "<div class='desc'>";
					$html .= "<p>{$row['description']}</p>";
					$html .= "</div>";
					$html .= "<div class='voter'>";
					$html .= "<button data-id='{$row['sub_id']}' data-uid='{$_SESSION['uid']}' value='1' {$disabled}>Enable</button>";
					$html .= "<button data-id='{$row['sub_id']}' data-uid='{$_SESSION['uid']}' value='2' {$disabled}>Disable</button>";
					$html .= "</div>";
					$html .= "<div class='votes'>For: {$va['y']}/ Against: {$va['n']}</div>";
					if($o_time <> 0)
						{ 		
							$time = new DateTime($o_time);
							$time = $time->format('Y-m-d H:i:s');
							$this->setStatus($row['sub_id'],$time,$va);
							$html .= "<div class='timer' data-date='{$time}'></div>"; 
						}
					$html .= "</div>";
				}
			}
			return $html;
		}catch(PDOException $e) { die($e->getMessage());}
	}
}