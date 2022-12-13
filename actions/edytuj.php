<?php


include 'conf/connDB.php';
include 'class/Users.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);


$priv= array(
    1 =>1,
    2=>2,
    3=>3

);

$user->IDuser = $_SESSION['uzytkownikID'];

$user->getUserInfo();

echo $user->login;


if(isset($_GET['edit']))
{
    header('Location: index.php?action=zarzadzajUzytkownikami');

}









