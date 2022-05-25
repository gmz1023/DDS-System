<div class='explorer email-container'>
    <div class="explorer-space">
      <div class="status">
		  <div class="tab active"><i class="material-icons foldericon">email</i>Email</div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
      </div>
<table class='inbox'>
	<thead>
	<tr><th>#</th><th>Sender</th><th>Subject</th><th>Date</th></tr>
	</thead>
	<tbody>
<?php
		$sql = "SELECT
					e.eid,
					(SELECT username FROM users WHERE uid = e.sender) as username,
					e.reciever,
					e.title,
					e.sent_on 
				FROM 
					emails as e
				WHERE 
					e.reciever = :uid
					or
					e.reciever = 0
				AND
					sent_on < NOW()
				ORDER BY
					e.sent_on DESC";
		$que = $db->prepare($sql);
		$que->bindParam(':uid',$_SESSION['uid']);
		try { 
			$que->execute();
			$x = 1;
			while($row = $que->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr class='email prog' data-type='email' data-prog='{$row['eid']}'><td>{$x}</td><td>{$row['username']}</td><td class='middle'>{$row['title']}</td><td>{$row['sent_on']}</td></tr>";
				$x = $x+1;
			}
		}catch(PDOException $e) { die($e->getMessage());}
?>
	</tbody>
	<tfoot>

	</tfoot>
</table>
</div>