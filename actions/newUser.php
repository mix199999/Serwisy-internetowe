<?php

require_once CONN_PATH;
require_once USER_CLASS_PATH;
require_once TAGS_CLASS_PATH;
require_once VIDEO_CLASS_PATH;



$database = new Database();
$db = $database->getConnection();

$all_tags = Tag::getTags($db); //pobranie wzystkich tagów
$tags_number = Tag::getTagsNumber($db); // pobranie ilosci tagów

if(isset($_POST["tag"]) && isset($_POST["submit"])) // sprawdzenie czy user wybral tagi jak tak to zapisac te tagi do bazy danych
{
    $ile_wybrano = count($_POST["tag"]);

    $iduser = intval($_SESSION["id_user"]);
    Video::getSelectedTags($db, $ile_wybrano, $iduser);

    echo'<script>location.href="index.php?action=StartPage"</script>';





}
else if(empty($_POST["tag"]) && isset($_POST["submit"])){
    echo "<script>alert('Musisz wybrać conajmniej jeden tag!')</script>";

}

