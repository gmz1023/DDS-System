function bootText(t,txt)
{
	var t = t*0.5;
	$('.bootloader').delay(t).queue(function(next){
		var html = "<div class='sequence'>"+txt+"</div>";
		var last = $('.bootloader').children().first();
		var len = $('.bootloader').children().length;
		if(len >= 40)
			{
				last.remove();
			}
		$('.bootloader').append(html);
	}).dequeue();
}

$(document).ready(
	function()
	{
		if($('#erroid').length > 0)
			{
				$.ajax({
					url:'terminal.php',
					dataType:'text',
					success: function(data){
						var arr = JSON.parse(data);
						var i;
						for(i = 0; i < arr.length; ++i)
							{
								bootText(arr[i]['t'],arr[i]['txt']);
							}
					}
				})
			}
		
	}
	
	
);