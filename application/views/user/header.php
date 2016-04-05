<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <div id="header">
        <a href="#menu"></a>
        <span id="Logo" class="svg">
            <img src="/efa/img/logo.png" style="padding:10%;"/>
        </span>
        <a class="backBtn" href="javascript:history.back();"></a>
    </div>
    <div id="msg"></div>
    <script>
        $(function() {
            var msg_to_user;
            $.getJSON('<?= base_url(); ?>user/get_session_id', function(my_id, text, jqZHR) {
                if (my_id === false) {
                    msg_to_user = '<div class="subHeader"><i class="i-blog i-small"></i>Welcome</div>';
                    document.getElementById("msg").innerHTML = msg_to_user;
                }
                else {
                    $.ajax({
                        type: "POST",
                        url: '<?= base_url(); ?>user/get_employee_by_id',
                        data: {'id': my_id},
                        success: function(response) {
                            var response = JSON.parse(response);
                            var coins_left = response["coins_left"];
                            var coins_received = response["coins_received"];
                            var last_received = response["last_received"];
                            if (coins_received > last_received) {
                                msg_to_user = '<div class="subHeader"><i class="i-blog i-small"></i>You have ' + coins_left + ' coins to give this week</div>';
                                //msg_to_user = '<a href="inbox.php"><div class="subHeader"><i class="i-blog i-small"></i>You received Coin(s)! Click ME</div></a><a href="inbox.php"><div class="subHeader"><i class="i-blog i-small"></i>You received Coin(s)! Click ME</div></a>';
                            }
                            else {
                                msg_to_user = '<div class="subHeader"><i class="i-blog i-small"></i>You have ' + coins_left + ' coins to give this week</div>';
                            }
                            document.getElementById("msg").innerHTML = msg_to_user;
                        }
                    });
                }
            });
        });
    </script> 
</body>

</html>