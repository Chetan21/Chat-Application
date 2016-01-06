<!DOCTYPE html>
<html>


<head>
<link href="style.css" rel='stylesheet' type='text/css'/>
</head>
<body>

<div class="main_grid">
	
		<form id="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
			<h1> Login <input type="text" name="login_tbox" id="login_tbox"/></h1>
			<h1> Password <input type="password" name="password_tbox" id="password_tbox"/></h1>
			<input type="submit" name="login_button" id="login_button" value="Login"/>
			<input type="submit" name="signup" id="signup_button" value="Sign Up"/>
		</form>
	
</div>
	<?php
		include 'conn/db_conn.php';
		include 'func/quer.php';
		include 'func/otherFunctions.php';

		if(isset($_POST['signup'])){
			header('Location: user_register.php');
		}
		if(isset($_POST['login_button'])){
			if(''!=$_POST['login_tbox'] or ''!=$_POST['password_tbox']){
				
				$link = connectDatabase();
				$username = $_POST['login_tbox'];
				$pass = $_POST['password_tbox'];
				$check = checkMultipleLogins($username, $link);
				$valid = validateUser($username, $pass, $link);
				if(FALSE == $valid){
					echo "<script type='text/javascript'>alert('Login credentials do not match. Enter again.');</script>";
				}
				else if(FALSE == $check)
					echo "<script type='text/javascript'>alert('User already logged in. Please log out from other account and login again.');</script>";
				else{
					startLoginSession($username);
				}
				closeConn($link);
			}
			else
				echo "<script type='text/javascript'>alert('Both Fields are woman-datory');</script>";
		}
	?>
</body>
</html>
