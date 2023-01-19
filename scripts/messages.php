<?php
define('_SERWER_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))));

// Include the User class file

require_once _SERWER_PATH . '/class/Users.php';
require_once _SERWER_PATH . '/conf/connDB.php';







// Connect to the database
$database = new Database();
$db = $database->getConnection();


if (isset($_POST['idCase']) and $_POST['idCase'] != null) {

    $id_ticket = $_POST['idCase'];
    $user_id = $_POST["idUser"];

    $messages = User::getConversation($db, $id_ticket);


    $response = [];



    foreach ($messages as $message) {

                if($user_id == $message['sender_id'])
                {

                    $response[] =    '<div class="d-flex flex-row justify-content-end">
                    <div>
                      <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-primary">'.$message['message'] .'</p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end">You</p>
                    </div>
                  </div>';





                }
                else
                {




                    $response[] =    '<div class="d-flex flex-row justify-content-start">
                    <div>
                      <p class="small p-2 ms-3 mb-1 rounded-3" style="background-color: #f5f6f7;">'.$message['message'] .'</p>
                      <p class="small ms-3 mb-3 rounded-3 text-muted float-end">'.User::getUserLogin($message['sender_id'], $db).'</p>
                    </div>
                  </div>';

                }





    }


    //$response = ' <p class="small ms-3 mb-3 rounded-3 text-muted float-end">aaaaaaaa</p>';
    echo json_encode($response);
}

