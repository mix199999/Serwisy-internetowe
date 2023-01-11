<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';
include_once 'class/Video.php';

$database = new Database();

$db = $database->getConnection();




$channelName = User::getUserLogin($_SESSION['id_user'],$db);


$movies = Video::getVideosWithUserTags( $channelName,$db);


$modifiedLinks = [];
$randomIndices = [];
$randomMovies = [];
foreach ($movies as $movie)
{
    if($movie['extension'] == 'url')
        $modifiedLinks[] = Video::youtube_link_to_embed($movie['url']);
    else
        $modifiedLinks[] = $movie['url'];
}

foreach ($movies as $movie) {
    $randomIndex = array_rand($modifiedLinks);
    while (in_array($randomIndex, $randomIndices)) {
        $randomIndex = array_rand($modifiedLinks);
    }
    $randomIndices[] = $randomIndex;
    $randomMovies[] = $modifiedLinks[$randomIndex];
    //you can display the $randomMovies here
}



















