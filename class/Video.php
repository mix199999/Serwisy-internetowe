<?php

class Video
{
    private static $videoTable = 'videos';
    private static $tagsTable = 'tags';
    private static $uploadedVideosTable = 'uploaded_videos';
    private static $usersTable = 'users';
    private $conn;

    private $IDvideo;
    private $title;
    private $extension;
    private $url;

    private $tags;
    private $uploadedBy;


    private $weight = 0;

    public function __construct($conn, $IDvideo = null, $title = null, $extension = null, $uploadedBy = null, $url = null, $tags = null)
    {
        $this->conn = $conn;
        $this->IDvideo = $IDvideo;
        $this->title = $title;
        $this->extension = $extension;
        $this->uploadedBy = $uploadedBy;
        $this->url = $url;
        $this->tags = $tags;
    }

    //WIP
    public static function getVideos($user = null, $tags = null)
    {

    }

    public static function getVideosByTitle($conn, $title)
    {
        $query = "SELECT id_video FROM " . video::$videoTable . " WHERE title LIKE ";
        $query .= "'%";
        $query .= $title;
        $query .= "%'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($data = $stmt->fetchall(PDO::FETCH_ASSOC)) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getVideosByTag($conn, $tag)
    {
        $query = "SELECT id_video FROM " . video::$tagsTable . " WHERE tag LIKE :tag";
        $stmt = $conn->prepare($query);
        $stmt->bindParam('tag', $tag, PDO::PARAM_STR);
        $stmt->execute();
        if ($data = $stmt->fetchall(PDO::FETCH_ASSOC)) {
            return $data;
        } else {
            return null;
        }
    }

    public static function getVideosByUser($conn, $user)
    {
        $query = "SELECT id_video FROM " . video::$uploadedVideosTable . " uv INNER JOIN users u ON uv.id_user = u.id_user WHERE login LIKE ";
        $query .= "'%";
        $query .= $user;
        $query .= "%'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if ($data = $stmt->fetchall(PDO::FETCH_ASSOC)) {
            return $data;
        } else {
            return null;
        }
    }

    /**
     * Uzupełnia pola w obiekcie pobierając je z bazy danych za pomocą ID -wymagane IDvideo-
     */
    public function completeFromDb()
    {
        if ($this->completeVideo() < 0) {
            return -1;
        } elseif ($this->completeTags() < 0 or $this->completeUser() < 0) {
            return 0;
        } else {
            return 1;
        }

    }

