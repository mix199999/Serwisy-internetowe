<?php


// Include the User class file
require_once $_SERVER['DOCUMENT_ROOT'].'/conf/connDB.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Users.php';


// Connect to the database
$database = new Database();
$db = $database->getConnection();


if (isset($_POST['idCase']) and $_POST['idCase'] != null) {

    $id_ticket = $_POST['idCase'];

    $messages = User::getConversation($db, $id_ticket);


    $response = [];


    foreach ($messages as $message) {
        $response[] = '<p>' . $message['message'] . '</p>';
    }


    echo json_encode($response);
}

