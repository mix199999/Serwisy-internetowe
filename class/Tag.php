<?php 
class Tag{

    private $conn;
	private static $tagsTable = 'tags';
	

	public function __construct($db){
        $this->conn = $db;
    }	    

    public static function getTags($db)
    {
        $selectQ = "SELECT id_tag, tag from ".Tag::$tagsTable;
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return($stmt->fetchAll());
    }

    public static function getTagsNumber($db)
    {
        $selectQ = "SELECT Count(id_tag) from ".Tag::$tagsTable;
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return($stmt->fetchAll());
    }

}
?>