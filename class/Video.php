<?php

class Video
{
    private static $videoTable = 'videos';
    private static $tagsTable = 'tags';
    private static $uploadedVideosTable = 'uploaded_videos';
    private $conn;

    private $id_video;
    private $title;
    private $extension;

    private $tags;
    private $uploadedBy;

    public function __construct($conn, $id_video = null, $title = null, $extension = null, $uploadedBy = null, $tags = null){
        $this->conn = $conn;
        $this->id_video = $id_video;
        $this->title = $title;
        $this->extension = $extension;
        $this->uploadedBy = $uploadedBy;
        $this->tags = $tags;
    }

    //WIP
    public static function getVideos($user = null, $tags = null){
        if($user){
            if($tags){

            }
            else{
                $query = "SELECT * from" .video::$videoTable. "v INNER JOIN uploaded_videos uv ON v.id_video = uv.id_video WHERE id_user IN ?";
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
        if(!$this->id_video){
            return -1;
        }
        else{
            $query = "SELECT title, extension FROM".video::$videoTable."WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_video, PDO::PARAM_INT);
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
        if(!$this->id_video){
            return -1;
        }
        else{
            $query = "SELECT tag FROM".video::$tagsTable."WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_video, PDO::PARAM_INT);
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
        if(!$this->id_video){
            return -1;
        }
        else{
            $query = "SELECT IDuser FROM".video::$uploadedVideosTable."WHERE IDvideo = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id_video, PDO::PARAM_INT);
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
        elseif (tags != null && $this->addTags() < 0){
            return 0;
        }
        else{
            return 1;
        }
    }

    //Dodaje video z obiektu do tabeli video
    private function addVideo(){

        $query = "INSERT INTO ".video::$videoTable."(IDvideo, title, extension) VALUES (:ID, :title, :extension)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('ID', $this->id_video, PDO::PARAM_INT);
        $stmt->bindParam('title', $this->title, PDO::PARAM_INT);
        $stmt->bindParam('extension', $this->extension, PDO::PARAM_INT);
        if(!$stmt->execute()){
            return -1;
        }
        else {
            $stmt->commit();
        }

    }
    //Do zrobienia
    private function addTags(){
    //sprawdzić w jaki sposób dostaje tagi  [] czy [][]
    }

    /**
     * @return mixed|null
     */
    public function getIdvideo()
    {
        return $this->id_video;
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




}