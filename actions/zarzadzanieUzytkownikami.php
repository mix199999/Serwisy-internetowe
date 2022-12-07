<?php

include_once 'conf/connDB.php';
$userTable = 'users';



$database = new Database();
$db = $database->getConnection();

$sqlQuery = "SELECT login,IDuser,IDpriv FROM ".$userTable;
$stmt = $db->prepare($sqlQuery);
$stmt->execute();
$wynik = $stmt->get_result();
$wynik = $wynik->fetch_all();

