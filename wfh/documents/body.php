<div class='tl-body'>
	<div class='ndmrsp'>
	<?php
if(!isset($_GET['m']))
{
	include(AT_INC.'mod/default.php');
}
else
{
	$file = $ai->getPage($_GET['m']);
	$file = AT_INC.'mod/'.$file;
	if(file_exists($file))
	{
		include($file);
	}
}
?>
	</div>
</div>