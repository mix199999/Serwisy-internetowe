<?php
include_once 'conf/connDB.php';
include_once 'class/Users.php';


$database = new Database();
$db = $database->getConnection();


$user = new User($db);


$user->id_user = $_SESSION['id_user'];

$bgColor=$user->GetColor();


if(isset($_POST["Colorsubmit"])){

    $iduser = intval($_SESSION["id_user"]);
    $selectQ = "SELECT id_user from user_background_color WHERE id_user =".$iduser;
    $stmt = $db->prepare($selectQ);
    $stmt->execute();
    $result = $stmt->fetch();

    if(empty($result['id_user']))
    {
        $iduser = intval($_SESSION["id_user"]);
        $selectQ = "INSERT INTO user_background_color (color, id_user) VALUES (?, ?)";
        $stmt = $db->prepare($selectQ);
        $stmt->bindParam(1, $_POST["favcolor"], PDO::PARAM_STR);
        $stmt->bindParam(2, $iduser, PDO::PARAM_INT);
        $stmt->execute();
        $kolor = $_POST["favcolor"];
        echo "<style> body{ background-color: ".$kolor."} </style>";

    }else{
        $iduser = intval($_SESSION["id_user"]);
        $selectQ = "UPDATE user_background_color SET color = ? WHERE id_user =".$iduser;
        $stmt = $db->prepare($selectQ);
        $stmt->bindParam(1, $_POST["favcolor"], PDO::PARAM_STR);
        $stmt->execute();
        $kolor = $_POST["favcolor"];
        echo "<style> body{ background-color: ".$kolor."} </style>";
    }

}


