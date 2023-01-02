<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/conf/connDB.php';

$database = new Database();
$db = $database->getConnection();

if(isset($_POST['reason3']) and isset($_POST['title3']) ){

        $id_user=$_SESSION["id_user"];
        $reason = $_POST['reason3'];
        $title = $_POST['title3'];

        $stmt = $db->prepare("INSERT INTO privilege_change_request (case_id, user_id, case_status, user_message, admin_message, title) VALUES (null, :user_id, 1, :user_message, null, :title)");
        $stmt->bindParam(':user_id', $id_user);
        $stmt->bindParam(':user_message', $reason);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
}
