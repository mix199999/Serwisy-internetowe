<?php

include_once 'conf/connDB.php';
include_once 'class/Tag.php';



$database = new Database();
$db = $database->getConnection();
$tag = new Tag($db);

$all_tags = Tag::getTags($db);
$tags_number = Tag::getTagsNumber($db);
//todo rand zmienic zeby bylo bez powtorzen
//echo rand(0,$tags_number[0][0]);