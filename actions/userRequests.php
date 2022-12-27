<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();
$db = $database->getConnection();



$result = User::getRequest($db);




if(isset($_POST['send']))
{
    $adminMessage = $_POST['adminComment'];

    $caseID = $_POST['requestID'];
    echo '-----';
    echo $caseID;
    echo '-----';
    echo $adminMessage;



}

