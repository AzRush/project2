<?php
session_start();
include 'database_connect.php';
while ($i = mysqli_fetch_assoc($result_users))
{
    $username = $i["name"];
    if ($_POST["username"] == $username)
    {
        echo "Username existed!";
        return;
    }
}

$sql = "INSERT INTO users (userID,name,email,password,tel,address,balance) VALUE (_userID,'_name','_email','_password','_tel','_address',0)";
$sql = preg_replace("/_userID/",$result_users->num_rows + 1,$sql);
$sql = preg_replace("/_name/",$_POST["username"], $sql);
$sql = preg_replace("/_email/",$_POST["email"], $sql);
$sql = preg_replace("/_password/",$_POST["password"], $sql);
$sql = preg_replace("/_tel/",$_POST["telephone"], $sql);
$sql = preg_replace("/_address/",$_POST["address"], $sql);
$mysql->query($sql);
$_SESSION["user"] = $_POST["username"];
unset($_SESSION['username']);
echo "Success";
?>