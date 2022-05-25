<div class="explorer noselect">
    <div class="explorer-space">
      <div class="status">
		  <div class="tab active"><i class="material-icons foldericon">Terminal</i></div>
        <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
      </div>
		<div id='console'>
		<img src='../../../assets/imgs/loading.gif' class='loading'  width='54px' height='54px'>
		</div>
		</div>
	</div>
<script>
   $(document).ready(function () {
                function loadLog() {
                    var oldscrollHeight = $("#console")[0].scrollHeight - 20; //Scroll height before the request
 
                    $.ajax({
                        url: "log.php",
                        cache: false,
                        success: function (html) {
                            $("#console").html(html); //Insert chat log into the #chatbox div
 
                            //Auto-scroll           
                            var newscrollHeight = $("#console")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#console").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }
 
                setInterval (loadLog, 2500);
            });
</script>