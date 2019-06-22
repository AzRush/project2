<?php
session_start();
include 'database_connect.php';
if($_POST["method"] == "login")
{
    while ($i = mysqli_fetch_assoc($result_users)) {
        $username = $i["name"];
        $password = $i["password"];
        if ($_POST["username"] == $username) {
            if ($_POST["password"] == $password) {
                echo "Success";
                $_SESSION['user'] = $username;
            } else {
                echo "Wrong password!";
            }
            return;
        }
    }
    echo "User not found!";
}
else if($_POST["method"] == 'logout')
{
    unset($_SESSION['user']);
}
?>