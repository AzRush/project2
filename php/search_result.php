<?php
session_start();
include 'database_connect.php';
if(isset($_SESSION['user']))
{
    $current_user_sql = preg_replace("/username/",$_SESSION['user'],'SELECT * FROM users WHERE name="username"');
    $current_user_query = mysqli_query($mysql, $current_user_sql);
    $current_user = mysqli_fetch_assoc($current_user_query);
}
$search_range = "";
$need_OR = 0;
if(isset($_GET['search_title']))
{
    $search_range = $search_range . "title LIKE '%" . $_GET['key'] . "%'";
    $need_OR = 1;
}
if(isset($_GET['search_artist']))
{
    if($need_OR == 0)
        $search_range = $search_range . "artist LIKE '%" . $_GET['key'] . "%'";
    else
        $search_range = $search_range . " OR artist LIKE '%" . $_GET['key'] . "%'";
    $need_OR = 1;
}
if(isset($_GET['search_description']))
{
    if($need_OR == 0)
        $search_range = $search_range . "description LIKE '%" . $_GET['key'] . "%'";
    else
        $search_range = $search_range . " OR description LIKE '%" . $_GET['key'] . "%'";
    $need_OR = 1;
}

if($search_range == "")
{
    echo "fail";
    return;
}
//$searchAddSql = "WHERE ((orderID IS NULL) AND (title LIKE '%".$_GET['key']."%' OR description LIKE '%".$_GET['key']."%' OR artist LIKE '%".$_GET['key']."%' OR genre LIKE '%".$_GET['key']."%'))";
$searchAddSql = "WHERE ((orderID IS NULL) AND (_search_range))";
$searchAddSql = preg_replace("/_search_range/",$search_range,$searchAddSql);
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
$the_max = 12;
if(12 > $total_item - ($_GET['pagination'] - 1) * 12)
    $the_max = $total_item - ($_GET['pagination'] - 1) * 12;
for($i = 1; $i <= $the_max; $i++)
{
    $the_artwork = mysqli_fetch_assoc($sql_result);
    $str = '<div><img src="img/_imageFileName"><p id ="title">_title</p><small id="artist">by _artist</small><small id = "description">_description</small><a href="details.php?artworkID=_artworkID">Learn More</a></div>';
    $str = preg_replace("/_imageFileName/",$the_artwork["imageFileName"],$str);
    $str = preg_replace("/_title/",$the_artwork["title"],$str);
    $str = preg_replace("/_artist/",$the_artwork["artist"],$str);
    $str = preg_replace("/_description/",$the_artwork["description"],$str);
    $str = preg_replace("/_artworkID/",$the_artwork["artworkID"],$str);
    $the_display = $the_display . $str;
}
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