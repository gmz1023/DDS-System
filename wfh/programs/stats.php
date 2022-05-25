<table class='statistics'>
	<thead>
	<th colspan=2>Community Stats</th>
	</thead>
	<tr>
	<td class='stat_name'>Number of Reboots</td>
	<td class='stat_numb'><?= $ai->game_settings('restarted'); ?></td>
	</tr>
	<tr>
	<td class='stat_name'>Number of Users</td>
	<td class='stat_numb'><?= $ai->countUsers(); ?></td>
	</tr>
	<tr>
	<td class='stat_name'>System Version</td>
	<td class='stat_numb'><?= $ai->version(); ?></td>
	</tr>
	<tr>
	
	</tr>
</table>