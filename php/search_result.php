<?php
session_start();
include 'database_connect.php';
if(isset($_SESSION['user']))
{
    $current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
    $current_user_query = mysqli_query($mysql, $current_user_sql);
    $current_user = mysqli_fetch_assoc($current_user_query);
}
$searchAddSql = "WHERE ((orderID IS NULL) AND (title LIKE '%".$_GET['key']."%' OR description LIKE '%".$_GET['key']."%' OR artist LIKE '%".$_GET['key']."%' OR genre LIKE '%".$_GET['key']."%'))";
$sql = "SELECT * FROM artworks " .$searchAddSql." ORDER BY ".$_GET['search_key'] ." " . $_GET['search_order'];

$sql_result = mysqli_query($mysql,$sql);
if($sql_result == null)
{
    echo "fail";
    return;
}
$total_item = $sql_result->num_rows;
if($total_item % 12 == 0)
{
    $total_pagination = $total_item / 12;
}
else
{
    $total_pagination = $total_item / 12 + 1;
}
for($i = 1; $i <= ($_GET['pagination'] - 1) * 12; $i++)
{
    $the_artwork = mysqli_fetch_assoc($sql_result);
}
$the_display = "";

for($i = 1; $i <= min(12,$total_pagination - ($_GET['pagination'] - 1) * 12); $i++)
{
    $the_artwork = mysqli_fetch_assoc($sql_result);
    $str = '<div><img src="img/_imageFileName"><p>_title</p><small>by _artist</small><small id = "description">_description</small><a href="details.php?artworkID=_artworkID">Learn More</a></div>';
    $str = preg_replace("/_imageFileName/",$the_artwork["imageFileName"],$str);
    $str = preg_replace("/_title/",$the_artwork["title"],$str);
    $str = preg_replace("/_artist/",$the_artwork["artist"],$str);
    $str = preg_replace("/_description/",$the_artwork["description"],$str);
    $str = preg_replace("/_artworkID/",$the_artwork["artworkID"],$str);
    $the_display = $the_display . $str;
}
//<ul class="pagination">
//        <li><a class="" href="#">«</a></li>
//        <li><a class="active" href="#">1</a></li>
//
//        <li><a href="#">3</a></li>
//        <li><a href="#">4</a></li>
//        <li><a href="#">5</a></li>
//        <li><a href="#">6</a></li>
//        <li><a href="#">7</a></li>
//        <li><a href="#">»</a></li>
//    </ul>
$pagination = "";
for($i = 1;$i <= $total_pagination; $i++)
{
    if($i != $_GET['pagination'])
    $str = '<li><a onclick="getPagination(_number,\'_key\')">'. $i .'</a></li>';
    else
    $str = '<li><a class="active" onclick="getPagination(_number,\'_key\')">'. $i .'</a></li>';
    $str = preg_replace("/_number/",$i,$str);
    $str = preg_replace("/_key/",$_GET["key"],$str);
    $pagination = $pagination . $str;
}
$to_echo = array("display"=>$the_display,"pagination"=>$pagination);
$to_echo_JSON = json_encode($to_echo);
echo $to_echo_JSON;

?>