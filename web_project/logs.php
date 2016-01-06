<?php
session_start();
include 'conn/db_conn.php';
$link = connectDatabase();
$user = $_COOKIE['logged_in_user'];
$friendEmail = $_SESSION['friend_email'];
$sql2 = "SELECT * FROM logs ORDER BY chat_id DESC";
$result = mysqli_query($link, $sql2);

if($result!=FALSE)
	while($i=mysqli_fetch_array($result)){
		echo $i['username'].": ".$i['msg']. "<br>";
	}
?>