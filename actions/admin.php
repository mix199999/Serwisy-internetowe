<?php



include_once 'conf/connDB.php';
include_once 'class/Users.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);


$user->id_user = $_SESSION["id_user"];

$user->getUserInfo();
//no kurde nie dzialalo inaczej meh
$_SESSION['userName']= $user->login;

?>