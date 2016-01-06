<?php session_start();
include 'conn/db_conn.php';
include 'func/quer.php';
include 'func/otherFunctions.php'; 
?>
<!DOCTYPE html>
<html>


<head>
<link href="style.css" rel='stylesheet' type='text/css'/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php 
	
	$users = $_SESSION["username"];

	if(isset($_POST['add_friend'])){
		$link = connectDatabase();
		$flag = addThisUserAsFriend($_COOKIE['logged_in_user'], $users['email'], $link);
		if($flag){
			echo "<script type='text/javascript'>alert('Friend added successfully.');</script>";
		}
		session_destroy();
		closeConn($link);

	}
	
?>
</head>
<body>

<div class="main_grid">
	<h1> Searched friends with name </h1>
	
	<form id="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<div class="friends_table">
		<table>
			<tr><td> First Name </td> <td> Last Name </td><td> Username </td><td> Add Friend</td></tr>
			<?php 
				if(isset($_POST['back_to_friends'])){
					header('Location: friends.php');
				}
				displaySearchedFriends($users);

			?>
			
		</table>
	</div>
		<input type="submit" id="back_to_friends" name="back_to_friends" value="Back to your friends" />
	</form>
</div>
</body>
</html>
