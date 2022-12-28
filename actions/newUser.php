<?php

include_once 'conf/connDB.php';
include_once 'class/Tag.php';
include_once 'class/Video.php';



$database = new Database();
$db = $database->getConnection();

$all_tags = Tag::getTags($db); //pobranie wzystkich tagów
$tags_number = Tag::getTagsNumber($db); // pobranie ilosci tagów

echo $_SESSION["id_user"];
if(isset($_POST["tag"]))
{
    $ile_wybrano = count($_POST["tag"]);

    $iduser = intval($_SESSION["id_user"]);
    Video::getSelectedTags($db, $ile_wybrano, $iduser);


}

?>