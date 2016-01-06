<?php
	session_start();
?>
<!DOCTYPE html>
<html>


<head>
<link href="style.css" rel='stylesheet' type='text/css'/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });
});
</script>
</head>
<body>

<div class="main_grid">
	<h1> User </h1>
	<h2> Click on your friends below to start a chat with them</h2>
	<form id="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<input type="text" id="search_tbox" name="search_tbox" placeholder="Search for new Friends.. "/>
		<input type="submit" name="search_button" id="search_button" value="Search"/>
	
	<div class="friends_table">
		<table>
			<tr><td> Your Friends </td> <td> Online</td></tr>
			 
			<?php 
				include 'conn/db_conn.php';
				include 'func/quer.php';
				include 'func/otherFunctions.php';

				
				$link = connectDatabase();
				$user = $_COOKIE['logged_in_user'];
				$friends = getFriends($user, $link);
				displayFriends($friends, $link);

				if(isset($_POST['search_button'])){
					
					if(isset($_POST['search_tbox'])){
						$text = $_POST['search_tbox'];
						
						$searchedFriends = searchFriend($text, $link);

						if(FALSE==$searchedFriends){
							echo "<script type='text/javascript'>alert('No username found with such name');</script>";
						}
						else{
							$temp = mysqli_fetch_assoc($searchedFriends);
							$_SESSION["username"] = $temp;
							
							header('Location: add_friend.php');
						}
					}
					else
						echo "<script type='text/javascript'>alert('Search fields are empty.');</script>";
				}
				
				if(isset($_POST['sign_out'])){
					signOutUser($_COOKIE['logged_in_user'], $link);
				}
				closeConn($link);
			?>
		</table>
		
	</div>
	<input type="submit" id="sign_out" name="sign_out" value="Sign Out" />
	</form>
</div>
</body>
</html>
