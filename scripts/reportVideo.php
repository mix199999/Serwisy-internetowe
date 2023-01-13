<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/conf/connDB.php';

$database = new Database();
$db = $database->getConnection();

        $id_user=$_POST['id_user'];
        $reason = $_POST['reason'];
        $id_video = $_POST['idVideo'];
        $choice = $_POST['choice'];

        $stmt = $db->prepare("INSERT INTO reported_videos (video_id, description) VALUES (:idVideo, :description)");
        $stmt->bindParam(':idVideo', $id_video);
        $stmt->bindParam(':description', $reason);
        $stmt->execute();

        $stmt2 = $db->prepare("INSERT INTO reported_video_reasons (reason, video_id ) VALUES (:reason, :video_id)");
        $stmt2->bindParam(':reason', $choice);
        $stmt2->bindParam(':video_id', $id_video);
        $stmt2->execute();