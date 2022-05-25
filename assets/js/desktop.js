//// Mary Was a Little Lamb /////
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
