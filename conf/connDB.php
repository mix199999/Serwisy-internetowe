<?php 

class Database{
	
	private $server  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $db  = "projekt";


//$dsn = "pgsql:host=$host;port=5432;dbname=$db;";



   // user=postgres password=[YOUR-PASSWORD] host=db.lcyymlqiyvommyghfjhw.supabase.co port=5432 dbname=postgres
	public function getConnection()
	{
        //todo try... catch...
        try {

            $dsn = "mysql:host=$this->server;port=3306;dbname=$this->db;";
            $conn = new PDO($dsn,$this->user,$this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return  $conn;

        }catch (PDOException $e)
        {
            die("Error failed to connect to MySQL: " . $e->getMessage());
        }
		//$conn = new mysqli($this->server, $this->user, $this->password, $this->db);

    }
}


?>