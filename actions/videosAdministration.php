<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;
require_once VIDEO_CLASS_PATH;

$database = new Database();

$db = $database->getConnection();




$video = new Video($db);
$videoData = $video->getVideoData();



if(isset($_GET['reject']))
{

    $video->id_video = $_GET['reject'];
    $video->deleteVideoReport();


}
else if(isset($_GET['deleteVideo']))
{
    $video->id_video = $_GET['deleteVideo'];
    $video->deleteCascadeVideo();
}


