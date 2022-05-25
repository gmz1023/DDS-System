<?php
class documents  extends upgrades{
  function __construct( $xml ) {
  }
function password_protected($pid)
{
	$sql = "SELECT password_protected as pp FROM desktop WHERE desktop_id = :pid";
	$que = $this->db->prepare($sql);
	$que->bindParam(':pid',$pid);
	try { 
		$que->execute();
		$row = $que->fetch(PDO::FETCH_ASSOC);
		return $row['pp'];
	} catch(PDOException $e) { die($e->getMessage);}
}
function progName($pid)
  {
	  $sql = "SELECT name,material_icon as icon FROM desktop WHERE desktop_id = :pid;";
	  $que = $this->db->prepare($sql);
	  $que->bindParam(':pid',$pid);
	  try { 
		  $que->execute();
		  $row = $que->fetch(PDO::FETCH_ASSOC);
		  return $row;
		  }catch(PDOException $e) { die($e->getMessage());}
  }
function truncate($string,$length=10,$appendStr="..."){
    $truncated_str = "";
    $useAppendStr = (strlen($string) > intval($length))? true:false;
    $truncated_str = substr($string,0,$length);
    $truncated_str .= ($useAppendStr)? $appendStr:"";
    return $truncated_str;
}
  function desktop_display( $pid ) {
    $sql = "SELECT 
					d.material_icon as icon,
					d.name,
					d.desktop_id,
					d.requires_upgrade as ru,
					d.alt_name,
					d.password_protected
				FROM
					desktop as d
				WHERE
					d.parent_id = :pid
				AND
					d.uid IN (:uid,0)
				AND
					d.date_available <= NOW()
				AND
				((SELECT setting_value FROM settings WHERE setting_name = 'restarted' LIMIT 1) >= d.linger OR d.linger = 0)
				AND
				((SELECT setting_value FROM settings WHERE setting_name = 'restarted' LIMIT 1) >= d.corruption)
				ORDER BY
				date_available ASC
					
					";
    $que = $this->db->prepare( $sql );
    $que->bindParam( ':pid', $pid );
	$que->bindParam( ':uid', $_SESSION['uid'] );
    try {
      $que->execute();
      while ( $row = $que->fetch( PDO::FETCH_OBJ ) ) {
		  if($this->is_sys_enabled($row->ru))
		  {
			  if($this->active_corruption())
			  {
				  	if($row->desktop_id == 2)
				  	{
				  	echo "<div class='item prog short' data-prog={$row->desktop_id} data-type={$row->icon}><span class='material-icons' >{$row->icon}</span><a>{$row->name}</a></div>";;
			  		}
				  else
				  {
					 echo "<div class='item prog short' data-prog={$row->desktop_id} data-type={$row->icon}><span class='material-icons' >sd_card_alert</span><a>{$row->alt_name}</a></div>";; 
				  }
			  }
			  else
			  {
				  echo "<div class='item prog short' data-prog={$row->desktop_id} data-type={$row->icon}><span class='material-icons' >{$row->icon}</span><a>{$row->name}</a></div>";;
      			}
		  }
	  }
    } catch ( PDOException $e ) {
      die( $e->getMessage() );
    }
  }

  function notepad( $pid ) {
    $sql = "SELECT
					p.name,
					dc.content_body,
					dc.content_title,
					p.parent_id,
					k.material_icon as type
				FROM
					document_contents as dc,
					desktop as p,
					desktop as k
					
				WHERE
					dc.doc_id = :pid
					AND
					dc.doc_id = p.desktop_id
				LIMIT 1;
					";
    $que = $this->db->prepare( $sql );
    $que->bindParam( ':pid', $pid );
    try {
      $que->execute();
      $row = $que->fetch( PDO::FETCH_ASSOC );
      return $row;
    } catch ( PDOException $e ) {
      die( $e->getMessage() );
    }

  }
}