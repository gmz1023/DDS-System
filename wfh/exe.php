<?php
require_once('bootstra.php');
$pass = $base->password_protected($_POST['prog']);
if($pass)
{
	?>
<script type='text/javascript'>
	$(document).ready(function() { 
		$('#security_check').unbind().on("submit",function(){
			$(this).effect('shake');
			
		});
	});
</script>
<div class="explorer noselect">
    <div class="explorer-space">
      <div class="status">
		  <div class="tab active"><i class="material-icons foldericon">SECURITY CHECK</i></div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
      </div>
	<div class='security'>
	<form id='security_check' onSubmit="event.preventDefault()">
	<h1>Password Required</h1>
		<input type='password'>
		<button>Enter</button>
	</form>
	</div>
<?php
}
else
{
	switch($_POST['type'])
	{
		//Explorer
		case 'folder':
		include('programs/explorer.php');
		break;
		case 'computer':
		include('programs/explorer.php');
		break;
		// "Note Pad" programes -- files that display text only.
		case 'source':
		include('programs/notepad.php');
			// Reserved
			break;
		case 'note':
		include('programs/notepad.php');
			// Reserved
			break;
		/*
		
				Specific Sub Programs
			
		*/
		case 'terminal':
			include('programs/console.php');
		break;
		case 'inbox':
			//Emails
		include('programs/email.php');
		break;
		case 'email':
			//Emails
		include('programs/view_email.php');
		break;
		/*
		
			MEDIA PLAYERS
		
		*/
		case 'movie':
			include('programs/video.php');
			break;
		case 'photo':
			include('programs/photo.php');
		break;
		case 'article':

			include('programs/photo.php');
		break;
		case 'upgrade':
			include('programs/upgrades.php');
		break;
		case 'headphones':
			include('programs/audio.php');
			break;
		
		case 'sd_card_alert':
			include('programs/corrupt.php');
			break;

	}
}