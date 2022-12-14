<?php

class Video
{
    private static $videoTable = 'videos';
    private static $tagsTable = 'tags';
    private static $uploadedVideosTable = 'uploaded_videos';
    private $conn;

    private $IDvideo;
    private $title;
    private $extension;
    private $url;

    private $tags;
    private $uploadedBy;

    public function __construct($conn, $IDvideo = null, $title = null, $extension = null, $uploadedBy = null, $url = null, $tags = null){
        $this->conn = $conn;
        $this->IDvideo = $IDvideo;
        $this->title = $title;
        $this->extension = $extension;
        $this->uploadedBy = $uploadedBy;
        $this->url = $url;
        $this->tags = $tags;
    }

    //WIP
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


    /**
     * Uzupełnia pola w obiekcie pobierając je z bazy danych za pomocą ID -wymagane IDvideo-
     */
    public function completeFromDb()
    {
        if($this->completeVideo() < 0){
            return -1;
        }
        elseif($this->completeTags() < 0 or $this->completeUser() < 0){
            return 0;
        }
        else{
            return 1;
        }

    }

    //Uzupełnia dane z tabeli video
    private function completeVideo(){
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

    //Uzupełnia dane z tabeli tags
    private function completeTags(){
        if(!$this->IDvideo){
            return -1;
        }
        else{
            $query = "SELECT tag FROM".video::$tagsTable."WHERE IDvideo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if($data = $stmt->fetchALL(PDO::FETCH_ASSOC)){
                $this->tags = $data;
                return 1;
            }
            else{
                return -1;
            }
        }
    }

    //Uzupełnia dane z tabeli uploaded_videos
    private function completeUser(){
        if(!$this->IDvideo){
            return -1;
        }
        else{
            $query = "SELECT IDuser FROM".video::$uploadedVideosTable."WHERE IDvideo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                $this->uploadedBy = $data['IDuser'];
                return 1;
            }
            else{
                return -1;
            }
        }
    }


    //Dodaje video z obiektu do tabeli video oraz jego tagi do tabeli tags
    public function addVideoToDb(){
        if($this->addVideo() < 0){
            return -1;
        }
        elseif ($this->tags != null && $this->addTags() < 0){
            return 0;
        }
        else{
            return 1;
        }
    }

    //Dodaje video z obiektu do tabeli video
    private function addVideo(){

        $query = "INSERT INTO ".video::$videoTable."(/*IDvideo,*/ title, extension, url) VALUES (/*:ID,*/ :title, :extension, :url)";
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam('ID', $this->IDvideo, PDO::PARAM_INT);
        $stmt->bindParam('title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam('extension', $this->extension, PDO::PARAM_STR);
        $stmt->bindParam('url', $this->url, PDO::PARAM_STR);
        if(!$stmt->execute()){
            return -1;
        }
        else {
            $this->IDvideo = $this->completeIdFromDB();
        }

    }
    //Do zrobienia
    private function addTags(){
        //$query = "INSERT INTO ".video::$tagsTable."(id_video, tag) VALUES :values";
        $values = '';
        foreach ($this->tags as $tag){
            $values .= "('";
            $values .= $this->IDvideo;
            $values .= "','";
            $values .= $tag;
            $values .= "'),";
        }
        $values[strlen($values) - 1] = ';';

        $query = "INSERT INTO ".video::$tagsTable."(id_video, tag) VALUES ";
        $query .= $values;
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam('values', $values, PDO::PARAM_STR);
        echo $values;
        if(!$stmt->execute()){
            return -1;
        }
        else {
            //$stmt->commit();
        }
    }

    private function completeIdFromDB(){
        $query = "SELECT id_video FROM videos ORDER BY id_video DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $id['id_video'];
        return $id;
    }

    /**
     * @return mixed|null
     */
    public function getIDvideo()
    {
        return $this->IDvideo;
    }

    /**
     * @return mixed|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed|null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return mixed|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return mixed|null
     */
    public function getUploadedBy()
    {
        return $this->uploadedBy;
    }


    public static function youtube_link_to_embed($link) {  
        // Sprawdź, czy link jest poprawny
        if (!preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) {
          return $link;
        }
      
        // Zwróć link embed - taki, ktory da sie wyswietlic na stronie, bo zwykle linki youtube blokuje
        return 'https://www.youtube.com/embed/' . $match[1];
    }

    public static function getVideosWithUserTags() {
        /*
        $query = "SELECT url FROM videos
        JOIN tags ON videos.id_tag = tags.id_tag    // do tego trzeba baze danych przebudować
        JOIN users ON user.id_tag = tags.id_tag     // user musi miec jakos tagi swoje zapisane
        WHERE user.login = 'login'";                // video tez musi miec swoje tagi
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return($stmt->fetchAll());    
        */  
        return 1;            
    }
        

}