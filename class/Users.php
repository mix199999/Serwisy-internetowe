<?php 
class User{

    private $conn;
	public static $userTable = 'users';



    public static function getUserTable()
    {
       // return $userTable;
    }



	
	public function __construct($db){
        $this->conn = $db;
    }	    
	//siema
	public function login(){
		if($this->login && $this->passwd) {
			$sqlQuery = "SELECT * FROM ".User::$userTable." WHERE login = ? AND passwd = ?";
            $stmt = $this->conn->prepare($sqlQuery);
            //inne bindowanie
			$stmt->bindParam(1, $this->login, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->passwd, PDO::PARAM_STR);
			$stmt->execute();
			//$result = $stmt->getResult();
			if($user = $stmt->fetch(PDO::FETCH_ASSOC))
            {
				$_SESSION["userid"] = $user['IDuser'];
				$_SESSION["user_type"] = $user['IDpriv'];
				$_SESSION["name"]	= $user['login'];	
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
        if($this-> IDuser)
        {
            $deleteQuery = "DELETE FROM ".User::$userTable." WHERE IDuser = ?";
            $stmt = $this->conn->prepare($deleteQuery);
            $stmt->bindParam(1, $this->IDuser, PDO::PARAM_INT);

            $stmt->execute();
            return 1;
        }
        else
        {
            echo "Cannot drop user";
            return 0;
        }



    }

    public function getUserInfo()
    {

        if($this->IDuser)
        {
            $getQuery = "SELECT * FROM ".User::$userTable." WHERE IDuser = ?";
            $stmt = $this->conn->prepare($getQuery);
            $stmt->bindParam(1, $this->IDuser, PDO::PARAM_INT);
            $stmt->execute();
            if($user = $stmt->fetch(PDO::FETCH_ASSOC))
            {

                $this->login = $user['login'];
                $this->IDpriv = $user['IDpriv'];

                return 1;
            }

            return 1;
        }
        else
        {

            echo "Cannot get user param";
            return 0;
        }



    }


    public function updateUser()
    {
        //todo
        if($this->login && $this->IDpriv )
        {
            $updateQuery = "UPDATE ".User::$userTable." SET login = ?, IDpriv = ? WHERE IDuser = ?";
            $stmt = $this->conn->prepare($updateQuery);

            $stmt->bindParam(1, $this->login, PDO::PARAM_STR);
            $stmt->bindParam(2, $this->IDpriv, PDO::PARAM_INT);
            $stmt->bindParam(3, $this->IDuser, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->commit();



        }

    }


    public static function getUsers($db)
    {
        $selectQ = "SELECT u.login,u.IDuser, p.role_name FROM users as u join privileges as p on (u.IDpriv = p.IDpriv) ";
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return($stmt->fetchAll());
    }


    public function insertUser()
    {

    }




}




?>