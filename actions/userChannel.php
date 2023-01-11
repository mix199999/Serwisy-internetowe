<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();

$db = $database->getConnection();


$user = new User($db);


















