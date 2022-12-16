<?php
    include_once 'conf/connDB.php';


    $database = new Database();
    $db = $database->getConnection();
$zapytanie = "SELECT IDuser, IDpriv, login, passwd FROM users";
//$zap = "INSERT INTO users (IDuser, IDpriv, login, passwd) VALUES (4, 3, 'edytor', 'edytor')";
//$zapy = "INSERT INTO privileges (IDpriv, role_name) VALUES (3, editor)";
$stmt = $db->prepare($zapytanie);
$stmt->execute();
$wynik = $stmt->get_result();
$wynik = $wynik->fetch_all();
//$db->commit()



?>