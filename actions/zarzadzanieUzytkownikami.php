<?php

include_once 'conf/connDB.php';
include_once 'class/Users.php';

$userTable = 'users';



$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$sqlQuery = "SELECT login,IDuser,IDpriv FROM ".$userTable;
$stmt = $db->prepare($sqlQuery);
$stmt->execute();
$wynik = $stmt->get_result();
$wynik = $wynik->fetch_all();

if(isset($_GET['edytuj']))
{

    $_SESSION['uzytkownikID'] = $_GET['edytuj'];
    $_SESSION['action']  =edytuj;


        header('Location: index.php?action=edytuj');






}

if(isset($_GET['usun']))
{


    $user->IDuser = $_GET['usun'];

    if($user->deleteUser() == 1)
    {
        header('Location: index.php?action=zarzadzanieUzytkownikami');
    }
    else
    {
        echo"Cannot delete user";
    }




}
