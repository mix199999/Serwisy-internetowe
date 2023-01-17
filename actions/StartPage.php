<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;
require_once VIDEO_CLASS_PATH;

$database = new Database();

$db = $database->getConnection();





$channelName = User::getUserLogin($_SESSION['id_user'],$db);

if($movies = Video:: getVideosForStartPage( $_SESSION['id_user'],$db))
{
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
}
else
{
    echo "<div class='row col-12 vh-100 d-flex justify-content-center align-items-start'>";
    echo "<div class='col-md-12 text-center '><img src='icons/errorVideo.png' alt='error' width='300' height='300'></div>";
    echo "<div class='col-md-12 text-center '><h1 class=' font-weight-bold'>Brak filmów do wyświetlenia</h1></div>";    
    echo "<div class='col-md-12 text-center '><a href='index.php?action=newUser'><button class='btn btn-secondary mx-2'>Wybierz ponownie tagi</button></a></div>";
    echo "</div>";
}
























