<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();
$db = $database->getConnection();



$result = User::getRequest($db);




if(isset($_POST['send']))
{
    $adminMessage = $_POST['adminComment'];

    $request_id= intval($_POST['requestID']);

    if($_POST['send'] == 'accept')
    {
        User::replyForUserRequest($adminMessage,$request_id,true,$db);
    }
    else if($_POST['send'] == 'reject')
    {
        User::replyForUserRequest($adminMessage,$request_id,false,$db);
    }






}

