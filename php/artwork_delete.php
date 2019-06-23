<?php
    session_start();
    include 'database_connect.php';
    $sql = "SELECT * FROM artworks WHERE artworkID=_artworkID";
    $sql = preg_replace("/_artworkID/",$_POST['artwork_id'],$sql);
    $sql_result = mysqli_query($mysql,$sql);
    //echo "success" . $sql;
    $artwork_to_delete = mysqli_fetch_assoc($sql_result);
    $file = dirname(__FILE__);
    $file = dirname($file);
    $file = $file . "\\img\\" . $artwork_to_delete['imageFileName'];
    unlink($file);
    $sql = "DELETE FROM artworks WHERE artworkID=_artworkID";
    $sql = preg_replace("/_artworkID/",$_POST['artwork_id'],$sql);
    $mysql->query($sql);

    $sql_user = "SELECT * FROM users WHERE name='_name'";
    $sql_user = preg_replace("/_name/",$_SESSION['user'],$sql_user);
    $user_result = mysqli_query($mysql,$sql_user);
    $_user = mysqli_fetch_assoc($user_result);
    $sql = "SELECT * FROM artworks WHERE ownerID='_ownerID' AND orderID IS NULL";
    $sql = preg_replace("/_ownerID/",$_user["userID"],$sql);
    //echo $sql;
    $sql_result = mysqli_query($mysql,$sql);
    $_return = '';
    $cnt = 0;
    while($row = mysqli_fetch_assoc($sql_result))
    {
        if($row == null && $cnt == 0)
        {
            echo "fail";
            return;
        }
        $cnt++;
    $toEcho = "<tr><td><a href=#>Name</a></td><td>UploadTime</td><td><a href=# onclick= \"artwork_delete(" . $row['artworkID'] .",'" . $row['title'] ."')\">Delete</a></td></tr>";
    $toEcho = preg_replace("/Name/",$row['title'],$toEcho);
    $toEcho = preg_replace("/UploadTime/",$row['timeReleased'],$toEcho);

    $_return = $_return . $toEcho;
    }
    echo $_return;

?>