<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/conf/connDB.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Users.php';



$database = new Database();
$db = $database->getConnection();


$wynik = User::getUsers($db);

$userToModify = new User($db);


if(isset($_POST['alterUser']))
{
    $userToModify->id_user =  $_POST['id_user'];
    $userToModify->login = $_POST['login'];
    $userToModify->IDpriv = $_POST['account-type'];
    $userToModify->email = $_POST['email'];

    $userBefore = new User($db);
    $userBefore->id_user = $_POST['id_user'];

     $userBefore->compareUserInfo($userToModify);






}

if(isset($_GET['delete']))
{


    $userToModify->id_user = $_GET['delete'];

    if($userToModify->deleteCascadeUser())
    {
        echo "<script>location.reload();</script>";

    }



}
