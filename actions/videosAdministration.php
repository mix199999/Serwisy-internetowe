<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';
include_once 'class/Video.php';

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


