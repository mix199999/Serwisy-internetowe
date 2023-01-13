<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';
include_once 'class/Video.php';

$database = new Database();

$db = $database->getConnection();




$channelName = User::getUserLogin($_SESSION['id_user'],$db);



$movies = Video::getStaticVideosWithUserTags( $channelName,$db);


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



















