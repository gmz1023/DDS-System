<?php
include('includes/db.php');
//$com = new comrad($db);
include('parts/head.php');
define("LIVE_SITE",false);
if(LIVE_SITE == true) {
	include('parts/body.php');
	include('parts/foot.php');
}
else
{
	include('coming-soon.php');
}

?>


