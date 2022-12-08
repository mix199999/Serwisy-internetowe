<?php 
class User{
	
	
	private $userTable = 'users';	
	private $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	//siema
	public function login(){
		if($this->login && $this->passwd) {
			$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE login = ? AND passwd = ?";
            $stmt = $this->conn->prepare($sqlQuery);
			$stmt->bind_param("ss", $this->login, $this->passwd);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0)
            {
				$user = $result->fetch_assoc();
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
            $deleteQuery = "DELETE FROM ".$this->userTable." WHERE IDuser = ?";
            $stmt = $this->conn->prepare($deleteQuery);
            $stmt->bind_param("d", $this->IDuser);
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
            $getQuery = "SELECT * FROM ".$this->userTable." WHERE IDuser = ?";
            $stmt = $this->conn->prepare($getQuery);
            $stmt->bind_param("d", $this->IDuser);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $user = $result->fetch_assoc();
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
        if($this->login && $this->IDpriv )
        {
            $updateQuery = "UPDATE ".$this->userTable." SET login = ?, IDpriv = ? WHERE IDuser = ?";
            $stmt = $this->conn->prepare($updateQuery);
            $stmt->bind_param("sdd",$this->login,$this->IDpriv, $this->IDuser);
            $stmt->execute();



        }

    }

    public function insertUser()
    {

    }




}




?>