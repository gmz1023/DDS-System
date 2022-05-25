<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/db.php');
$ai = new comrad($db); 
?>
<script>
$(document).ready(function() {

	$('.atab').unbind().on('click',function(){
		$('.inuse').removeClass('inuse');
		var id = '#'+$(this).data('tab');
		$('.infotab').hide();
		$(id).show();
	})

});
$(document).ready(function(){
	$('.upgrade button').unbind().click(function() 
	{ 
		var val = $(this).val();
		var sub = $(this).attr('data-id');
		var uid = $(this).attr('data-uid');
		$.ajax(
				{
				url:'vote.php',
					method:"POST",
					data: {'val':val,'sub':sub,'uid':uid},
					success:
						function(data)
							{
								//alert(data);
								if(data == 'reset')
									{
										//alert(data);
										window.location.reload();
										location.reload();
									}
								$('#prog_win').load('exe.php',{'type':'upgrade'})
							},
					error:
						function()
							{
								alert("Something Went Wrong!")
							}
				})
	})
});
</script>
<div class="explorer upgrade-container">
<div class="explorer-space">
      <div class="status">
        <div class="tab active"><i class="material-icons foldericon">launch</i>Initialize</div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
	</div>
	<div class='pre-tabs'>
	<a  class='atab' data-tab='upgrade_holder'>Available Upgrades</a><a class='atab' data-tab='info'>About DD</a><a class='atab' data-tab='stats'>Statistics</a>
	</div>
	<div class="file-space" id='upgrades'>
	<?php echo "<div id='upgrade_holder' class='infotab inuse'>".$ai->getUpgrades()."</div>"; ?>
		<div id='info' class='infotab'>
			<?php include('ddtext.php'); ?>
		</div>
		<divv class='infotab' id='stats'><?php include('stats.php'); ?></divv>
	</div>
</div>