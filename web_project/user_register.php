<?php
		include 'conn/db_conn.php';
		include 'func/quer.php';
		include 'func/otherFunctions.php';
?>

<html>
<head>
<link href="style.css" rel='stylesheet' type='text/css'/>
</head>
<body>
	<div class="main_grid">
		<h1>Sign Up Now!<span>Sign up and start chatting!</span></h1>
		<form id="login_form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    	<div class="section"><span>1</span>First Name &amp; Address</div>
    		<div class="inner-wrap">
        		<label>First Name <input type="text" name="first_name" id="fname" /></label>
        		<label>Last Name <input type="text" name="last_name" id="lname" /></label>
    		</div>

    		<div class="section"><span>2</span>Email &amp; Phone</div>

    		<div class="inner-wrap">
        		<label>Email Address <input type="email" name="email" id="email" /></label>
        		<label>Phone Number <input type="text" name="phone" id="phone" /></label>
    		</div>

    		<div class="section"><span>3</span>Passwords</div>
    		<div class="inner-wrap">
    			<label>Password <input type="password" name="pword" id="pass" /></label>
    			<label>Confirm Password <input type="password" name="cpword" id="cpass" /></label>
			</div>
			<div class="button-section">
     			<input type="submit" name="sign_up" id="sign_up" value = "Sign Up" />
     			
     			<input type="submit" name="back_to_login" value="Back to Login" id="login"/>
     			
    		</div>
			<?php 

				if(isset($_POST['back_to_login'])){
					header('Location: login.php');
				}
				$nameErr="";
    			if(isset($_POST['sign_up'])){
    				if (!isset($_POST['first_name']) || $_POST['first_name'] == "") {
				     $nameErr = "First name is required";
				   }
				   else if (!isset($_POST['last_name']) || $_POST['last_name'] == "") {
				     $nameErr = "Last name is required";
				   }
				   else if (!isset($_POST['email']) || $_POST['email'] == "") {
				     $nameErr = "Email ID is invalid";
				   }
				   else if (!isset($_POST['phone']) || $_POST['phone'] == "") {
				     $nameErr = "Phone is required";
				   }
				   else if (!isset($_POST['pword']) || $_POST['pword'] == "") {
				     $nameErr = "Password is required";
				   }
				   else if (!isset($_POST['cpword']) || $_POST['cpword'] == "") {
				     $nameErr = "Password is required";
				   }
				   else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['first_name'])||!preg_match("/^[a-zA-Z ]*$/",$_POST['last_name'])) {
				       $nameErr = "Only letters and white space allowed"; 
				   } else {
					   	
					     $first_name = ($_POST["first_name"]);
					     $last_name = ($_POST["last_name"]);
						 $email = ($_POST["email"]);
						 $phone = ($_POST["phone"]);
						 $pword = ($_POST["pword"]);
						 $cpword = ($_POST["cpword"]);
						 
						if($pword!=$cpword){
							echo '<font color = "red">Passwords do not match</font><br>';	
						}
						$link = connectDatabase();
						$check = checkNewUser($email, $link);
						if(FALSE == $check){
							$flag = addNewUser($first_name, $last_name, $email, $phone, $pword, $link);
							if(FALSE==$flag){
								echo '<font color = "red">Oops techie issues !!</font><br>';
							}
							else{
								echo "<script type='text/javascript'>alert('User ".$email." was created successfully.');</script>";
								closeConn($link);
							}
						}
						else{
							echo "<script type='text/javascript'>alert('User ".$email." already registered.');</script>";
						}
				   }
				   if("" != $nameErr) {
						echo '<font color = "red">'.$nameErr.'</font><br>';
					}
    			}
    		?>
    		

		</form>
	</div>	
</body>
</html>