<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;

$database = new Database();
$db = $database->getConnection();
$user = new User($db);


$user->id_user = $_SESSION["id_user"];





$user->getUserInfo();
//no kurde nie dzialalo inaczej meh
$_SESSION['userName'] = $user->login;
?>