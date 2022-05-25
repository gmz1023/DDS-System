<?php
$xml = simplexml_load_file('distilled_visions.xml');
echo "<div id='terminal'>";
foreach($xml as $comm)
{
	echo "<div class='msg'>".$comm."</div>";
}
echo "</div>";
?>