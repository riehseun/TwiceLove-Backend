<!DOCTYPE html>
<html>
<head>
</head>

<body>
	<div id="profile"></div>

	<script>
		$(function() {
            $.getJSON('<?= base_url(); ?>user/get_profile_id', function(response, text, jqZHR) {  
                var id = response;
                var profile = "";
                $.ajax({
                    type: "POST",
                    url: '<?= base_url(); ?>user/get_profile',
                    data: {'id': id},
                    success: function(response) {
                        var response = JSON.parse(response);
                        var id = response["id"];
                        var photo_url = response["photo_url"];
                        var email = response["email"];
                        var first = response["first"];
                        var last = response["last"];
                        profile += '<div class="modal-dialog modal-lg">';
                        profile += '<form method="post" action="/efa/user/give_comment">';
                        profile += '<label for="comment">Your Message (Maximun 200 characters):</label>';
                        profile += '<textarea class="form-control" rows="1" name="comment" maxlength="200"></textarea>';
                        profile += '<br>';
                        profile += '<input type="hidden" name="eid" value="'+id+'">';
                        profile += '<input type="radio" name="option" value="public">&nbsp;Public&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        profile += '<input type="radio" name="option" value="private" checked="checked">&nbsp;Private&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
                        profile += '<input type="radio" name="option" value="anonymous">&nbsp;Anonymous&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                        profile += '<br>';
                        profile += '<br>';
                        profile += '<input type="submit" class="btn btn-gray" value="Send feedback">';
                        profile += '</form>';
                        profile += '</div>';

                        profile += '<div id="kudo" style="border:1px thin black; background:#fff; border-radius:5px; clear:both;">';
                        profile += '<div id="photo" style="float:left; margin:1%;">'; 
                        profile += '<img src="'+photo_url+'" style="width:60px;height:60px;">';
                        profile += '</div>';
                        profile += '<div style="float:left; margin:1%;">';
                        profile += '<a href="/efa/user/profile" id="'+id+'" style="text-decoration:none; color:blue; font-size:16px; margin-left:10px;">'+first+' '+last+'</a>';
                        profile += '<br>';
                        profile += '<span style="font-size:14px; margin-left:10px;">Email: '+email+'</span>';
                        profile += '</div>';
                        profile += '</div>';
                        /*
                        inbox += '<div style="clear:both; margin-top:5%;">';
                        inbox += '<form method="post" action="/efa/user/give_coin" style="display:inline-block; width:30%; margin:1%;">';
                        inbox += '<input name="coin" type="submit" class="btn3d btn btn-gray" value="<?php echo $c[$i]; ?> Coin" style="width:100%;">';
                        inbox += '<input type="hidden" name="eid" value="<?php echo $emp_id; ?>">';
                        inbox += '<input type="hidden" name="quantity" value="<?php echo $c[$i]; ?>">';
                        inbox += '<input type="hidden" name="kudo" value="1">';
                        inbox += '</form>';
                        inbox += '</div>';
                        */
                        profile += '<hr>';

                        $("#profile").html(profile);
                    }
                });    
            });

        });
	</script>
</body>
</html>