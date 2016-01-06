<?php
session_start();
include 'conn/db_conn.php';
$msg = $_REQUEST['msg'];
$link = connectDatabase();
$user = $_COOKIE['logged_in_user'];
$friendEmail = $_SESSION['friend_email'];
$sql = "INSERT INTO logs (username, msg, friend) VALUES ('$user', '$msg', '$friendEmail')";
mysqli_query($link, $sql);

$sql2 = "SELECT * FROM logs ORDER BY chat_id DESC";
$result = mysqli_query($link, $sql2);

while($i=mysqli_fetch_assoc($result)){
	echo "<script type='text/javascript'>alert('".mysqli_error($link)."');</script>";
	echo $i['username'].": ".$i['msg']. "<br>";
}
?>
