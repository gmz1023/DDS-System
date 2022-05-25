<div class='emenu'>
	<a href=''>Inbox</a>
	<a href=''>Spam</a>
</div>
<div class='email'>
	<?php 
		if(!isset($_GET['eid']))
		{
		echo $ai->emails($_SESSION['uid']); 
		}
		else
		{
			$email = $ai->view_email($_GET['eid'],$_SESSION['uid']);
			echo $email;
		}
	?>
	</div>
</div>