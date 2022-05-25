<?php
include( 'bootstra.php' );
$base = new comrad( $db );
$corrupt = $base->active_corruption();
if ( $base->isLoggedIn() ) {
  ?>
<script>
(function() {
  'use strict';

  function getDate() {
    var date = new Date();
    var weekday = date.getDay();
    var month = date.getMonth();
    var day = date.getDate();
    var year = date.getFullYear();
    var hour = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();

    if (hour < 10) hour = "0" + hour;
    if (minutes < 10) minutes = "0" + minutes;
    if (seconds < 10) seconds = "0" + seconds;

    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    var weekdayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    
    var monthColors = ["#1E90FF", "#FF69B4", "#00FFFF", "#7CFC00", "#00CED1", "#FF1493", "#00008B", "#FF7F50", "#C71585", "#FF4500", "#FFD700", "#800000"]

    var ampm = " PM ";

    if (hour < 12) ampm = " AM ";

    if (hour > 12) hour -= 12;

    var showDate = weekdayNames[weekday] + ", " + monthNames[month] + " " + day + ", " + year;

    var showTime = hour + ":" + minutes + ":" + seconds + ampm;
    
    var color = monthColors[month];

    document.getElementById('date').innerHTML = showDate;

    document.getElementById('time').innerHTML = showTime;
    
    document.bgColor = color;
    

    requestAnimationFrame(getDate);
  }

  getDate();

}());
</script>
<div class='deskcon noselect'>
  <div id='htbar'>
    <div class='hstation home'>Options
      <div class='hstation drop'>
        <div class='mitem'>
          <div class='mitem-cont' data-prog='logout'><a href='logout.php'>Restart</a></div>
        </div>
      </div>
    </div>
    <div class='hstation home'>Recent
      <ul class='hstation drop'>
		  
<?php
	
	$sql = "SELECT 
				d.material_icon, 
				d.name, 
				d.desktop_id,
				d.requires_upgrade as ru
			FROM 
				desktop as d
			WHERE 
				uid in(:uid,0)
			AND
				in_menu = 1
			ORDER BY 
				desktop_id 
			DESC LIMIT 5;";
	$que = $db->prepare($sql);
	$que->bindParam(':uid',$_SESSION['uid']);
	try { 
		$que->execute();
		while($row = $que->fetch(PDO::FETCH_ASSOC))
		{
			if($base->is_sys_enabled($row['ru']))
			{
				if($base->active_corruption())
				{
				echo "
			    <div class='mitem'>
          		<div class='mitem-cont prog' data-prog='{$row['desktop_id']}' data-type='{$row['material_icon']}'><a>{$row['name']}</a></div>
		  		</div>";	
				}
				else
				{
				echo "
			    <div class='mitem'>
          		<div class='mitem-cont prog' data-prog='{$row['desktop_id']}' data-type='{$row['material_icon']}'><a>{$row['name']}</a></div>
		  		</div>";	
				}

				
			}
		}
	
	}catch(PDOException $e) {}
	
?>
        <li class='mitem blksp'>&nbsp;</li>
      </ul>
    </div>
    <?php 
		if(!$corrupt){ 
	  ?>
	  <div class='hstation prog' data-prog='null' data-type='inbox'>Email</div>
	  <?php 
		} else { 
	  ?>
	  <div class='hstation prog' data-prog='null' data-type='inbox'>HELP ME</div>
	  <?php } ?>
    <div class='hstation wtspc'>&nbsp;</div>
    <div class='hstation wtspc'>&nbsp;</div>
    <div class='hstation wtspc'>&nbsp;</div>
    <div class='hstation dock' id='clock'>  <div style='display:none' id="date"></div>
  <div id="time"></div></div>
  </div>
  <div id='desktop'> 
    <!-- Desktop Start !-->
    <?php
    $base->desktop_display( 0 );
    ?>
  </div>
</div>
<?php
} else {
  include( 'login_form.php' );
}
?>
