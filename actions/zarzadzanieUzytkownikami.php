<?php

require_once CONN_PATH;
require_once USER_CLASS_PATH;


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



    echo '<script>$("#example").DataTable().ajax.reload();</script>';


}

if(isset($_GET['delete'])) {
    $userToModify->id_user = $_GET['delete'];
    if($userToModify->deleteCascadeUser()) {
        // remove the row from the table using javascript
        echo '<script>';
        echo '  table.row("#userId"+userId).remove().draw();';
        echo '</script>';
    }
}

