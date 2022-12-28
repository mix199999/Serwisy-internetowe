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


    private $weight = 0;

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

    }
    public static function getVideosByTitle($conn, $title){
        $query = "SELECT id_video FROM ".video::$videoTable." WHERE title LIKE ";
        $query .= "'%";
        $query .= $title;
        $query .= "%'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($data = $stmt->fetchall(PDO::FETCH_ASSOC)){
            return $data;
        }
        else{
            return null;
        }
    }
    public static function getVideosByTag($conn, $tag){
        $query = "SELECT id_video FROM ".video::$tagsTable." WHERE tag LIKE :tag";
        $stmt = $conn->prepare($query);
        $stmt->bindParam('tag', $tag, PDO::PARAM_STR);
        $stmt->execute();
        if($data = $stmt->fetchall(PDO::FETCH_ASSOC)){
            return $data;
        }
        else{
            return null;
        }
    }
    public static function getVideosByUser($conn, $user){
        $query = "SELECT id_video FROM ".video::$uploadedVideosTable." uv INNER JOIN users u ON uv.id_user = u.id_user WHERE login LIKE ";
        $query .= "'%";
        $query .= $user;
        $query .= "%'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($data = $stmt->fetchall(PDO::FETCH_ASSOC)){
            return $data;
        }
        else{
            return null;
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
            $query = "SELECT title, extension, url FROM ".video::$videoTable." WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                $this->title = $data['title'];
                $this->extension = $data['extension'];
                $this->url = $data['url'];
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
            $query = "SELECT tag FROM ".video::$tagsTable." WHERE id_video = ?";
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
            $query = "SELECT id_user FROM ".video::$uploadedVideosTable." WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                $this->uploadedBy = $data['id_user'];
                return 1;
            }
            else{
                return -1;
            }
        }
    }


    //Dodaje video z obiektu do tabeli video oraz jego tagi do tabeli tags
    public function addVideoToDb(){
        if($this->addVideo() < 0) {
            return -1;
        }
        elseif (($this->tags != null && $this->addTags() < 0) or ($this->addUploadedBy() < 0)){
            return 0;
        }
        else{
            return 1;
        }
    }
    /*
    public function addOtherToDb(){
        if($this->addTags() < 0 or $this->addUploadedBy() < 0){
            return -1;
        }
        else{
            return 1;
        }
    }
*/
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
            return 1;
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
        if(!$stmt->execute()){
            return -1;
        }
        else {
            //$stmt->commit();
        }
    }
    private function  addUploadedBy(){
        $query = "INSERT INTO ".video::$uploadedVideosTable."(id_video, id_user) VALUES (:idvideo, :iduser)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('idvideo', $this->IDvideo, PDO::PARAM_INT);
        $stmt->bindParam('iduser', $this->uploadedBy, PDO::PARAM_INT);
        if(!$stmt->execute()){
            return -1;
        }
        else {
            return 1;
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

    public function updateUrlToDb(){
        if($this->IDvideo != null){
            $query = "UPDATE ".video::$videoTable." SET url = '";
            $query .= $this->url;
            $query .= "' WHERE id_video = :idvideo";
            $stmt = $this->conn->prepare($query);
            //$stmt->bindParam('newUrl', $this->url, PDO::PARAM_STR);
            $stmt->bindParam('idvideo', $this->IDvideo, PDO::PARAM_INT);
            if(!$stmt->execute()){
                return -1;
            }
            else {
                return 1;
            }
        }
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
    public function getUrl()
    {
        return $this->url;
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

    /**
     * @param mixed|null $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function addWeight($weight)
    {
        $this->weight += $weight;
    }


    public static function youtube_link_to_embed($link) {
        // Sprawdź, czy link jest poprawny
        if (!preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) {
            return $link;
        }

        // Zwróć link embed - taki, ktory da sie wyswietlic na stronie, bo zwykle linki youtube blokuje
        return 'https://www.youtube.com/embed/' . $match[1];
    }

    public function getVideosWithUserTags($loginUser, $db) {  //Funkcja pobierajaca adresy URL dla użytkownika o jego wybranych tagach

        $query = "SELECT DISTINCT videos.url, videos.extension FROM ".video::$videoTable."    
        JOIN tags ON tags.id_video = videos.id_video                        
        JOIN user_tags ON tags.tag = user_tags.tag                          
        JOIN users ON user_tags.user_id = users.id_user 
        WHERE users.login = '".$loginUser."'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return($stmt->fetchAll());

    }

    public static function getSelectedTags($db, $ile_wybrano, $userid) { //Funkcja zapisujaca wybrane przez nowozarejestrowanego uzytkownika wybrane tagi
        for($i = 0; $i < $ile_wybrano; $i++){


            $selectQ = "INSERT INTO user_tags (tag, user_id) VALUES (?, ?)";
            $stmt = $db->prepare($selectQ);
            $stmt->bindParam(1, $_POST["tag"][$i], PDO::PARAM_STR);
            $stmt->bindParam(2, $userid, PDO::PARAM_INT);
            $stmt->execute();


        }
    }

}