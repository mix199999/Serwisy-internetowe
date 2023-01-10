
<?php



include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();
$db = $database->getConnection();



$result = User::getTable($db, 'tickets');



if (isset($_POST['sendMessage']))
{

    $id_ticket = $_POST['caseID'];
    $id_sender = $_POST['senderID'];
    $message =  $_POST['messageText'];


    if( User::sendMessage($db, $id_ticket, $message, $id_sender))
       return 1;
    else
       return 0;



}
