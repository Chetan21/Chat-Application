<?php


	function displayFriends($friends, $link){
		while($row = $friends->fetch_assoc()){
			$friendEmail = $row['friend'];
			$sql = "SELECT first_name, last_name, email FROM user_info WHERE email='$friendEmail'";
			$r = mysqli_query($link, $sql);
			$r = mysqli_fetch_assoc($r);
		  	echo "<tr><td>".$r['first_name']." ".$r['last_name']."</td> <td><form method='post' action='chat.php?email=".$r['email']."'><input type='submit' name='chat' id='chat' value='Start Chat'/></form></td></tr>"; 
		  }
	}

	function startLoginSession($user){
		setrawcookie('logged_in_user', $user, false);
		header('Location: friends.php');
	}

	function displaySearchedFriends($users){
			echo '<tr><td>'.$users["first_name"].' </td> <td>'.$users["last_name"].' </td><td>'.$users["email"].' </td><td><input type="submit" name="add_friend" id="addFriend" value="Add Friend"/></td></tr>';
		
	}

	function signOutUser($user, $link){
		
			echo "<script type='text/javascript'>alert('U from other account and login again.');</script>";
			setcookie('logged_in_user', "", time()-3600, '/');
			unset($_COOKIE['username']);
		$sql = "UPDATE login_info SET login_status = 0 WHERE username = '$user'";
		$r = mysqli_query($link, $sql);
		header('Location: login.php');
	}

?>