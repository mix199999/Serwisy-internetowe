<?php

class Video
{
    private static $videoTable = 'videos';
    private static $tagsTable = 'tags';
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


    //Uzupełnia pola w obiekcie pobierając je z bazy danych za pomocą ID -wymagane IDvideo-
    public function completeFromDb()
    {
        if($this->completeVideo() < 0){
            return -1;
        }
        elseif($this->completeTags() < 0){
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


    //Dodaje video z obiektu do tabeli video oraz jego tagi do tabeli tags
    public function addVideoToDb(){
        if($this->addVideo() < 0){
            return -1;
        }
        elseif (tags != null && $this->addTags() < 0){
            return 0;
        }
        else{
            return 1;
        }
    }

    //Dodaje video z obiektu do tabeli video
    private function addVideo(){
        if(!$this->IDvideo){
            return -1;
        }
        else{
            $query = "INSERT INTO ".video::$videoTable."(IDvideo, title, extension) VALUES (:ID, :title, :extension)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam('ID', $this->IDvideo, PDO::PARAM_INT);
            $stmt->bindParam('title', $this->IDvideo, PDO::PARAM_INT);
            $stmt->bindParam('extension', $this->IDvideo, PDO::PARAM_INT);
            if(!$stmt->execute()){
                return -1;
            }
            else {
                $stmt->commit();
            }
        }
    }
    //Do zrobienia
    private function addTags(){
    //sprawdzić w jaki sposób dostaje tagi  [] czy [][]
    }




}