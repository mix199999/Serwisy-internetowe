<?php 

class Database{
	
	private $server  = 'bw9c8o4nfp6czlfh6bd9-mysql.services.clever-cloud.com';
    private $user  = 'uc0bqv5edm6pmbkv';
    private $password   = "GR3CFHvPgSUYHPzP8bFI";
    private $db  = "bw9c8o4nfp6czlfh6bd9"; 
    
	public function getConnection()
	{		
		$conn = new mysqli($this->server, $this->user, $this->password, $this->db);
		if($conn->connect_error){
			die("Error failed to connect to MySQL: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}

?>