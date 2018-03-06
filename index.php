<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
				
			$('.editbox').hide();
			$(".edit_tr").live('click', function()
			{
				var ID=$(this).attr('id');

				$("#one_"+ID).hide();
				$("#two_"+ID).hide();
				$("#three_"+ID).hide();
				

				$("#one_input_"+ID).show();
				$("#two_input_"+ID).show();
				$("#three_input_"+ID).show();
				

				$(".editbox").live("mouseup", function(e) {
	       			e.stopImmediatePropagation();
	    		});
	    		
			    $(document).mouseup(function() {
			        $(".editbox").hide();
			        $(".text").show();
			    });

			}).live('change',function(e)
				{
					var ID=$(this).attr('id');

					var name=$("#one_input_"+ID).val();
					var email=$("#two_input_"+ID).val();
					var message=$("#three_input_"+ID).val();

					if(name.length>0&& email.length>0 && message.length>0 )
					{
						$.ajax({
						type: "POST",
						url: "live_edit_ajax.php",
						data: {id:ID,name:name,email:email,message:message,},
						
						success: function(e)
						{
							$("#one_"+ID).html(name);
							$("#two_"+ID).html(email);
							$("#three_"+ID).html(message);
							
							e.stopImmediatePropagation();
						}
						});
					}
					else
					{
					alert('Enter something.');
					}
				});
				
			});
		$(document).ready(function() {
			$('#delete').click(function(event) {
			alert('tet');
			});
		});
	</script>
</head>
<body>

<?php

	$start = 0;
	$per_page = 5;
	include 'db.php';

	$query_pag_data = "SELECT * from contact LIMIT $start, $per_page";
	$result_pag_data = mysqli_query($db, $query_pag_data) or die('MySql Error' . mysql_error());
	$finaldata = "";
	// Table Header
?>
	<table border="6" width="70%">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Message</th>
			<th>Edit</th>
		</tr>
<?php
		// Table Data Loop
		while($row = mysqli_fetch_array($result_pag_data,MYSQLI_ASSOC))
		{
?>
			<tr class="edit_tr" id="<?php echo $row['id'] ?>">
				<td class='edit_td' id="<?php echo $row['id'] ?>" >
					<span id='one_<?php echo $row['id']; ?>' class='text'><?php echo $row['name']; ?></span>
					<input type='text' value='<?php echo $row['name']; ?>' class='editbox' id='one_input_<?php echo $row['id'];?>' />
				</td>
				<td class='edit_td' id="<?php echo $row['id'] ?>" >
					<span id='two_<?php echo $row['id']; ?>' class='text'><?php echo $row['email']; ?></span>
					<input type='text' value='<?php echo $row['email']; ?>' class='editbox' id='two_input_<?php echo $row['id'];?>' />
				</td>
				<td class='edit_td' id="<?php echo $row['id'] ?>" >
					<span id='three_<?php echo $row['id']; ?>' class='text'><?php echo $row['message']; ?></span>
					<input type='text' value='<?php echo $row['message']; ?>' class='editbox' id='three_input_<?php echo $row['id'];?>' />
				</td>
				<th><a href="JavaScript:void{0}<?php echo $row['id'] ?>" id="delete">Delete</a></th>
			</tr>
<?php
		}
/* Total Count for Pagination */
$query_pag_num = "SELECT COUNT(*) AS count FROM contact";
$result_pag_num = mysqli_query($db, $query_pag_num);
$row = mysqli_fetch_array($result_pag_num,	MYSQLI_ASSOC);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);
?>
</table>
</body>
</html>