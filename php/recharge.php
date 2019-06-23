<?php
session_start();
include 'database_connect.php';
if(!isset($_SESSION['user']))
{
    echo "<script>alert('Please login first!');top.location = 'homepage.php';</script>";
}
else
{
    $current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
    $current_user_query = mysqli_query($mysql, $current_user_sql);
    $current_user = mysqli_fetch_assoc($current_user_query);
    $sql = "UPDATE users SET balance=" . ($current_user['balance'] + $_POST['money']) ." WHERE name='_name'";
    $sql = preg_replace("/_name/", $current_user['name'],$sql);
    $mysql->query($sql);
    echo "SUCCESS" . ($current_user['balance'] + $_POST['money']);
}
?>