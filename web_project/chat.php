<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel='stylesheet' type='text/css'/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	function submitChat(){
		if(chat_form.chat_tbox.value==""){

		}
		else{
			var textVal = chat_form.chat_tbox.value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState==4 && xmlhttp.status==200){
					document.getElementById('chat_area').innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET', 'insert.php?msg='+textVal, true);
			textVal="";
			xmlhttp.send();
		}
	}
	$(document).ready(function(e){
		$.ajaxSetup({cache:false});
		setInterval(function(){$('#chat_area').load('logs.php');}, 2000);
	});
</script> 

</head>
<body>

<div class="main_grid">
	<h1> Chat Box </h1>
	
		<form name = "chat_form" id="chat_form">
		<div class="chat_area" id="chat_area">
			
		</div>
		<input type="text" name="chat_box" id="chat_tbox" placeholder="Type here to chat with your friend.."/>
		
		<a href="#" class="button_like" onclick="submitChat()">Send</a>
		</form>
		
		<?php
			include 'conn/db_conn.php';
			include 'func/quer.php';
			include 'func/otherFunctions.php';
			if(isset($_GET['email'])){
				$friendEmail = $_GET['email'];
				$_SESSION['friend_email'] = $friendEmail;
				$link = connectDatabase();
				$result = getFriendInfo($friendEmail, $link);
				$fName = $result['first_name'];
				$lName = $result['last_name'];
			}

		?>
		<form id="back_form" method="POST" action="friends.php">
			<input type="submit" name="back" id="back_button" value="Back to Friends"/>
		</form>
	</div>
</body>
</html>