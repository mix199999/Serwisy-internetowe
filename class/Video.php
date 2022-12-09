<?php

class Video
{
     private static $videoTable = 'videos';
    private $conn;

    private $IDvideo;
    private $title;
    private $extension;

    private $tags;
    private $uploadedBy;

    public function __construct($db, $IDvideo = null, $title = null, $extension = null){
        $this->conn = $db;
        $this->IDvideo = $IDvideo;
        $this->title = $title;
        $this->extension = $extension;
    }

    public static function getVideos($user = null, $tags = null){
        if($user){
            if($tags){

            }
            else{
                $query = "SELECT * from" .video::$videoTable. "v INNER JOIN uploaded_videos uv ON v.IDvideo = uv.IDvideo WHERE IDuser IN ?";
            }
        }
        elseif ($tags){

        }
        else{
            $query = "SELECT * from" .video::$videoTable;
        }
    }

    //Uzupełnia pola w obiekcie pobierając je z bazy danych za pomocą ID -wymagane IDvideo-
    public function completeFromDb()
    {
        if(!$this->IDvideo){
            return -1;
        }
        else{
            $query = "SELECT title, extension FROM".video::$videoTable."WHERE IDvideo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                $this->title = $data['title'];
                $this->extension = $data['extension'];
                return 1;
            }
            else{
                return -1;
            }
        }

    }

}