<?php

include_once 'conf/connDB.php';
include_once 'class/Users.php';



$database = new Database();
$db = $database->getConnection();
$userToModify = new User($db);

$wynik = User::getUsers($db);



if(isset($_GET['edytuj']))
{

    $_SESSION['uzytkownikID'] = $_GET['edytuj'];
    $_SESSION['action']  =edytuj;

        header('Location: index.php?action=edytuj');

}

if(isset($_GET['delete']))
{


    $userToModify->id_user = $_GET['delete'];

    $userToModify->deleteUser();







}
