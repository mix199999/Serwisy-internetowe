<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';
include_once 'class/Video.php';

$database = new Database();

$db = $database->getConnection();




$video = new Video($db);
$videoData = $video->getVideoData();



//print_r($videoData);




