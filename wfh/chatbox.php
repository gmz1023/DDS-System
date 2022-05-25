<?php
require_once('bootstra.php');

if($_SESSION['uid'] == 1)
{
	if(!isset($_GET['submit']))
	{
	echo "<div style='width:100vw; height: 20vh; border-bottom:1px solid black; overflow: scroll;'>";
	include('log.php');
	echo "</div>";
	echo "<form action='chatbox.php?submit=true' method='post'>";
	?>
	<table>
		<tr><td>Send As</td><td>
		<select name='uid'>
			<option value='2'>J.Lake</option>
			<option value='3'>H.Wilson</option>
			<option value='4'>Gist</option>
			<option value='5'>Ray Harris</option>
			<option value='6'>D Whitmore</option>
			<option value='7'>Jay Martinez</option>
			<option value='8'>T. Circuo</option>
			<option value='9'>Shannon Davis</option>
			<option value='10'>Mitch Carter</option>
			<option value='19'>UNKNOWN</option>
		</select>
			</td><td>Message</td><td><input type='text' name='msg'></td></tr>
		<tr><th colspan='2'><input type='submit'></th></tr>
</table>
		<?php
	}
	else
	{
		$ai = new comrad($db);
		$uid = $ai->getUsername($_POST['uid']);
		$msg = $uid.' : '.$_POST['msg'];
		$sql = "INSERT INTO console(body) VALUE (:msg);";
		$que = $db->prepare($sql);
		$que->bindParam(':msg',$msg);
		try { 
			$que->execute();
			header('location:chatbox.php');
		}catch(PDOException $e) { die($e->getMessage());}
	}
}
else
{
	?>
You are not authorized to be here.
<?php
}