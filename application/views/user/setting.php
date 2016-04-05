<!DOCTYPE html>
<html>
<head>
</head>

<body>
    <div id="photo"></div>

	<script>
		$(function() {
            var photo = "";
            $.getJSON('<?= base_url(); ?>user/get_photo', function(response, text, jqZHR) {  
                photo += '<img src='+response+' style="width:60px;height:60px;vertical-align:middle;">'; 
                photo += '<form action="/efa/user/upload_photo" method="post" enctype="multipart/form-data" style="display:inline-block;">';
                photo += '<span class="btn btn-gray btn-file">';
                photo += 'Image<input name="fileToUpload" type="file" accept="image/*" capture="camera">'
                photo += '</span>';     
                photo += '<button name="picture" type="submit" class="btn btn-gray">';
                photo += 'Upload';
                photo += '</button>';
                photo += '</form>';
                $("#photo").html(photo);
            });
        });
	</script>
</body>
</html>