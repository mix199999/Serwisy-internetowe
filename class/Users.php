<?php 
class User
{

    private $conn;
    public static $userTable = 'users';


    public function __construct($db)
    {
        $this->conn = $db;
    }

    //siema
    public function login()
    {
        if ($this->login && $this->passwd) {
            $sqlQuery = "SELECT * FROM " . User::$userTable . " WHERE login = ? AND passwd = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            //inne bindowanie
            $stmt->bindParam(1, $this->login, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->passwd, PDO::PARAM_STR);
            $stmt->execute();
            //$result = $stmt->getResult();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION["user_type"] = $user['id_priv'];
                $_SESSION["id_user"] = $user['id_user'];
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public function addUser()
    {
        if ($this->login && $this->passwd && $this->email && $this->id_priv) {
            $insertQuery = "INSERT INTO users (id_priv,login, passwd, email ) VALUES (?,?,?,?)";
            $stmt = $this->conn->prepare($insertQuery);
            $stmt->bindParam(1, $this->id_priv, PDO::PARAM_INT);
            $stmt->bindParam(2, $this->login, PDO::PARAM_STR);
            $stmt->bindParam(3, $this->passwd, PDO::PARAM_STR);
            $stmt->bindParam(4, $this->email, PDO::PARAM_STR);
            $stmt->execute();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $_SESSION["user_type"] = $user['id_priv'];
                $_SESSION["id_user"] = $user['id_user'];

                return 1;
            } else {
                return 0;
            }

        } else {
            return 0;
        }

    }


    public function deleteUser()
    {
        if ($this->id_user) {
            $deleteQuery = "DELETE FROM " . User::$userTable . " WHERE id_user = ?";
            $stmt = $this->conn->prepare($deleteQuery);
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);

            $stmt->execute();
            return 1;
        } else {
            echo "Cannot drop user";
            return 0;
        }


    }

    public function getUserInfo()
    {

        if ($this->id_user) {
            $getQuery = "SELECT * FROM " . User::$userTable . " WHERE id_user = ?";
            $stmt = $this->conn->prepare($getQuery);
            $stmt->bindParam(1, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $this->login = $user['login'];
                $this->IDpriv = $user['id_priv'];

                return 1;
            }

            return 1;
        } else {

            echo "Cannot get user param";
            return 0;
        }


    }


    public function updateUser()
    {
        //todo
        if ($this->login && $this->id_priv) {
            $updateQuery = "UPDATE " . User::$userTable . " SET login = ?, id_priv = ? WHERE id_user = ?";
            $stmt = $this->conn->prepare($updateQuery);

            $stmt->bindParam(1, $this->login, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->id_priv, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->id_user, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->commit();


        }

    }


    public static function getUsers($db)
    {
        $selectQ = "SELECT u.login,u.id_user, p.role_name, u.email FROM users as u join privileges as p on (" . "u.id_priv" . "=" . "p.id_priv" . ")";
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return ($stmt->fetchAll());
    }


    public function insertUser()
    {

    }


    public static function getRequest($db)
    {
        $selectQ = "SELECT * FROM privilege_change_request";
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return ($stmt->fetchAll());

    }


    public static function getUserLogin($id, $db)
    {

        if ($id != '') {
            $getQuery = "SELECT login FROM " . User::$userTable . " WHERE id_user = ?";
            $stmt = $db->prepare($getQuery);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {

                $login = $user['login'];


                return $login;
            }

            return 1;
        } else {

            echo "Cannot get user param";
            return 0;
        }


    }

    public static function replyForUserRequest ($adminMessage,  $request_id, $newType, $db )
    {
        if($newType)
        {
            $getUserID = "SELECT user_id FROM privilege_change_request WHERE case_id = ?";
            $stmt = $db->prepare($getUserID);
            $stmt->bindParam(1, $request_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $user_id = $user['user_id'];

                if(self::checkRole($db, $user_id)== 2)
                {
                    self::updateRole($db,$user_id,3);
                    self::sendAdminReply($db,$adminMessage,$request_id);

                }
                elseif (self::checkRole($db,$user_id) == 3)
                {
                    self::sendAdminReply($db,$adminMessage,$request_id);
                }



            }

        }
        else
        {
            $getUserID = "SELECT user_id FROM privilege_change_request WHERE case_id = ?";
            $stmt = $db->prepare($getUserID);
            $stmt->bindParam(1, $request_id, PDO::PARAM_INT);
            $stmt->execute();
            if ($user = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                self::sendAdminReply($db,$adminMessage,$request_id);
            }
        }

    }

    public static function checkRole($db, $user_id)
    {
        $getUserRole = "SELECT id_priv FROM ".User::$userTable." WHERE user_id = ?";
        $stmt = $db->prepare($getUserRole);
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            return $user['user_id'];

        }
        else
            return 0;



    }

    public static function updateRole($db, $user_id , $newRole)
    {
        $updateRole = "UPDATE ".User::$userTable." SET id_priv  = ? WHERE user_id = ?";
        $stmt = $db->prepare($updateRole);
        $stmt->bindParam(1, $newRole, PDO::PARAM_INT);
        $stmt->bindParam(2, $user_id, PDO::PARAM_INT);
        $stmt->execute();


    }

    public static function sendAdminReply($db,$message, $request_id)
    {
        $sendQuery = "UPDATE privilege_change_request SET admin_message  = ? WHERE case_id = ?";
        $stmt = $db->prepare($sendQuery);
        $stmt->bindParam(1, $message, PDO::PARAM_STR);
        $stmt->bindParam(2, $request_id, PDO::PARAM_INT);
        $stmt->execute();



    }







}




?>