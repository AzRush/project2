<?php
session_start();
include 'database_connect.php';
$current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
$current_user_query = mysqli_query($mysql, $current_user_sql);
$current_user = mysqli_fetch_assoc($current_user_query);
$sql = "SELECT * FROM carts WHERE userID=_userID";
$sql = preg_replace("/_userID/",$current_user['userID'],$sql);
$sql_result = mysqli_query($mysql,$sql);
$the_cart = mysqli_fetch_assoc($sql_result);
$error_message = "";
$noError = 1;
do{
    if($the_cart == null)
    {
        break;
    }
    $sql_artworkID ="SELECT * FROM artworks WHERE artworkID=_artworkID";
    $sql_artworkID = preg_replace("/_artworkID/",$the_cart['artworkID'],$sql_artworkID);
    $sql_artworkID_result = mysqli_query($mysql,$sql_artworkID);
    $the_artwork = mysqli_fetch_assoc($sql_artworkID_result);
    if($the_artwork['orderID']!= null)
    {
        $error_message = $error_message .$the_artwork['title']."has been bought!"."\n";
        $noError = 0;
        continue;
    }
    if($the_cart['changed'] == 1)
    {
        $cur_sql = "UPDATE carts SET changed=0 WHERE cartID=".$the_cart["cartID"];
        $mysql->query($cur_sql);
        $error_message = $error_message .$the_artwork['title']."has been updated!"."\n";
        $noError = 0;
        continue;
    }
}while($the_cart = mysqli_fetch_assoc($sql_result));
if($noError)
{

    echo "Success";
    return;
}
else
{
    echo $error_message;
}
?>