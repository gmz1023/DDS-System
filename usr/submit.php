<?php
include('../includes/db.php');
$knowledge = array_sum($_POST['knowledge'])-array_sum($_POST['knowledgen']);
$rights = array_sum($_POST['rights'])-array_sum($_POST['rightsn']);
$humanity = array_sum($_POST['humanity'])-array_sum($_POST['humanityn']);
$contact = $_POST['email'].' gender selected is '.$_POST['gender'];
$results = "
	Knowledge Roll: {$knowledge} + {$_POST['obe']} 
	Rights Roll {$rights}-{$_POST['god']}
	Humanity Roll: {$humanity}-{$_POST['life']} 
	Heard about project through: {$_POST['hear']} 
	Ai would change us how: {$_POST['aiquest']}
	Why should you be selected: {$_POST['whysel']}
	-------------------------------------------
	{$contact}

";

$sql = "INSERT INTO questions(lazyresults) VALUES (:results);";
$que = $db->prepare($sql);
$que->bindParam(':results',$results);
try { 
	
	if($que->execute())
	{
	?>
	<h1>Application Submited!</h1>
	<p>You'll be hearing from us soon!</p>
		<script type="text/javascript">
		window.setTimeout(function() {
			window.location.href='index.php';
		}, 5000);
	</script>
<?php
	}
} catch(PDOException $e) { 
	
	echo "Something went wrong! ";

	die(); }
