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
if(!isset($_POST['artworkID']))
{
    $sql = "INSERT INTO artworks (title,artist,genre,yearOfWork,height,width,description,price,ownerID) VALUES ('_title','_artist','_genre',_yearOfWork,_height,_width,'_description',_price,_ownerID)";
    $sql = preg_replace("/_title/",$_POST['title'],$sql);
    $sql = preg_replace("/_genre/",$_POST['genre'],$sql);
    $sql = preg_replace("/_artist/",$_POST['artist'],$sql);
    $sql = preg_replace("/_yearOfWork/",$_POST['yearOfWork'],$sql);
    $sql = preg_replace("/_height/",$_POST['height'],$sql);
    $sql = preg_replace("/_width/",$_POST['width'],$sql);
    $sql = preg_replace("/_description/",$_POST['description'],$sql);
    $sql = preg_replace("/_price/",$_POST['price'],$sql);
    $sql = preg_replace("/_ownerID/",$current_user['userID'],$sql);
//    echo $sql;
//    return;
    $mysql->query($sql);
    $sql="SELECT LAST_INSERT_ID()";
    $sql_result=mysqli_query($mysql,$sql);
    $the_artworkID = mysqli_fetch_row($sql_result)[0];
    $sql="UPDATE artworks SET imageFileName='_imageFileName' WHERE artworkID=".$the_artworkID;
    $sql = preg_replace("/_imageFileName/",$the_artworkID . ".jpg",$sql);
    $mysql->query($sql);
    $imgData = substr($_POST['image'],strpos($_POST['image'],",") + 1);
    $decodedData = base64_decode($imgData);
    file_put_contents("..\\img\\".$the_artworkID . ".jpg",$decodedData);
    $to_echo = "alert('Release _title successfully!');location.replace('release.php?artworkID=_artworkID');";
    $to_echo = preg_replace("/_title/",$_POST['title'],$to_echo);
    $to_echo = preg_replace("/_artworkID/",$the_artworkID,$to_echo);
    echo $to_echo;
    //echo "Release " . $the_artworkID . " successfully!";
}
else
{

    $sql = "UPDATE artworks SET title='_title',artist='_artist',genre='_genre',yearOfWork=_yearOfWork,height=_height,width=_width,description='_description',price=_price,ownerID=_ownerID WHERE artworkID=" . $_POST['artworkID'];
    $sql = preg_replace("/_title/",$_POST['title'],$sql);
    $sql = preg_replace("/_genre/",$_POST['genre'],$sql);
    $sql = preg_replace("/_artist/",$_POST['artist'],$sql);
    $sql = preg_replace("/_yearOfWork/",$_POST['yearOfWork'],$sql);
    $sql = preg_replace("/_height/",$_POST['height'],$sql);
    $sql = preg_replace("/_width/",$_POST['width'],$sql);
    $sql = preg_replace("/_description/",$_POST['description'],$sql);
    $sql = preg_replace("/_price/",$_POST['price'],$sql);
    $sql = preg_replace("/_ownerID/",$current_user['userID'],$sql);
    $mysql->query($sql);
    $imgData = substr($_POST['image'],strpos($_POST['image'],",") + 1);
    $decodedData = base64_decode($imgData);
    file_put_contents("..\\img\\".$_POST['artworkID'] . ".jpg",$decodedData);

    $sql = "UPDATE carts SET changed=1 WHERE artworkID=" . $_POST['artworkID'];
    $mysql->query($sql);


    $to_echo = "alert('Update _title successfully!');location.replace('release.php?artworkID=_artworkID');";
    $to_echo = preg_replace("/_title/",$_POST['title'],$to_echo);
    $to_echo = preg_replace("/_artworkID/",$_POST['artworkID'],$to_echo);
    echo $to_echo;
}
//function release_new()
//{
//    $sql = "INSERT INTO artworks (title,artist,genre,yearOfWork,height,width,description,price,ownerID) VALUES ('_title','_artist','_genre',_yearOfWork,_height,_width,'_description',_price,_ownerID)";
//    $sql = preg_replace("/_title/",$_POST['title'],$sql);
//    $sql = preg_replace("/_genre/",$_POST['genre'],$sql);
//    $sql = preg_replace("/_artist/",$_POST['artist'],$sql);
//    $sql = preg_replace("/_yearOfWork/",$_POST['yearOfWork'],$sql);
//    $sql = preg_replace("/_height/",$_POST['height'],$sql);
//    $sql = preg_replace("/_width/",$_POST['width'],$sql);
//    $sql = preg_replace("/_description/",$_POST['description'],$sql);
//    $sql = preg_replace("/_price/",$_POST['price'],$sql);
//    $sql = preg_replace("/_price/",$current_user['userID'],$sql);
//    $mysql->query($sql);
//    $sql="SELECT LAST_INSERT_ID()";
//    $sql_result=mysqli_query($mysql,$sql);
//    $the_artworkID = mysqli_fetch_row($sql_result)[0];
//    $sql="UPDATE artworks SET imageFileName=_imageFileName WHERE artworkID=".$the_artworkID;
//    $sql = preg_replace("/_imageFileName/",$the_artworkID . ".jpg",$sql);
//    $mysql->query($sql);
//    $imgData = substr($_POST['image'],strpos($_POST['image'],",") + 1);
//    $decodedData = base64_decode($imgData);
//    file_put_contents("..\\img\\".$the_artworkID . ".jpg",$decodedData);
//    echo "Release " . $_POST['title'] . " successfully!";
//}



?>