<!DOCTYPE html>
<html>
<head>
</head>

<body class="o-page">
    <div id="page">
        <div id="content" style="background-color:#fff; min-height:480px;">
            <h2 style="font-size:16px;">Add new coin</h2> 
            <form method="post" action="/efa/user/add_coin">
                <input placeholder="enter new coin" name="add_coin" class="form-control" pattern="[0-9]{1,5}" required>  
                <br>                                    
                <input type="submit" class="btn btn-primary" value="Add coin">
            </form>
            <div id="coins"></div>

            <h2 style="font-size:16px;">Add new hash</h2> 
            <form method="post" action="/efa/user/add_hash">
                <input placeholder="enter new hash" name="add_hash" class="form-control" pattern="[A-Za-z ]{1,16}" required>  
                <br>                                    
                <input type="submit" class="btn btn-primary" value="Add hash">
            </form>
            <div id="hashes"></div>

            <h2 style="font-size:16px;">Initialize turnover</h2> 
            <form method="post" action="/efa/user/initialize">
                <input type="input" name="period" placeholder="Period">  
                <br>     
                <input type="input" name="daily_coin" placeholder="Daily coin">  
                <br>                                 
                <input type="submit" class="btn btn-primary" value="Initialize">
            </form>
            <div id="turnover"></div>

            <div ><button id="reset_coin">Reset employee coins</button></div>
            <div ><button id="delete_kudo">Delete employee kudos and transactions</button></div>
            <div ><button id="delete_comment">Delete comments</button></div>
            <div ><button id="initialize">initialize</button></div>
            <div ><button id="increment_period">increment period</button></div>
            <div ><button id="decrement_period">decrement period</button></div>
            <hr>
            <hr>
            <hr>
            <hr>
        </div>
        
    </div>
    
    <script>
        $(function() {
            $.ajax({ 
                type: "GET",
                url: '<?= base_url(); ?>user/get_coin',
                success: function(response) {
                    //alert(response)
                    var response = JSON.parse(response);
                    var coin = "";
                    for (i=0; i<response.length; i++) { 
                        //alert(response[i].value);
                        coin += '<form method="post" action="/efa/user/delete_coin" style="display:inline-block;">';
                        coin += '<input name="coin" type="submit" class="btn btn-danger" value="'+response[i].value+'">';
                        coin += '<input type="hidden" name="delete_coin" value="'+response[i].value+'">';
                        coin += '</form>';
                    }   
                    document.getElementById("coins").innerHTML = coin;
                }
            });

            $.ajax({ 
                type: "GET",
                url: '<?= base_url(); ?>user/get_hash',
                success: function(response) {
                    //alert(response)
                    var response = JSON.parse(response);
                    var hash = "";
                    for (i=0; i<response.length; i++) { 
                        //alert(response[i].hash);
                        hash += '<form method="post" action="/efa/user/delete_hash" style="display:inline-block;">';
                        hash += '<input name="hash" type="submit" class="btn btn-danger" value="'+response[i].hash+'">';
                        hash += '<input type="hidden" name="delete_hash" value="'+response[i].hash+'">';
                        hash += '</form>';
                    }   
                    document.getElementById("hashes").innerHTML = hash;
                }
            });

            $('#reset_coin').click(function() {
                $.ajax({ 
                    type: "POST",
                    url: '<?= base_url(); ?>user/reset_coin',
                    success: function(response) {
                        var response = JSON.parse(response);
                        alert(response);
                    }
                });
            });

            $('#delete_kudo').click(function() {
                $.ajax({ 
                    type: "POST",
                    url: '<?= base_url(); ?>user/delete_kudo',
                    success: function(response) {
                        var response = JSON.parse(response);
                        alert(response)
                    }
                });
            });

            $('#delete_comment').click(function() {
                $.ajax({ 
                    type: "POST",
                    url: '<?= base_url(); ?>user/delete_comment',
                    success: function(response) {
                        var response = JSON.parse(response);
                        alert(response)
                    }
                });
            });

            $.ajax({ 
                type: "GET",
                url: '<?= base_url(); ?>user/get_turnover',
                success: function(response) {
                    var response = JSON.parse(response);
                    var turnover = "";
                    for (i=0; i<response.length; i++) { 
                        //alert(response[i].hash);
                        turnover += response[i].period;
                        turnover += '<br>';
                        turnover += response[i].daily_coin;
                    }   
                    document.getElementById("turnover").innerHTML = turnover;
                }
            });

            $('#decrement_period').click(function() {
                $.ajax({ 
                    type: "GET",
                    url: '<?= base_url(); ?>user/decrement_period',
                    success: function(response) {
                        var response = JSON.parse(response);
                        alert(response)
                    }
                });
            });

            $('#increment_period').click(function() {
                $.ajax({ 
                    type: "GET",
                    url: '<?= base_url(); ?>user/increment_period',
                    success: function(response) {
                        var response = JSON.parse(response);
                        alert(response)
                    }
                });
            });
        });
    </script>
</body>
</html>