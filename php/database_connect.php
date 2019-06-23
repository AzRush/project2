<?php
$mysql = mysqli_connect('localhost', 'root', '', 'project2') or die("can not connect" . mysqli_error());
$mysql->set_charset("utf8");
$artworks = "SELECT * FROM artworks";
$result_artworks = mysqli_query($mysql, $artworks);
$orders = "SELECT * FROM orders";
$result_orders = mysqli_query($mysql, $orders);
$users = "SELECT * FROM users";
$result_users = mysqli_query($mysql, $users);
?>