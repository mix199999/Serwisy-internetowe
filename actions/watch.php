<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';
include_once 'class/Users.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id_user = $_SESSION["id_user"];
$user->getUserInfo();

$videoExist = true;
$currentIndex = isset($_GET['index']) ? intval($_GET['index']) : 0; //index filmu przy wyswietlaniu ich na stronie

$userRole = User::checkRole($db,  $_SESSION['id_user']);  //sprawdzenie jaka role ma user

if(isset($_GET['v']))       //sprawdzamy czy w linku podana jest zmienna v
{   
    $v = intval($_GET['v']);    //jeżeli jest to pobieramy v i konwertujemy do inta
    if(is_int($v) && $v>0)      //sprawdzamy czy to int, jak jest string to wartosc 0 to string, dlatego tutaj sprawdzamy wieksze od 0 bo chcemy nizej miec inta
    {        
        $oneVideoUrl = Video::getVideo($_GET['v'], $db);           //jezeli jest ustawione v w linku to pobieramy jedno video o id=v
        if(!empty($oneVideoUrl['extension']))               //sprawdzamy czy taki film istnieje
        {
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
            $videoExist = false;                            //jezeli film nie istnieje ustawiamy false
        }
    }
    else                        //jeżeli v okazało się stringiem czyli np linkiem do filmu
    {
        if(Video::isEmbed($_GET['v']) == true)      //sprawdzamy czy link to embed youtube
        {
            $link = Video::youtube_embed_to_link($_GET['v']);       //jezeli tak to konwertujemy go z powrotem w zwykly link youtube bo takie mamy w bazie danych
        }
        else $link = $_GET['v'];                    //jezeli nie byl to embed to po prostu pobieramy link

        $video = Video::getVideoIdFromUrl($link, $db);                  //pobieramy id filmu z pobranego linku
        if(!empty($video['extension']))
        {
            $oneVideoUrl = Video::getVideo($video['id_video'], $db);        //reszta jak wcześniej
        
            if (!empty(Video::getEditorUsername($oneVideoUrl['id_video'], $db))) {
                $editor = Video::getEditorUsername($oneVideoUrl['id_video'], $db);
                $editorId = $editor['login'];
            } else {
                    $editorId = 'null';
            }
        }
        else
        {
            $videoExist = false;                            //jezeli film nie istnieje ustawiamy false
        }
    }
}
else 
{
    $urlTable = Video::getVideosWithUserTags($user->login, $db);                        //jezeli nie jest v to pobieramy tablice wszystkich filmow z tagami
    if(!empty($urlTable[$currentIndex]['extension']))                       //sprawdzenie czy taki film wgl istnieje
    {
        if (!empty(Video::getEditorUsername($urlTable[$currentIndex]['id_video'], $db)))    //sprawdzamy czy jest tworca danego filmu bo niektore byly na sztywno bez
        {
            $editor = Video::getEditorUsername($urlTable[$currentIndex]['id_video'], $db);  //jezeli jest to pobieramy id filmu z tablicy filmow i dostajemy informacje
            $editorName = $editor['login'];                                                 //z editor wyciagamy login i mamy login tworcy
        } else 
        {
            $editorName = 'null';                                                   //dla braku edytora ustawiamy brak edytora
        }
    }
    else
    {
        $videoExist = false;                            //jezeli film nie istnieje ustawiamy false
    }
}
?>