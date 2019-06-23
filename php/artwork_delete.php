<?php
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
    echo $file;
?>