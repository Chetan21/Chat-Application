<?php
	
	function validateUser($user, $pass, $link){

		$sql = "SELECT * 
				FROM login_info  
				WHERE username = '$user' AND pass = '$pass'";
		
		$result = mysqli_query($link, $sql);
		
		if(FALSE == $result)
			return $result;
		else{
			$sql = "UPDATE login_info SET login_status = 1 WHERE username = '$user'";
			$r = mysqli_query($link, $sql);
			return mysqli_fetch_assoc($result);
		}
	}

	function checkMultipleLogins($user, $link){
		$sql = "SELECT login_status FROM login_info WHERE username = '$user'";
		$result = mysqli_query($link, $sql);
		$flag = mysqli_fetch_assoc($result);
		if($flag['login_status']==1){
			return FALSE;
		}
		else
			return TRUE;
	}

	function searchFriend($user, $link){
		$sql = "SELECT first_name, last_name, email FROM user_info WHERE  first_name LIKE '%" . $user . "%' OR last_name LIKE '%" . $user  ."%'";

		$results = mysqli_query($link, $sql);

		return $results;
	}

	function getFriends($user, $link){
		$sql = "SELECT * 
				FROM friends
				WHERE user= '$user'";
		$results = mysqli_query($link, $sql);
		return $results;
	}

	function findAllUsers($users, $link){
		$sql = "SELECT first_name, last_name, email FROM user_info WHERE  email=".$users;

		$results = mysqli_query($link, $sql);

		return $results;
	}

	function addThisUserAsFriend($user, $friend, $link){
		$sql = "INSERT INTO friends (user, friend) VALUES ('$user', '$friend')";

		$result = mysqli_query($link, $sql);

		return $result;
	}

	function checkNewUser($email, $link){
		$sql = "SELECT email FROM user_info WHERE email= '$email'";
		$r = mysqli_query($link, $sql);
		$result = mysqli_fetch_assoc($r);
		return $result;
	}

	function addNewUser($fname, $lname, $email, $phone, $pword, $link){
		$sql = "INSERT INTO user_info (first_name, last_name, email, phone) VALUES ('$fname', '$lname', '$email', '$phone')";
		$result = mysqli_query($link, $sql);
		addLoginInfo($email, $pword, $link);
		return $result;
	}
	function addLoginInfo($email, $pword, $link){
		$sql = "INSERT INTO login_info (username, pass, login_status) VALUES ('$email', '$pword', 0)";
		$result = mysqli_query($link, $sql);
	}
	function getFriendInfo($email, $link){
		$sql = "SELECT first_name, last_name FROM user_info WHERE email='$email'";
		$result = mysqli_query($link, $sql);
		$r=mysqli_fetch_assoc($result);
		return $r;
	}
?>