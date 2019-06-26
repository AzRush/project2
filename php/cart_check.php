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

do{
    if($the_cart == null)
    {
        break;
    }
    $sql_artworkID ="SELECT * FROM artworks WHERE artworkID=_artworkID";
    $sql_artworkID = preg_replace("/_artworkID/",$the_cart['artworkID'],$sql_artworkID);
    $sql_artworkID_result = mysqli_query($mysql,$sql_artworkID);
    $the_artwork = mysqli_fetch_assoc($sql_artworkID_result);

}while($the_cart = mysqli_fetch_assoc($sql_result));
if($price_sum > $current_user['balance'])
{
    echo "Your balance is " . $current_user['balance'] ."$,please recharge first!";
    return;
}
else
{
    $sql ="INSERT INTO orders (ownerID,sum) VALUES (_ownerID,_sum)";
    $sql = preg_replace("/_ownerID/",$current_user['userID'],$sql);
    $sql = preg_replace("/_sum/",$price_sum,$sql);
    $result = mysqli_query($mysql,$sql);
    $sql="SELECT LAST_INSERT_ID()";
    $sql_result=mysqli_query($mysql,$sql);

    $the_orderID = mysqli_fetch_row($sql_result)[0];
    //echo $the_orderID;
    $sql = "SELECT * FROM carts WHERE userID=_userID";
    $sql = preg_replace("/_userID/",$current_user['userID'],$sql);
    $sql_result = mysqli_query($mysql,$sql);
    $the_cart = mysqli_fetch_assoc($sql_result);
    
    do{
        if($the_cart == null)
        {
            break;
        }
        $sql_artworkID ="UPDATE artworks SET orderID=_orderID WHERE artworkID=_artworkID";
        $sql_artworkID = preg_replace("/_artworkID/",$the_cart['artworkID'],$sql_artworkID);
        $sql_artworkID = preg_replace("/_orderID/",$the_orderID,$sql_artworkID);
        $sql_artworkID_result = mysqli_query($mysql,$sql_artworkID);



    }while($the_cart = mysqli_fetch_assoc($sql_result));

    echo "Success";
}

?>