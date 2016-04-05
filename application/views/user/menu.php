<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <nav id="menu">
        <ul>
            <li>
                <a href="/efa/user/activity">
                    <i class="i-about i-small"></i>Activity
                </a>
            </li>
            <li>
                <a href="/efa/user/employee">
                    <i class="i-about i-small"></i>Give Kudos
                </a>
            </li>
            <li>
                <a href="/efa/user/my_profile">
                    <i class="i-about i-small"></i>Profile
                </a>
            </li>
            <li>
                <a href="/efa/user/inbox">
                    <i class="i-about i-small"></i>Inbox
                </a>
            </li>
            <li>
                <a href="/efa/user/leader">
                    <i class="i-about i-small"></i>Leader boards
                </a>
            </li>
            <li>
                <a href="/efa/user/shop">
                    <i class="i-about i-small"></i>Shop
                </a>
            </li>
            <li>
                <a href="/efa/user/setting">
                    <i class="i-about i-small"></i>Setting
                </a>
            </li>
            <li>
                <a href="/efa/user/logout">
                    <i class="i-about i-small"></i>Logout
                </a>
            </li>
            <li>
                <a href="/efa/user_stats/get_kudo_given">
                    <i class="i-about i-small"></i>Stats
                </a>
            </li>
        </ul>
    </nav>
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