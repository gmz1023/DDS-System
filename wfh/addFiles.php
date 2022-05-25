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

function recusion($db, $did = 0)
{
	$sql = "SELECT * FROM desktop WHERE parent_id = :did";
	$que = $db->prepare($sql);
	$que->bindParam(':did',$did);
	try { 
		$que->execute();

		while($row = $que->fetch(PDO::FETCH_ASSOC))
		{
			echo "<li class='list'>{$row['desktop_id']} ".$row['name']."<ul>";
			recusion($db,$row['desktop_id']);
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

	$sql = "INSERT INTO desktop(material_icon,name,parent_id) VALUES(:mi,:n,:pid)";
	$que = $db->prepare($sql);
	$que->bindParam(':mi',$_POST['ftype']);
	$que->bindParam(':n',$_POST['name']);
	$que->bindParam(':pid',$_POST['parent']);
	try { 
		$que->execute();
			if(strlen($_POST['desc']) > 0)
			{
				$sql = "INSERT INTO document_contents(content_body,content_title,doc_id) VALUES (:cb,:n,:last)";
				$que = $db->prepare($sql);
				$last = $db->lastInsertId();
				$que->bindParam(':cb',$_POST['desc']);
				$que->bindParam(':n',$_POST['name']);
				$que->bindPAram(':last',$last);
				try { $que->execute();}catch(PDOException $e) { die($e->getMessage());}
			}
		header('location:addFiles.php');
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
		<tr><td>Name</td><td><input type='text' name='name'></td></tr>
		<tr><td>File Type</td><td>
				<select name='ftype'>
					<option value='folder'>Folder</option>
					<option value='movie'>Movie</option>
					<option value='headphones'>Audio Log</option>
					<option value='note'>Note</option>
					<option value='article'>article</option>
				</select>
			</td></tr>
		<tr><td>Description</td><td><textarea type='text' name='desc'></textarea></td></tr>

		<tr><td>Requires</td>
			<td>
			<select name='parent'>
				<option value='0'>None</option>
				<?php
					$sql = "SELECT desktop_id, name FROM desktop WHERE material_icon NOT IN ('headphones','article','movie','terminal','upgrade','note')";
					$que = $db->prepare($sql);
					try { 
						$que->execute();
						while($row = $que->fetch(PDO::FETCH_ASSOC))
						{
							echo "<option value='{$row['desktop_id']}'>{$row['name']}</option>";
						}
					}catch(PDOException $e) { die($e->getMessage());}
				?>
			</select></td>
		</tr>
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