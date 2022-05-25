<?php
require_once('bootstra.php');
if(isset($_SESSION['uid']) && $_SESSION['uid'] == 1)
{
function unlockedItems($sid)
{
	$sql = "SELECT name FROM desktop WHERE requires_upgrade = :sid";
	$que = $db->prepare($sql);
	$que->bindParam(':sid',$sid);
	try { $que->execute();}catch(PDOException $e) { die($e->getMessage());}
	
}

function recusion($db, $sid = 0)
{
	$sql = "SELECT * FROM subsystem WHERE requires in (:sid)";
	$que = $db->prepare($sql);
	$que->bindParam(':sid',$sid);
	try { 
		$que->execute();

		while($row = $que->fetch(PDO::FETCH_ASSOC))
		{
			$active = $row['status'] != 0 ? 'is active' : 'offline';
			echo "<li class='list'>{$row['sub_id']} ".$row['text']." <b>{$active}</b> <ul>";
			recusion($db,$row['sub_id']);
			echo "</ul>";
		}
	}catch(PDOException $e) { die($e->getMessage());}
	
}
function game_settings($db,$name)
{
	$sql = "SELECT setting_value FROM settings WHERE setting_name = :name";
	$que = $db->prepare($sql);
	$que->bindParam(':name',$name);
	try { 
		$que->execute();
		$row = $que->fetch(PDO::FETCH_ASSOC);
		return $row['setting_value'];
	}catch(PDOException $e) { die($e->getMessage());}
}
if(isset($_GET['add']))
{
	$req = implode(',',$_POST['requires']);
	$blo = implode(',',$_POST['blocks']);
	$sql = "INSERT INTO 
				subsystem(
					text,
					requires,
					disallow,
					description,
					votes_required,
					linger,
					corruption) 
			VALUES
				(
				:text,
				:req,
				:block,
				:desc,
				:vr,
				:linger,
				:corruption
				);
				";
	$que = $db->prepare($sql);
	$que->bindParam(':text',$_POST['text']);
	$que->bindParam(':desc',$_POST['description']);
	$que->bindParam(':req',$req);
	$que->bindParam(':block',$blo);
	$que->bindParam(':vr',$_POST['vr']);
	$que->bindParam(':linger',$_POST['linger']);
	$que->bindParam(':corruption',$_POST['corrupt']);
	try {
		$que->execute();
		header('location:addSub.php');
	}catch(PDOException $e) { die($e->getMessage());}

}
else
{
?>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/jquery-ui.js"></script>

<style>
	#container {
	}
	.existingSub {
		height: 80vh;
		width: 60vw;
		overflow: scroll;
		border-left: 1px solid black;
		float: right;
	}
	.newSub {
		width: 15vw;
		float: left;
	}
	ul {
		margin-left: 5px;
		padding: 2px 0 0 2px;
		list-style: none;
	}
	.header{
		flex: 1;
		width: 100vw;
		background-color: #ccc;
	}
	.black { background-color: #000;}
</style>
<body>
			<div class='header'><?php 
 				$sql = "SELECT 
							count(*) as tots 
						FROM 
							subsystem"; 
 				$que = $db->prepare($sql); 
 				try { 
					$que->execute(); 
					$row = $que->fetch(PDO::FETCH_ASSOC);
					echo "Total Sub Systems:".$row['tots'];
				}catch(PDOException $e) {die($e->getMessage());} 
				echo "  |  Current Restart:".game_settings($db,'restarted');
				
				?></div>
	<div id='container'>

		<div class='newSub'>
			<form action='?add=true' method='post'>
	<table>
		<tr><td>Name</td><td><input type='text' name='text'></td></tr>
		<tr><td>Description</td><td><textarea type='text' name='description'></textarea></td></tr>
		<tr><td>Requires</td>
			<td>
			<select name='requires[]' multiple>
				<option value='0' selected>None</option>
				<?php
					$sql = "SELECT sub_id, text FROM subsystem";
					$que = $db->prepare($sql);
					try { 
						$que->execute();
						while($row = $que->fetch(PDO::FETCH_ASSOC))
						{
							echo "<option value='{$row['sub_id']}'>{$row['text']}</option>";
						}
					}catch(PDOException $e) { die($e->getMessage());}
				?>
			</select></td>
		</tr>
		<tr><td>Disallow</td>
			<td>
			<select name='blocks[]' multiple>
				<option value='0' selected>None</option>
				<?php
					$sql = "SELECT sub_id, text FROM subsystem";
					$que = $db->prepare($sql);
					try { 
						$que->execute();
						while($row = $que->fetch(PDO::FETCH_ASSOC))
						{
							echo "<option value='{$row['sub_id']}'>{$row['text']}</option>";
						}
					}catch(PDOException $e) { die($e->getMessage());}
				?>
			</select></td>
		</tr>
		<tr><th colspan=2 style='text-align: left;'>Fail State</th></tr>
		<tr><td>On<input type="radio" name='fail' value='1'></td><td>Off <input name='fail' type='radio' value='0' checked></td></tr>
		<tr><td>linger</td><td><input type="number" name='linger' value='0'></td></tr>
		<tr><td>votes</td><td><input type="number" name='vr' value='45'></td></tr>
		<tr><td>corruption</td><td><input type="number" name='corrupt' value='0'></td></tr>
		<tr><td><input type=submit></td></tr>
	</table>

</form>
		</div>
		
	<div class='existingSub'>
	<ul>
	<?= recusion($db); ?>
		</div>
<?php
}
}
?>
	</div>
</body>