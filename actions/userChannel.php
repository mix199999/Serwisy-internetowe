<?php

require_once CONN_PATH;
require_once USER_CLASS_PATH;
require_once VIDEO_CLASS_PATH;

$database = new Database();

$db = $database->getConnection();




$channelName = $_GET['channel'];


$movies = Video::getVideosByLogin( $channelName,$db);


$modifiedLinks = [];

foreach ($movies as $movie)
{
    if($movie['extension'] == 'url'){
        $modifiedLinks[] = array(
            'url' => Video::youtube_link_to_embed($movie['url']),
            'title' => $movie['title']
        );
    }
    else if(file_exists($movie['url']))
    {
        $modifiedLinks[] = array(
            'url' => $movie['url'],
            'title' => $movie['title']
        );
    }
}



















