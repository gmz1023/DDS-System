<div class='explorer email-container'>
    <div class="explorer-space">
      <div class="status">
		  <div class="tab active"><i class="material-icons foldericon">email</i>Email</div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
      </div>
<?php
		$sql = "SELECT * FROM emails WHERE eid = :eid";
		$que = $db->prepare($sql);
		$que->bindParam(':eid',$_POST['prog']);
		try { 
			$que->execute();
			$row = $que->fetch(PDO::FETCH_ASSOC);
			?>
		<table class='single'>
			<thead>
			<tr><th>Subject</th><th><?= $row['title']?></th></tr>
			<tr><th>Sender</th><th><?= $row['sender'] ?></th></tr>
			</thead>
			<tbody>
			<tr><td class='body' colspan='2'><?= $row['body'] ?></td></tr>
			</tbody>
			<tfoot>
				<tr><td colspan='2'><a id='return'><button class='prog' data-prog='inbox' data-type='inbox'>Back To Inbox</button></td></tr>
			</tfoot>
		</table>
		<?php
		
		}catch(PDOException $e) { die($e->getMessage());}
?>