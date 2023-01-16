<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;

$database = new Database();
$db = $database->getConnection();


$user = new User($db);


$user->id_user = $_SESSION['id_user'];;



    $result =$user->getUserTickets();



if (isset($_POST['sendMessage']))
{

    $id_ticket = $_POST['caseID'];

    $message =  $_POST['messageText'];





     $user->sendMessage( $id_ticket, $message);



}

if(isset($_POST['sendTicket']))
{
    $ticketTitle = $_POST['ticketTitle'];
    $ticketType = $_POST['ticketType'];
    $ticketMessage = $_POST['ticketMessage'];

    $user->createNewTicket($ticketTitle, $ticketType, $ticketMessage);


    echo'<script>location.href="index.php?action=userChatPage"</script>';








}

