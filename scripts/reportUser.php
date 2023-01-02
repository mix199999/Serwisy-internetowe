<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/conf/connDB.php';

$database = new Database();
$db = $database->getConnection();

        $id_user=$_POST['id_user2'];
        $id_reportedUser=$_POST['id_reportedUser2'];
        $reason = $_POST['reason2'];
        $title = $_POST['title2'];

        /*
        $stmt = $db->prepare("INSERT INTO privilege_change_request (user_id, case_status, user_message, admin_message, title) VALUES (:user_id, true, :user_message, null, :title)");
        $stmt->bindParam(':user_id', $id_user);
        $stmt->bindParam(':user_message', $reason);
        $stmt->bindParam(':title', $title);
        $stmt->execute();
        */
