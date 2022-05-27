<div class="explorer noselect">
    <div class="explorer-space">
        <div class="status">
            <div class="tab active"><i class="material-icons foldericon">Terminal</i></div>
            <div class="bar-button"><i class="material-icons close-icon" id='close'>clear</i></div>
        </div>
        <div id='console'>
            <img src='../../../assets/imgs/loading.gif' class='loading' width='54px' height='54px'>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        function loadLog() {
            var consoleModal = $("#console")[0];

            // Clear interval if console window has been closed.
            if (!consoleModal) {
                clearInterval(logCheck);
                return;
            }
            var oldScrollHeight = consoleModal.scrollHeight - 20; //Scroll height before the request

            $.ajax({
                url: "log.php",
                cache: false,
                success: function(html) {
                    var consoleModal = $("#console");
                    if (!consoleModal) {
                        return;
                    }

                    $("#console").html(html); //Insert chat log into the #chatbox div

                    //Auto-scroll           
                    var newScrollHeight = $("#console")[0].scrollHeight - 20; //Scroll height after the request
                    if (newScrollHeight && newScrollHeight > oldScrollHeight) {
                        $("#console").animate({
                            scrollTop: newScrollHeight
                        }, 'normal'); //Autoscroll to bottom of div
                    }
                }
            });
        }

        var logCheck = setInterval(loadLog, 2500);
    });
</script>