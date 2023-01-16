<?php
define('_SERWER_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))));


require_once _SERWER_PATH . '/conf/connDB.php';
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

foreach($choice as $wybor)
{
    $stmt2 = $db->prepare("INSERT INTO reported_video_reasons (reason_id, video_id ) VALUES (:reason, :video_id)");
    $stmt2->bindParam(':reason', $wybor);
    $stmt2->bindParam(':video_id', $id_video);
    $stmt2->execute();
}
