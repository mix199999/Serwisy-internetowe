<?php

include_once'../conf/connDB.php';

$userTable = 'users';



$database = new Database();
$db = $database->getConnection();

$sqlQuery = "SELECT * FROM ".$userTable;
$stmt = $this->conn->prepare($sqlQuery);
$stmt->execute();
$result = $stmt->get_results();
//todo fetch
