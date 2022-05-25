<div id='welcome'><h1>
	<?php
	$ai = new comrad($db);
	$corp = $ai->game_settings('restarted');
	if($corp > 0)
	{
		$array = array('A VAST AND EMPTY PLAIN','VIOLENT EMPTY','WELCOME BACK OATMAN','WELCOME BACK, ████','WELCOME BACK COMMANDER','WELCOME BACK, NICHOLAS', 'WELCOME BACK TIANA');
		shuffle($array);
		echo $array[0];
	}
	else
	{
		echo "WELCOME BACK COMMANDER";
	}
	?>
		
		</h1></div>
<div class="login" id='login'>
	<div class="loading">
		<img src='../assets/style/desktop/imgs/coeus_os_2.png' width='100%'>
		<?php 
		echo "<h1 style='color:white'> Version ".$ai->version()."</h1>";	
		?>
	</div>
  <form method="post" onSubmit="event.preventDefault()">
    <input type="text" name="username" id='user' placeholder="Username" required="required" />
    <input type="password" name="password" id='pass' placeholder="Password" required="required" />
	  <button type="submit" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
</div>