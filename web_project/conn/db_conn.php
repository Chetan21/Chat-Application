<?php 
	function connectDatabase(){
		$link=mysqli_connect("localhost","root","root","web_chat_db");
		if(!$link)
			die('Could not connect: ' . mysqli_connect_errno());
		return $link;
	}
	function closeConn($link){
		mysqli_close($link);
	}

?>