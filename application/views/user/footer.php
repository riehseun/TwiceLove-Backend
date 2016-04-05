<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <footer style="position:fixed; bottom:0px; left:0px; right:0px; width:100%; height:60px; z-index:9999;">
        <div style="float:left; width:25%; height:60px; text-align:center;">
            <a href="/efa/user/index" ><button class="btn btn-default" style="text-decoration:none; background-color:#587eac; color:#fff; font-size:20px; width:100%; line-height:60px;">Activity</button></a>
        </div>
        <div style="float:left; width:25%; height:60px; text-align:center;">
            <a href="/efa/user/employee"><button class="btn btn-default" style="text-decoration:none; background-color:#587eac; color:#fff; font-size:20px; width:100%; line-height:60px;">Kudos</button></a>
        </div>
        <div style="float:left; width:25%; height:60px; text-align:center;">
            <a href="/efa/user/my_profile"><button class="btn btn-default" style="text-decoration:none; background-color:#587eac; color:#fff; font-size:20px; width:100%; line-height:60px;">Profile</button></a>
        </div>
        <div style="float:left; width:25%; height:60px; text-align:center;">
            <a href="/efa/user/inbox" ><button class="btn btn-default" style="text-decoration:none; background-color:#587eac; color:#fff; font-size:20px; width:100%; line-height:60px;">Inbox</button></a>
        </div>
    </footer>

    <script>
        /*
        $('#profile').click(function() {
            $.ajax({
                type: "POST",
                url: '<?= base_url(); ?>user/set_profile_id',
                data: {'id': id},
                success: function(response) {
                    $.ajax({
                        type: "GET",
                        url: '<?= base_url(); ?>user/profile',
                        data: {'id': id},
                        success: function(response) {
                        
                        }
                    });
                }
            });
        });
*/
    </script>
</body>

</html>


