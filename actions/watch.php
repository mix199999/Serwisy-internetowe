<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';
include_once 'class/Users.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$user->id_user = $_SESSION["id_user"];
$user->getUserInfo();

$urlTable = Video::getVideosWithUserTags($user->login, $db);
$currentIndex = isset($_GET['index']) ? intval($_GET['index']) : 0; //index filmu przy wyswietlaniu ich na stronie

?>