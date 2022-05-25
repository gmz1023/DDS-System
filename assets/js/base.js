////////////////////////////////////
// 			T.I.N.A.G			  //
////////////////////////////////////
function close() {
  $('#close').on("click", function () {
    $(this).closest('.popup').remove();
  })
}
function loadProg()
{
	$('.prog').unbind().on({
		click: function() { 
			$('.active').removeClass('active');
			var progid = $(this).data('prog');
			var type = $(this).data('type');
			if(type == 'file_download')
				{
					window.open("index.php");
				}
			else
				{
					$.ajax({
						url:'exe.php',
						type:"POST",
						data: {
							prog: progid,
							type: type
						},
						success: function(data) {
							if($('#prog_win').length == 0) {
								var newData = "<div class='popup' id='prog_win'>" + data + "</div>";
								$('body').append(newData);
								$('body').children('.popup').draggable({
								handle: '.move',
								cursorAt: {
								  top: 0,
								  left: 0
								},
								scroll: false
							  });
							close();
							loadEmail();
							loadProg();
							}
							 else {
          						$('#prog_win').html(data);
          						close();
								loadEmail();
								loadProg();
        					}
						}
					})
				}
		}
	})
}
function loadProgOld() {
  $('.prog').unbind().on({
	  click: function () {

    $.ajax({
      url: 'exe.php',
      type: "POST",
      data: {
        prog: progid,
        type: type
      },
      success: function (data) {
        if ($('#prog_win').length == 0) {
          var newData = "<div class='popup' id='prog_win'>" + data + "</div>";
          $('body').append(newData);
          $('body').children('.popup').draggable();

        }
      }
    })
  },
	  mouseenter:function() { $(this).toggleClass('short');},
	  mouseleave:function() { $(this).toggleClass('short');}
  }
						 
)
}

function menu() {
  $('.hstation').unbind().on({
    mousedown: function () {
	 	$('.active').removeClass('active');
      $(this).children('.drop').toggleClass('active')
    }
  });
	$('#desktop').unbind().on('click',function() { $('.hstation').removeClass('active')})
}
function desktop() {
  menu();
  loadProg();
	loadEmail();
  close();
}

function login() {
  $('#login').unbind().on('submit', function () {
    var username = $('#user').val();
    var password = $('#pass').val();
    $.ajax({
      url: 'login.php',
      type: "POST",
      data: {
        username: username,
        password: password
      },
      success: function (data) {
		  if(data == 1)
			  {
        $('#container').load('desktop.php', function () {
          desktop();
        });
			  }
		  else
			  {
				  $("#login").effect('shake');
			  }
      },
      failure: function (data) {

		  $("#login").effect('shake');}

    })
  })
}
function loadEmail()
{
	
}
$(document).ready(function () {
  if ($('.bootloader').length > 0) {
    $.ajax({
      url: "boot.php",
      dataType: 'text',
      success: function (data) {
        var arr = JSON.parse(data);
        var i;
        for (i = 0; i < arr.length; ++i) {
          // do something with `substr[i]`
          bootText(arr[i]['t'], arr[i]['txt'])
        }
        $('.bootloader').queue(function () {
          $('#container').hide().load('desktop.php',
            function () {
              $('#welcome').ready(function () {
                $("#welcome").show().fadeIn(1000).delay(1000).fadeOut(1000);
              	login();
			  })
            }).fadeIn(700)
        })
      }
    })
  } else {
    $('#container').load('desktop.php', function () {
      desktop();
    });
  }
});
