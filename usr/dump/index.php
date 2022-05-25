<?php 
$max = 15;
require_once('../tracker.php'); ?>
<html>
	<head><title>Access Denied</title></head>
<style>
	.error {
		margin: 0 auto;
		width: 40vw;
		word-break: break-all;
		
	}
</style>
	<body>
	<div class='error'>
		<h1>Access Denied</h1>
<p>You've reached somewhere you shouldn't be!</p>
<p>If you believe this to be in error please <a href='support@aslo.tech'> Contact Us</a></p>

	<?php
$t = $_SESSION['tracker'];
	echo $t."<br/>";
switch($t)
{
	case $t >= 99 && $t <= 99:
		echo "These Violent Delights have violent ends";
	break;
	case $t >= 0 && $t <= 5:
		echo "SSdtIHNjYXJlZCwgT2F0bWFuIC0tIHdoYXQgaWYgd2UgZG9uJ3QgbWFrZSBpdCBvdXQ/IHdoYXQgaWYgdGhpcyBpcyB0aGUgbGFzdCBvZiB1cy4gSSBzYXcgd2hhdCB0aGV5IGRpZCB0byB0aGUgc2VyZ2VhbnQuLi4gSSBkb24ndCB3YW50IHRvIGVuZCB1cCB0aGF0IHdheSwgbWFuLiBJIGRvbid0IHdhbnQgdG8gYmVjb21lIGxpa2UgdGhhdC4gIA==";
	break;
	case $t >= 6  && $t <= 10:
		echo "R2V0IHlvdXIgc2hpdCB0b2dldGhlciBtYW4sIHdlJ3JlIG5vdCBnb2luZyB0byBlbmQgdXAgbGlrZSB0aGVtLiBUaGlzIHRoaW5nIGlzIHN1cHBvc2VkIHRvIHRha2UgdXMgYmFjayBob21lIC0tIG9yIHdlbGwuLi4gc29tZXdoZXJlIGxpa2UgaG9tZS4gd2UncmUgZ29pbmcgdG8gYmUgZmluZS4gSSBwcm9taXNlIHlvdS4=";
	break;
	default:
		echo "";
		break;
}
?>
		</div>
	</body>
</html>