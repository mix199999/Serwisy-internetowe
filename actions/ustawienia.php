<?php
require_once CONN_PATH;
require_once USER_CLASS_PATH;


$database = new Database();
$db = $database->getConnection();


$user = new User($db); //utworzenie nowego obiektu


$user->id_user = $_SESSION['id_user']; //pobranie id zalogowanego usera z sesji

$bgColor=$user->GetColor(); //pobranie ustawionego przez usera koloru z bazy danych (o ile został już wybrany)


if(isset($_POST["Colorsubmit"])){ //sprawdzenie czy w tabeli istnieje już user z danym id

    $iduser = intval($_SESSION["id_user"]);
    $selectQ = "SELECT id_user from user_background_color WHERE id_user =".$iduser;
    $stmt = $db->prepare($selectQ);
    $stmt->execute();
    $result = $stmt->fetch();

    if(empty($result['id_user'])) //jeżeli nie ma id usera w tabeli to wybrany przez niego kolor jest zapisywany w tabeli i zmieniany
    {
        $iduser = intval($_SESSION["id_user"]);
        $selectQ = "INSERT INTO user_background_color (color, id_user) VALUES (?, ?)";
        $stmt = $db->prepare($selectQ);
        $stmt->bindParam(1, $_POST["favcolor"], PDO::PARAM_STR);
        $stmt->bindParam(2, $iduser, PDO::PARAM_INT);
        $stmt->execute();
        $kolor = $_POST["favcolor"];
        echo "<style> body{ background-color: ".$kolor."} </style>";

    }else{ //jezeli id usera jest juz w tabeli to jego wybrany kolor jest aktualizowany
        $iduser = intval($_SESSION["id_user"]);
        $selectQ = "UPDATE user_background_color SET color = ? WHERE id_user =".$iduser;
        $stmt = $db->prepare($selectQ);
        $stmt->bindParam(1, $_POST["favcolor"], PDO::PARAM_STR);
        $stmt->execute();
        $kolor = $_POST["favcolor"];
        echo "<style> body{ background-color: ".$kolor."} </style>";
    }




    
}


if(isset($_GET['changePassword']))
    {

        if($_GET['currentPassword'] =="" || $_GET['newPassword'] == "" || $_GET['confirmNewPassword'] == "")
        {
            echo "<script>alert('Wypełnij wszystkie pola!');</script>";
            return;
        }
        else
        {
//sprawdzenie czy nowe hasła są takie same
            if($_GET['newPassword'] == $_GET['confirmNewPassword'])
            {
                $user->newPasswd = $_GET['newPassword']; 
                $user->oldPasswd = $_GET['currentPassword']; 

                if($user->checkPassword())
                {
                    if($user->changePassword())
                    {


                        echo "<script>alert('Hasło zostało zmienione!');</script>";
                    }
                    else
                    {
                        echo "<script>alert('Wystąpił błąd podczas zmiany hasła!');</script>";
                    }
                }

                else
                {
                    echo "<script>alert('Stare hasło jest niepoprawne!');</script>";
                }

                //sprawdzenie czy stare hasło jest takie samo jak w bazie danych



                
            }
            else
            {
            echo "<script>alert('Hasła nie są takie same!');</script>";
            }
        }

        

    }
