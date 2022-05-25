<?php
class upgrades extends ai
{
	function __construct($db)
	{
		$this->db = $db;
	}
	function is_sys_enabled($sid)
	{
		/*
			checks if a system(s) are enabled
		*/
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

	function autoUpdate()
	{
		$this->failsafereached();
		//* Makes sure the upgrades are set to the correct status. May need to be retooled to a better method later on.
		$sql = "UPDATE 
					subsystem as s
				SET 
					s.status = 1 
				WHERE 
					(SELECT count(*) FROM votes WHERE sys = s.sub_id  AND choice = 1)/(select count(*) FROM users WHERE uid NOT IN (1,2,3,4,5,6,7,8,9,10,19) )*100 >= s.votes_required/(select count(*) FROM users)*10";
		try { 
			$this->db->exec($sql);
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function setStatus($sys,$d1,$va)
	{
		/*
			
			Updates the status of updates/substems.
		
		*/
		$d1 = new DateTime($d1);
		$now = new DateTime("NOW");
		if($d1 < $now)
		{
			$stat = $va['y'] > $va['n'] ? 1 : -1;
			$sql = "UPDATE subsystem SET status = :stat WHERE sub_id = :sys;";
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
	function failsafereached()
	{
		$sql = "SELECT count(FailPoint) as fp FROM subsystem WHERE status = 1 AND FailPoint = 1;";;
		$que = $this->db->prepare($sql);
		try { 
			$que->execute(); 
			$row = $que->fetch(PDO::FETCH_ASSOC);
			if($row['fp'] >= 1)
			{
				$this->resetTest();
				return "yolo";
			}
		}catch(PDOException $e) { die($e->getMessage());}
		
	}
	function resetTest()
	{
		$sql = "UPDATE subsystem SET status = 0 WHERE (linger = 0) OR linger = -1; TRUNCATE votes; UPDATE settings SET setting_value = setting_value+1 WHERE setting_name = 'restarted';";
		$que = $this->db->prepare($sql);
		try { $que->execute();}catch(PDOException $e) { die($e->getMessage());}
	}
	function active_corruption()
	{
		$sql = "SELECT sum(corruption) as fp FROM subsystem WHERE status = 1;";;
		$que = $this->db->prepare($sql);
		try { 
			$que->execute(); 
			$row = $que->fetch(PDO::FETCH_ASSOC);
			if($row['fp'] <= 0)
			{
				return false;
			}
			else
			{
				return true;
			}
		}catch(PDOException $e) { die($e->getMessage());}
	}
	function hasAlreadyVoted($sid,$uid)
	{
		/*
			
			Checks if the user has already voted. used to prevent double votes
		
		*/
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
		//* Gets the number of votes from the system
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
	function getUpgrades()
	{
		/*
		
			Gets and displays the updates.
			Needs to be retooled to be cleaner code
		
		
		*/
		$this->autoUpdate();
		$sql = "SELECT 
				s.sub_id,
				s.requires,
				s.disallow,
				s.text,
				s.description,
				s.votes_required/(select count(*) FROM users)*10 as vr,
				(SELECT count(*) FROM votes WHERE sys = s.sub_id  AND choice = 1)/(select count(*) FROM users WHERE uid NOT IN (1,2,3,4,5,6,7,8,9,10,19))*100 as current
				FROM 
					subsystem as s 
				WHERE
					(s.status = 0
					AND
					date_available <= NOW())
					AND
					((SELECT setting_value FROM settings WHERE setting_name = 'restarted' LIMIT 1) <= s.linger OR s.linger = 0)
					";
		$que = $this->db->prepare($sql);
		try { 
				$que->execute();
			$html = '';
			$x = 1;
			while($row = $que->fetch(PDO::FETCH_ASSOC))
			{
				if(count($row) == 0)
				{
					
				}
				else{
					$va = $this->NumberOfVotes($row['sub_id']);
					$en = $this->is_sys_enabled($row['requires']);
					$ds = $this->is_sys_enabled($row['disallow']);
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
						$vr = number_format($row['vr'],2);
						$cu = number_format($row['current'],2);
						$html .= "<div class='votes'>Requires {$vr}% out of {$cu}%</div>";
						$html .= "</div>";				
						$html .= "</div>";
					}
				}
			}
			if(strlen($html) == 0)
			{
				$html = "
					<div class='upgrade warning'>
					<h1>Nothing to See Here</h1>
					<p>There are currently no System Upgrades available, please restart your system or check back later</p>
					</div>";
			}
			return $html;
		}catch(PDOException $e) { die($e->getMessage());}
	}
}