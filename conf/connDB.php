<?php 

class Database{
	
	private $server  = 'db.lcyymlqiyvommyghfjhw.supabase.co';
    private $user  = 'postgres';
    private $password   = "Rhl7CnX1VvhfU3jt";
    private $db  = "postgres";


//$dsn = "pgsql:host=$host;port=5432;dbname=$db;";



   // user=postgres password=[YOUR-PASSWORD] host=db.lcyymlqiyvommyghfjhw.supabase.co port=5432 dbname=postgres
	public function getConnection()
	{
        //todo try... catch...
        try {

            $dsn = "pgsql:host=$this->server;port=5432;dbname=$this->db;";
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