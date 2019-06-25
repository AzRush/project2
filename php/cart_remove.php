<?php
session_start();
include 'database_connect.php';
$current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
$current_user_query = mysqli_query($mysql, $current_user_sql);
$current_user = mysqli_fetch_assoc($current_user_query);
$sql = "DELETE FROM carts WHERE artworkID=_artworkID AND userID=_userID";
$sql = preg_replace("/_artworkID/",$_POST['artwork_id'],$sql);
$sql = preg_replace("/_userID/",$current_user['userID'],$sql);
$mysql->query($sql);
echo "Remove successfully!";
?>