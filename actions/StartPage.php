<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;
require_once VIDEO_CLASS_PATH;

$database = new Database();

$db = $database->getConnection();





$channelName = User::getUserLogin($_SESSION['id_user'],$db);


$movies = Video:: getVideosForStartPage( $_SESSION['id_user'],$db);




$user = new User($db);

$user->id_user = $_SESSION['id_user'];

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



















