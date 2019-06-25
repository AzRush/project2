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

$sql = "INSERT INTO artworks (title,artist,genre,yearOfWork,height,width,description,price) VALUES ('_title','_artist','_genre',_yearOfWork,_height,_width,'_description',_price)";
$sql = preg_replace("/_title/",$_POST['title'],$sql);
$sql = preg_replace("/_genre/",$_POST['genre'],$sql);
$sql = preg_replace("/_artist/",$_POST['artist'],$sql);
$sql = preg_replace("/_yearOfWork/",$_POST['yearOfWork'],$sql);
$sql = preg_replace("/_height/",$_POST['height'],$sql);
$sql = preg_replace("/_width/",$_POST['width'],$sql);
$sql = preg_replace("/_description/",$_POST['description'],$sql);
$sql = preg_replace("/_price/",$_POST['price'],$sql);
echo $sql;

?>