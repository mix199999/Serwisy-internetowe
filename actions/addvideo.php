<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';


if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
    $imageData = $GLOBALS['HTTP_RAW_POST_DATA'];
    $filteredData = substr($imageData, strpos($imageData, ",") + 1);
    $unencodedData = base64_decode($filteredData);
    $fp = fopen('/videos/thumbnails/file.jpg', 'wb');

    fwrite($fp, $unencodedData);
    fclose($fp);
}


if(isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    else {
        $title = '';
    }
    if(isset($_POST['type'])) {
        $type = $_POST['type'];
    }
    else {
        $type = '';
    }
    if(isset($_POST['tags'])) {
        $tags = $_POST['tags'];
    }
    else {
    $tags = '';
}
    $errors = array();

    $fields['title'] = array_key_exists('title', $_POST) ? $_POST['title'] : '';
    $fields['type'] = array_key_exists('type', $_POST) ? $_POST['type'] : '';
    $fields['address'] = array_key_exists('address', $_POST) ? $_POST['address'] : '';
    $fields['tags'] = array_key_exists('tags', $_POST) ? $_POST['tags'] : '';

    //$target_dir = "videos/";
    //$target_file = $target_dir . basename($_FILES["video"]["name"]);

    $tagsFormated = array();
    $tag = '';
    if(!empty($tags)){
        $tags = trim($tags);
        $tags = strtolower($tags);
        for($i = 0; $i < strlen($tags); $i++){
            if($tags[$i] == ','){
                if(!empty($tag)){
                    $tagsFormated[] = $tag;
                    $tag = null;
                }
                else{
                    continue;
                }
            }
            elseif ($i == strlen($tags) - 1){
                $tag .= $tags[$i];
                $tagsFormated[] = $tag;
                $tag = null;
            }
            else{
                $tag .= $tags[$i];
            }
        }
    }


    if (count($_POST) > 0) {
        if (empty($fields['title'])) {
            $errors['title'] = 'Pole jest wymagane.';
        }
        if (empty($fields['type'])) {
            $errors['type'] = 'Należy wybrać opcję przesyłu.';
        }
        elseif ($fields['type'] == "file"){
            if(!is_uploaded_file($_FILES['video']['tmp_name'])) {
                $errors['type'] = 'Wymagane jest przesłanie pliku.';
            }
        }
        elseif ($fields['type'] == "url"){
            if(empty($fields['address'])){
                $errors['type'] = 'Podaj link do filmu.';
            }
        }
        if (count($errors) == 0) {


            //$_FILES['video']['tmp_name'] pobrać rozszerzenie

            $url = '';
            $extension = '';
            if($fields['type'] == "url"){
                $url = "https://www.youtube.com/watch?v=" . $fields['address'];
                $extension = "url";
            }
            else{
                $url = "www.placeholdertst.net"; //trzeba zmienić bazę tak żeby przyjmowała te same adresy
                $extension = substr($_FILES['video']['type'], 6);
                //echo  $extension;
            }

            $database = new Database();
            $conn = $database->getConnection();


            $video = new Video($conn, null, $fields['title'], $extension, $_SESSION['id_user'], $url, $tagsFormated);

            $video->addVideoToDb();



            if($fields['type'] == "file"){
                $target_dir = "videos/";
                $target_file = $target_dir . $video->getIDvideo() . "." . $extension;
                $url = $target_file;
                $video->setUrl($url);
                move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
                $video->updateUrlToDb();
            }



        }
    }

?>