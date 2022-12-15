<?php

include_once 'conf/connDB.php';
include_once 'class/Tag.php';



$database = new Database();
$db = $database->getConnection();
$tag = new Tag($db);

$all_tags = Tag::getTags($db); //pobranie wzystkich tagów
$tags_number = Tag::getTagsNumber($db); // pobranie ilosci tagów


$zbior = Tag::GenTag($tags_number[0][0]); //generacja zbioru tagów do lowania
$losowanie = Tag::GenUnique($zbior,3); //losowanie tagów ze zbioru bez powtrzeń