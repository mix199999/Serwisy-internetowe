<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';
include_once 'class/Video.php';

$database = new Database();

$db = $database->getConnection();




$channelName = $_GET['channel'];


$movies = Video::getVideosByLogin( $channelName,$db);


$modifiedLinks = [];

foreach ($movies as $movie)
{
    if($movie['extension'] == 'url')
        $modifiedLinks[] = Video::youtube_link_to_embed($movie['url']);
    else if(file_exists($movie['url']))
    {
        $modifiedLinks[] = $movie['url'];
    }
}



















