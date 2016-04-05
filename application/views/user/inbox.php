<!DOCTYPE html>
<html>
<head>
</head>

<body>
	<div id="inbox"></div>

	<script>
		$(function() {
            var giver_profile_id = [];
            var inbox = "";
            $.getJSON('<?= base_url(); ?>user/get_inbox', function(response, text, jqZHR) {	
                var kudos_size = response["kudos"].length;
                var coins_size = response["coins"].length;
                var likes_size = response["likes"].length;
                var comments_size = response["comments"].length;
                inbox += '<div class="tap">';
                inbox += '<div data-pws-tab="anynameyouwant1" data-pws-tab-name="Public" data-pws-tab-icon="fa-heart" style="width:100%;">';
                for (i=0; i<kudos_size; i++) {
                    var giver_id = response["kudos"][i]["giver_id"];
                    var giver_first = response["kudos"][i]["giver_first"];
                    var giver_last = response["kudos"][i]["giver_last"];
                    var giver_photo_url = response["kudos"][i]["giver_photo_url"];
                    var quantity = response["kudos"][i]["quantity"];
                    var hash = response["kudos"][i]["hash"];
                    var message = response["kudos"][i]["message"];

                    giver_profile_id.push(giver_id);

                    inbox += '<div style="clear:both; width:100%;">';

                    inbox += '<div style="float:left; margin-left:5%;">';
                    inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'"><img src="'+giver_photo_url+'" style="width:60px; height:60px; float:left;"></a>';
                    inbox += '</div>';

                    inbox += '<div style="float:left; margin-left:5%;">';
                    inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'" style="text-decoration:none;"><span style="color:blue;">'+giver_first+' '+giver_last+'</span></a><br>';
                    inbox += 'Coins: <span style="color:blue;">'+quantity+'</span><br>';
                    inbox += 'Hash: <span style="color:green;">'+hash+'</span><br>';
                    inbox += '</div>';

                    inbox += '<div style="clear:both; margin-left:5%; width:90%;">';
                    inbox += '<span style="word-wrap:break-word;">Message: <span style="color:brown; word-wrap:break-word;">'+message+'</span></span><br>';
                    inbox += '</div>';

                    inbox += '</div>';
                    inbox += '<hr style="padding:0 margin:0">';
                }

                for (i=0; i<coins_size; i++) {
                    var giver_id = response["coins"][i]["giver_id"];
                    var giver_first = response["coins"][i]["giver_first"];
                    var giver_last = response["coins"][i]["giver_last"];
                    var giver_photo_url = response["coins"][i]["giver_photo_url"];
                    var quantity = response["coins"][i]["quantity"];

                    giver_profile_id.push(giver_id);

                    inbox += '<div style="clear:both; width:100%;">';

                    inbox += '<div style="float:left; margin-left:5%;">';
                    inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'"><img src="'+giver_photo_url+'" style="width:60px; height:60px; float:left;"></a>';
                    inbox += '</div>';

                    inbox += '<div style="float:left; margin-left:5%;">';
                    inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'" style="text-decoration:none;"><span style="color:blue;">'+giver_first+' '+giver_last+'</span></a><br>';
                    inbox += '</div>';

                    inbox += '</div>';
                    inbox += '<hr style="padding:0 margin:0">';
                }

                
                for (i=0; i<comments_size; i++) {
                    var giver_id = response["comments"][i]["giver_id"];
                    var giver_first = response["comments"][i]["giver_first"];
                    var giver_last = response["comments"][i]["giver_last"];
                    var giver_photo_url = response["comments"][i]["giver_photo_url"];
                    var receiver_id = response["comments"][i]["receiver_id"];
                    var comment = response["comments"][i]["comment"];
                    var option = response["comments"][i]["option"];

                    giver_profile_id.push(giver_id);

                    inbox += '<div style="clear:both; width:100%;">';

                    // public or private but you only
                    if ((option !== "anonymous" && option !== "private") || (option !== "anonymous" && receiver_id === id)) {
                        inbox += '<div style="float:left; margin-left:5%;">';
                        inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'"><img src="'+giver_photo_url+'" style="width:60px; height:60px; float:left;"></a>';
                        inbox += '</div>';

                        inbox += '<div style="float:left; margin-left:5%;">';
                        inbox += '<a href="/efa/user/profile" id="profile'+giver_id+'" style="text-decoration:none;"><span style="color:blue;">'+giver_first+' '+giver_last+'</span></a><br>';
                        inbox += '</div>';
                    }
                    inbox += '<div style="clear:both; margin-left:5%; width:90%;">';
                    inbox += '<span style="word-wrap:break-word;">Message: <span style="color:brown; word-wrap:break-word;">'+comment+'</span></span><br>';
                    inbox += '</div>';

                    inbox += '</div>';
                    inbox += '<hr style="padding:0 margin:0">';
                }
                inbox += '</div>';
                inbox += '</div>';
                $("#inbox").html(inbox);

                for (var i in giver_profile_id) {
                    $('#profile'+giver_profile_id[i]).click(function() {
                        $.ajax({
                            type: "POST",
                            url: '<?= base_url(); ?>user/set_profile_id',
                            data: {'id': giver_profile_id[i]},
                            success: function(response) {
                                $.ajax({
                                    type: "GET",
                                    url: '<?= base_url(); ?>user/profile',
                                    data: {'id': giver_profile_id[i]},
                                    success: function(response) {
                                    
                                    }
                                });
                            }
                        });
                    });
                }

                $('.taps').pwstabs({
                    // scale / slideleft / slideright / slidetop / slidedown / none
                    effect: 'scale', 
                    // The tab to be opened by default
                    defaultTab: 1,    
                    // Set custom container width
                    // Any size value (1,2,3.. / px,pt,em,%,cm..)
                    containerWidth: '100%',
                    // Tabs position: horizontal / vertical
                    tabsPosition: 'horizontal',
                    // Tabs horizontal position: top / bottom
                    horizontalPosition: 'top',
                    // Tabs vertical position: left / right
                    verticalPosition: 'left',
                    // BETA: Make tabs container responsive: true / false (!!! BETA)
                    responsive: false,
                    // Themes available: default: '' / pws_theme_violet / pws_theme_green / pws_theme_yellow
                    // pws_theme_gold / pws_theme_orange / pws_theme_red / pws_theme_purple / pws_theme_grey
                    theme: 'pws_theme_grey',
                    // Right to left support: true/ false
                    rtl: false
                });
            });
        });

	</script>
</body>
</html>