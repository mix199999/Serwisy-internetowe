<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';
include_once 'class/Users.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id_user = $_SESSION["id_user"];
$user->getUserInfo();

$currentIndex = isset($_GET['index']) ? intval($_GET['index']) : 0; //index filmu przy wyswietlaniu ich na stronie

if(isset($_GET['v'])) 
{
    $oneVideoUrl = Video::getVideo($_GET['v'], $db);           //jezeli jest ustawione v w linku to pobieramy jedno video o id=v
    $editorId = Video::getEditorUsername($_GET['v'], $db);      // oraz pobieramy nazwe tworcy filmu z tabeli uploaded_videos

    if (!empty(Video::getEditorUsername($oneVideoUrl['id_video'], $db)))    //sprawdzamy czy jest tworca danego filmu bo niektore byly na sztywno bez
    {
        $editor = Video::getEditorUsername($oneVideoUrl['id_video'], $db);  //jezeli jest to pobieramy id filmu z tablicy filmow i dostajemy informacje
        $editorId = $editor['login'];                                                 //z editor wyciagamy login i mamy login tworcy
    } else 
    {
        $editorId = 'null';                                                   //dla braku edytora ustawiamy brak edytora
    }
}
else 
{
    $urlTable = Video::getVideosWithUserTags($user->login, $db);                        //jezeli nie jest v to pobieramy tablice wszystkich filmow z tagami
    if (!empty(Video::getEditorUsername($urlTable[$currentIndex]['id_video'], $db)))    //sprawdzamy czy jest tworca danego filmu bo niektore byly na sztywno bez
    {
        $editor = Video::getEditorUsername($urlTable[$currentIndex]['id_video'], $db);  //jezeli jest to pobieramy id filmu z tablicy filmow i dostajemy informacje
        $editorName = $editor['login'];                                                 //z editor wyciagamy login i mamy login tworcy
    } else 
    {
        $editorName = 'null';                                                   //dla braku edytora ustawiamy brak edytora
    }
}
?>