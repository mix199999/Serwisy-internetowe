<?php 
class User{
	
	
	private $userTable = 'users';	
	private $conn;

	public function login(){
		if($this->login && $this->passwd) 
		{
			$sqlQuery = "SELECT * FROM ".$this->userTable." WHERE login = ? AND passwd = ?";	

			$stmt = $this->conn->prepare($sqlQuery);
			//("ss", $this->login, md5($this->passwd));		
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['IDuser'];
				$_SESSION["user_type"] = $user['IDpriv'];
				$_SESSION["name"] = $user['login'];					
				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}

    
    function __construct($db) 
    {
		$this->conn = $db;
    }


    function __destruct() {
        
    }
}

?>