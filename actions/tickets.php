
<?php



include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);


$user->id_user = $_SESSION['id_user'];;


$result = User::getTable($db, 'tickets');



if (isset($_POST['sendMessage']))
{

    $id_ticket = $_POST['caseID'];

    $message =  $_POST['messageText'];


    $user->sendMessage( $id_ticket, $message);

}
