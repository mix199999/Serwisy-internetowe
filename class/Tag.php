<?php 
class Tag{

    private $conn;
	private static $tagsTable = 'tags';
	

	public function __construct($db){
        $this->conn = $db;
    }	    

    public static function getTags($db)
    {
        $selectQ = "SELECT distinct tag from ".Tag::$tagsTable;
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return($stmt->fetchAll());
    }

    public static function getTagsNumber($db)
    {
        $selectQ = "SELECT distinct Count(tag) from ".Tag::$tagsTable;
        $stmt = $db->prepare($selectQ);
        $stmt->execute();
        return($stmt->fetchAll());
    }
//generacja zbioru 
    public static function GenTag($ilosc){
 
        $ile=0;
        $zbior_liczb=array(); 
         
        while($ile<$ilosc){
            $ile++;
            $zbior_liczb[$ile]=$ile;
        }
            return $zbior_liczb; 
    } 
//losowanie ze zbiorow bez powtorzen     
    public static function GenUnique($zbior,$ile_wylosowac){
        
        $wylosowane_liczby=array(); 
        
        for($i=0;$i<$ile_wylosowac;$i++){
            $wylosowany_index = array_rand($zbior,1); 
            $wylosowane_liczby[$i]=$zbior[$wylosowany_index]; 
            unset($zbior[$wylosowany_index]);
        }
            return $wylosowane_liczby; 
    }

}
?>