    //Uzupełnia dane z tabeli video
    private function completeVideo()
    {
        if (!$this->IDvideo) {
            return -1;
        } else {
            $query = "SELECT title, extension, url FROM " . video::$videoTable . " WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->title = $data['title'];
                $this->extension = $data['extension'];
                $this->url = $data['url'];
                return 1;
            } else {
                return -1;
            }
        }
    }

    //Uzupełnia dane z tabeli tags
    private function completeTags()
    {
        if (!$this->IDvideo) {
            return -1;
        } else {
            $query = "SELECT tag FROM " . video::$tagsTable . " WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if ($data = $stmt->fetchALL(PDO::FETCH_ASSOC)) {
                $this->tags = $data;
                return 1;
            } else {
                return -1;
            }
        }
    }

    //Uzupełnia dane z tabeli uploaded_videos
    private function completeUser()
    {
        if (!$this->IDvideo) {
            return -1;
        } else {
            $query = "SELECT id_user FROM " . video::$uploadedVideosTable . " WHERE id_video = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->IDvideo, PDO::PARAM_INT);
            $stmt->execute();
            if ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->uploadedBy = $data['id_user'];
                return 1;
            } else {
                return -1;
            }
        }
    }


    //Dodaje video z obiektu do tabeli video oraz jego tagi do tabeli tags
    public function addVideoToDb()
    {
        if ($this->addVideo() < 0) {
            return -1;
        } elseif (($this->tags != null && $this->addTags() < 0) or ($this->addUploadedBy() < 0)) {
            return 0;
        } else {
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
    private function addVideo()
    {

        $query = "INSERT INTO " . video::$videoTable . "(/*IDvideo,*/ title, extension, url) VALUES (/*:ID,*/ :title, :extension, :url)";
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam('ID', $this->IDvideo, PDO::PARAM_INT);
        $stmt->bindParam('title', $this->title, PDO::PARAM_STR);
        $stmt->bindParam('extension', $this->extension, PDO::PARAM_STR);
        $stmt->bindParam('url', $this->url, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            return -1;
        } else {
            $this->IDvideo = $this->completeIdFromDB();
            return 1;
        }

    }

    //Do zrobienia
    private function addTags()
    {
        //$query = "INSERT INTO ".video::$tagsTable."(id_video, tag) VALUES :values";
        $values = '';
        foreach ($this->tags as $tag) {
            $values .= "('";
            $values .= $this->IDvideo;
            $values .= "','";
            $values .= $tag;
            $values .= "'),";
        }
        $values[strlen($values) - 1] = ';';

        $query = "INSERT INTO " . video::$tagsTable . "(id_video, tag) VALUES ";
        $query .= $values;
        $stmt = $this->conn->prepare($query);
        //$stmt->bindParam('values', $values, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            return -1;
        } else {
            //$stmt->commit();
        }
    }

    private function addUploadedBy()
    {
        $query = "INSERT INTO " . video::$uploadedVideosTable . "(id_video, id_user) VALUES (:idvideo, :iduser)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('idvideo', $this->IDvideo, PDO::PARAM_INT);
        $stmt->bindParam('iduser', $this->uploadedBy, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            return -1;
        } else {
            return 1;
        }
    }

    private function completeIdFromDB()
    {
        $query = "SELECT id_video FROM videos ORDER BY id_video DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $id['id_video'];
        return $id;
    }

    public function updateUrlToDb()
    {
        if ($this->IDvideo != null) {
            $query = "UPDATE " . video::$videoTable . " SET url = '";
            $query .= $this->url;
            $query .= "' WHERE id_video = :idvideo";
            $stmt = $this->conn->prepare($query);
            //$stmt->bindParam('newUrl', $this->url, PDO::PARAM_STR);
            $stmt->bindParam('idvideo', $this->IDvideo, PDO::PARAM_INT);
            if (!$stmt->execute()) {
                return -1;
            } else {
                return 1;
            }
        }
    }

    public function getUploadedByLogin()
    {
        $query = "SELECT login FROM users WHERE id_user = :iduser";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('iduser', $this->uploadedBy, PDO::PARAM_INT);
        $stmt->execute();
        //$login = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($login = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $login = $login['login'];
            return $login;
        }
        return "Zagubiony w czeluściach czasu";
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


    public static function youtube_link_to_embed($link)
    {
        // Sprawdź, czy link jest poprawny
        if (!preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match)) {
            return $link;
        }
        // Zwróć link embed - taki, ktory da sie wyswietlic na stronie, bo zwykle linki youtube blokuje
        return 'https://www.youtube.com/embed/' . $match[1];
    }

    public static function getVideosWithUserTags($loginUser, $db) //Funkcja pobierajaca adresy URL dla użytkownika o jego wybranych tagach
    {
        $query = "SELECT DISTINCT videos.url, videos.extension, videos.title, videos.id_video FROM " . video::$videoTable . "    
        JOIN tags ON tags.id_video = videos.id_video                        
        JOIN user_tags ON tags.tag = user_tags.tag                          
        JOIN users ON user_tags.user_id = users.id_user 
        JOIN uploaded_videos ON uploaded_videos.id_user = users.id_user
        WHERE users.login = '" . $loginUser . "'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return ($stmt->fetchAll());
    }

    public static function getEditorUsername($videoid, $db) //Funkcja pobierajaca adresy URL dla użytkownika o jego wybranych tagach
    {
        $query = "SELECT users.login FROM " . video::$usersTable . "                            
        JOIN uploaded_videos ON uploaded_videos.id_user = users.id_user
        WHERE uploaded_videos.id_video = '" . $videoid . "'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return ($stmt->fetch());
    }

    public static function getVideoIdFromUrl($videoUrl, $db)  //Funkcja, która dla podanego url pobierze jego id
    {
        $query = "SELECT videos.id_video FROM " . video::$videoTable . " 
        WHERE url LIKE '%" . $videoUrl . "%'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return ($stmt->fetch());
    }

    public static function getVideo($videoid, $db) //Funkcja pobierająca jedno video
    {
        $query = "SELECT videos.url, videos.extension, videos.title, videos.id_video FROM " . video::$videoTable . "    
        WHERE id_video = '" . $videoid . "'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return ($stmt->fetch());
    }

	public static function isEmbed($url)
	{
		return preg_match('/^https:\/\/www\.youtube\.com\/embed\/.+$/', $url);
	}

    public static function youtube_embed_to_link($url)
    {
        preg_match('/^https:\/\/www\.youtube\.com\/embed\/([a-zA-Z0-9]+)/', $url, $matches);
        if (count($matches) > 1) {
            return 'https://www.youtube.com/watch?v=' . $matches[1];
        } else {
            return false;
        }
    }

    public static function getSelectedTags($db, $ile_wybrano, $userid) //Funkcja zapisujaca wybrane przez nowozarejestrowanego uzytkownika wybrane tagi
    {
        for ($i = 0; $i < $ile_wybrano; $i++) {


            $selectQ = "INSERT INTO user_tags (tag, user_id) VALUES (?, ?)";
            $stmt = $db->prepare($selectQ);
            $stmt->bindParam(1, $_POST["tag"][$i], PDO::PARAM_STR);
            $stmt->bindParam(2, $userid, PDO::PARAM_INT);
            $stmt->execute();


        }
    }

    public static function getVideosByLogin($login, $db)
    {
        $query = "SELECT url, extension, title FROM videos v 
                JOIN uploaded_videos uv ON v.id_video = uv.id_video
                JOIN users u ON uv.id_user = u.id_user
                WHERE u.login = :login";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':login', $login);
        $stmt->execute();
            //check if returned rows are more than 0
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }


    public static function getStaticVideosWithUserTags($loginUser, $db) //Funkcja pobierajaca adresy URL dla użytkownika o jego wybranych tagach
    {
        $query = "SELECT DISTINCT videos.url, videos.extension, videos.title, videos.id_video FROM " . video::$videoTable . "    
        JOIN tags ON tags.id_video = videos.id_video                        
        JOIN user_tags ON tags.tag = user_tags.tag                          
        JOIN users ON user_tags.user_id = users.id_user 
        JOIN uploaded_videos ON uploaded_videos.id_user = users.id_user
        WHERE users.login = '" . $loginUser . "'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return ($stmt->fetchAll());
    }

    



    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getVideoData()
    {
        $stmt = $this->conn->prepare("SELECT uploaded_videos.id_video, videos.title, users.login, videos.url FROM uploaded_videos 
    JOIN videos ON uploaded_videos.id_video = videos.id_video
    JOIN users ON uploaded_videos.id_user = users.id_user");
        $stmt->execute();
        $videoData = $stmt->fetchAll();
        $videoList = [];

        foreach ($videoData as $row) {
            $videoObject = new Video($this->conn);
            $videoObject->id_video = $row['id_video'];
            $videoObject->title = $row['title'];
            $videoObject->login = $row['login'];
            $videoObject->url = $row['url'];
            $videoList[] = $videoObject;
        }


        return $videoList;
    }

    public function isReported()
    {
        $stmt = $this->conn->prepare("SELECT DISTINCT * FROM reported_videos JOIN reported_video_reasons ON reported_videos.video_id = reported_video_reasons.video_id
        JOIN reasons on reasons.reason_id = reported_video_reasons.reason_id
         WHERE reported_videos.video_id = :id_video");
        $stmt->bindParam(':id_video', $this->id_video, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            $reportedVideo = $stmt->fetchAll();
            foreach ($reportedVideo as $row) {
                $reportedVideoData[] = array(
                    'reason' => $row['reason'],
                    'video_id' => $row['video_id'],
                    'description' => $row['description']
                );
            }
            $reportedVideo = json_encode($reportedVideoData);
            return $reportedVideo;
        } else
            return 2;
    }


   public function deleteVideoReport()
   {

       $this->deleteFromTable('reported_video_reasons', 'video_id');
       $this->deleteFromTable('reported_videos', 'video_id');

   }

   public function deleteCascadeVideo()
   {
       $this->deleteFromTable('reported_video_reasons', 'video_id');
       $this->deleteFromTable('reported_videos', 'video_id');
       $this->deleteFromTable('uploaded_videos', 'id_video');
       $this->deleteFromTable('videos', 'id_video');
   }


    public function deleteFromTable($tableName, $columnName)
    {
        $deleteQuery = "DELETE FROM " . $tableName . " WHERE " . $columnName . " = ?";
        $stmt= $this->conn->prepare($deleteQuery);
        $stmt-> bindParam(1, $this->id_video, PDO::PARAM_INT);
        $stmt->execute();

    }


    public static function getVideosForStartPage($id_user, $db) //Funkcja pobierajaca adresy URL dla użytkownika o jego wybranych tagach
    {
        $query = "SELECT DISTINCT videos.url, videos.extension, videos.title, videos.id_video FROM " . video::$videoTable . "    
        JOIN tags ON tags.id_video = videos.id_video                        
        JOIN user_tags ON tags.tag = user_tags.tag                          
        JOIN users ON user_tags.user_id = users.id_user        
        WHERE users.id_user = '" . $id_user . "'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        //check if returned rows are more than 0
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

        

       
    }




}