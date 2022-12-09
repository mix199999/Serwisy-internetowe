<?php 

class Database{
	
	private $server  = 'bw9c8o4nfp6czlfh6bd9-mysql.services.clever-cloud.com';
    private $user  = 'uc0bqv5edm6pmbkv';
    private $password   = "GR3CFHvPgSUYHPzP8bFI";
    private $db  = "bw9c8o4nfp6czlfh6bd9"; 
    
	public function getConnection()
	{
        //todo try... catch...
        try {
            $conn = new PDO('mysql:host='.$this->server.';dbname='.$this->db,$this->user,$this->password);
            return  $conn;

        }catch (PDOException $e)
        {
            die("Error failed to connect to MySQL: " . $e->getMessage());
        }
		//$conn = new mysqli($this->server, $this->user, $this->password, $this->db);

    }
}


?>