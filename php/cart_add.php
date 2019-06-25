<?php
session_start();
if(!isset($_SESSION['user']))
{
    echo "Please login first!";
    return;
}
include 'database_connect.php';
$current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
$current_user_query = mysqli_query($mysql, $current_user_sql);
$current_user = mysqli_fetch_assoc($current_user_query);
$sql = "SELECT * FROM artworks WHERE artworkID=_artworkID";
$sql = preg_replace("/_artworkID/",$_POST['artworkID'],$sql);
$sql_result = mysqli_query($mysql,$sql);
$the_artwork = mysqli_fetch_assoc($sql_result);
if($the_artwork["orderID"] != null)
{
    echo "Purchased";
    return;
}
if($the_artwork["ownerID"] == $current_user["userID"])
{
    echo "Self";
    return;
}
$sql = "SELECT * FROM carts WHERE userID=_userID AND artworkID=_artworkID";
$sql = preg_replace("/_userID/",$current_user['userID'],$sql);
$sql = preg_replace("/_artworkID/",$the_artwork['artworkID'],$sql);
$sql_result = mysqli_query($mysql,$sql);
$ifIsNull = mysqli_fetch_assoc($sql_result);
if($ifIsNull != null)
{
    echo "Exist";
    return;
}
$sql = "INSERT INTO carts (artworkID,userID,changed) VALUES (_artworkID,_userID,0)";
$sql = preg_replace("/_userID/",$current_user['userID'],$sql);
$sql = preg_replace("/_artworkID/",$the_artwork['artworkID'],$sql);
$mysql->query($sql);
echo "Success";
?>