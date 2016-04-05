<!DOCTYPE html>
<html>
<head>
</head>

<body>
	<div id="employees"></div>

	<script>
		$(function() {
            var employees = "";
            $.getJSON('<?= base_url(); ?>user/get_employee', function(response, text, jqZHR) {	
                // coins information is sent at the last array element of the response array
            	for (i=0; i<response.length-2; i++) {
            		var id = response[i]["id"];
	                var first = response[i]["first"];
	                var last = response[i]["last"];
	                var photo_url = response[i]["photo_url"];

                    employees += '<div id="kudo" style="border:1px thin black; background:#fff; border-radius:5px; clear:both; padding:1%;">';
                    employees += '<div id="photo" style="float:left; margin:1%;">'; 
                    employees += '<img src='+photo_url+' style="width:60px;height:60px;vertical-align:middle;">'; 
                    employees += '<a href="/efa/user/profile" id=profile'+id+'" style="text-decoration:none; color:blue; font-size:16px;">'+first+' '+last+'</a>'; 
                    employees += '</div>';   
                    employees += '</div>';
                    for (k=0; k<response[response.length-1].length; k++) {
                        employees += '<form method="post" action="/efa/user/give_kudo" style="display:inline-block; width:30%; margin:1%;">';
                        employees += '<input name="coin" type="submit" class="btn3d btn btn-gray" value="'+response[response.length-1][k]+'" style="width:100%;">';
                        employees += '<input type="hidden" name="eid" value="'+id+'">';
                        employees += '<input type="hidden" name="quantity" value="'+response[response.length-1][k]+'">';    

                        employees += '<div class="modal-body">';
                        employees += '<div class="form-group">';
                        employees += '<label for="sel1">Select a Hash Tag:</label>';
                        employees += '<select name="hash" class="form-control"">';
                        for (j=0; j<response[response.length-2].length; j++) { 
                            employees += '<option>'+response[response.length-2][j]+'</option>';                            
                        }
                        employees += '</select>';  
                        employees += '<label for="comment">Your Message (Maximun 200 characters):</label>'; 
                        employees += '<textarea class="form-control" rows="1" name="message" maxlength="200"></textarea>';
                        employees += '</div>';
                        employees += '</div>';
                        employees += '</form>';                       
                    }
            	}
                employees += '<hr>';
                employees += '<br>';
                employees += '<br>';   
                $("#employees").html(employees);
            });
        });

	</script>
</body>
</html>