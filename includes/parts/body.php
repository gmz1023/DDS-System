<div class='tl-body'>
	<?php
if(!isset($_GET['m']))
{
	include('mod/default.php');
}
else
{
	$file = $ai->getPage($_GET['m'])['template'];
	$file = INC.'/parts/mod/'.$file;

	if(file_exists($file))
	{
		include($file);
	}
}
?>
</div>