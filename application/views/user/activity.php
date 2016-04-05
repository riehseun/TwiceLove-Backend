<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <div id="kudos"></div>

    <script>
        $(function() {
            //var counter = 0;
            //var size = 100;
            //var profile_id = [];
            var kudos = "";
            $.getJSON('<?= base_url(); ?>user/get_activity', function(response, text, jqZHR) {  
                size = response.length-2;
                for (i=0; i<response.length-2; i++) {
                    var kudo_id = response[i]["id"];
                    var giver_id = response[i]["giver_id"];
                    var giver_first = response[i]["giver_first"];
                    var giver_last = response[i]["giver_last"];
                    var giver_photo_url = response[i]["giver_photo_url"];
                    var receiver_id = response[i]["receiver_id"];
                    var receiver_first = response[i]["receiver_first"];
                    var receiver_last = response[i]["receiver_last"];
                    var receiver_photo_url = response[i]["receiver_photo_url"]; 
                    var quantity = response[i]["quantity"]; 
                    var message = response[i]["message"];
                    var date = response[i]["date"];
                    var hash = response[i]["hash"];

                    /*
                    if (!(profile_id.indexOf(receiver_id) > -1)) {
                        profile_id.push(receiver_id);
                    }
                    if (!(profile_id.indexOf(giver_id) > -1)) {
                        profile_id.push(giver_id);
                    }
                    */

                    kudos += '<div id="kudo" style="border:1px thin black; background:#fff; border-radius:5px; clear:both;">';
                    kudos += '<div id="photo" style="float:left; margin:1%;">'; 
                    //"display:block;" removes white space at bottom of image 
                    kudos += '<form method="post" action="/efa/user/profile">';
                    kudos += '<img src="'+receiver_photo_url+'" style="width:50px; height:50px; display:block;">';
                    kudos += '<input type="hidden" name="id" value="'+receiver_id+'">';
                    kudos += '<input type="submit" value="profile">';
                    kudos += '</form>';

                    kudos += '</div>';
                    kudos += '<div id="name" style="float:left; margin:1%;">';
                    kudos += '<span style="color:black; font-size:16px;">'+quantity+' Coin (s) for </span>'; 
                    kudos += '#<span style="font-size:16px; color:green;">'+hash+'</span>';
                    kudos += '<br>'; 
                    kudos += '<a href="#" id="'+receiver_id+'" style="text-decoration:none; color:blue; font-size:16px;">'+receiver_first+' '+receiver_last+'</a>';
                    kudos += '</div>';      
                    /*        
                    kudos += '<div id="picture" style="clear:both; margin-left:2%; float:left; width:30%; height:1px;">';
                    kudos += '<img src="'+giver_photo_url+'" style="width:100%; height:70px; display:block;">';
                    kudos += '</div>';
                    */
                    kudos += '<div id="text" style="margin-left:2%; float:left; width:66%;">';
                    kudos += '<span style="color:black; font-size:14px; word-wrap:break-word;">'+message+'</span>';
                    kudos += '<br>';

                    kudos += '<form method="post" action="/efa/user/profile">';
                    kudos += '<img src="'+giver_photo_url+'" style="width:35px; height:35px; display:block; float:left; margin:1%;">';
                    kudos += '<input type="hidden" name="id" value="'+giver_id+'">';
                    kudos += '<input type="submit" value="profile">';
                    kudos += '</form>';

                    kudos += '<a href="#" id="'+giver_id+' style="text-decoration:none; color:blue; font-size:16px; margin:1%;">'+giver_first+' '+giver_last+'</a>';
                    kudos += '<br>';
                    kudos += '<span style="font-size:10px; margin:1%;">'+date+'</span>';
                    kudos += '</div>';

                    for (k=0; k<response[response.length-1].length; k++) {
                        kudos += '<form method="post" action="/efa/user/give_coin" style="display:inline-block; width:30%; margin:1%;">';
                        kudos += '<input name="coin" type="submit" class="btn3d btn btn-gray" value="'+response[response.length-1][k]+'" style="width:100%;">';
                        kudos += '<input type="hidden" name="eid" value="'+receiver_id+'">';
                        kudos += '<input type="hidden" name="quantity" value="'+response[response.length-1][k]+'">';  
                        kudos += '</form>';              
                    }

                    if (response[response.length-2].indexOf(kudo_id) > -1) {
                        kudos += '<form method="post" action="/efa/user/take_like" style="display:inline-block; width:30%; margin:1%;">';
                        kudos += '<input name="like" type="submit" class="btn3d btn btn-gray" value="Liked" style="width:100%;">';
                        kudos += '<input type="hidden" name="kudo_id" value="'+kudo_id+'">';
                        kudos += '<input type="hidden" name="eid" value="'+receiver_id+'">';
                        kudos += '</form>';  
                    }

                    else {
                        kudos += '<form method="post" action="/efa/user/give_like" style="display:inline-block; width:30%; margin:1%;">';
                        kudos += '<input name="like" type="submit" class="btn3d btn btn-gray" value="Like" style="width:100%;">';
                        kudos += '<input type="hidden" name="kudo_id" value="'+kudo_id+'">';
                        kudos += '<input type="hidden" name="eid" value="'+receiver_id+'">';
                        kudos += '</form>';  
                    }
                }   
                kudos += '<hr>';
                kudos += '<br>';
                kudos += '<br>';   
                $("#kudos").html(kudos);

                /*
                if (counter >= size) {
                    // set up for user profile
                    for (var i in profile_id) {
                        alert(profile_id[i])
                        $('#'+profile_id[i]).click(function() {
                            $.ajax({
                                type: "POST",
                                url: '<?= base_url(); ?>user/profile',
                                data: {'id': profile_id[i]},
                                success: function(response) {

                                }
                            });
                        });
                    }
                }
                */

            });

        });
    </script>
</body>
</html>