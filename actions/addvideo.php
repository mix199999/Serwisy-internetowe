<?php
//include_once 'conf/connDB.php';
//include_once 'class/Video.php';
require_once USER_CLASS_PATH;
require_once VIDEO_CLASS_PATH;


if(isset($_POST['imgBase64'])) {
    $imgBase64 = $_POST['imgBase64'];
}
else{
    $imgBase64 = null;
}

if(!isset($fileName)){
    $fileName = '';
}




if(!is_null($imgBase64)){
    $img = $imgBase64;
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $fileData = base64_decode($img);
    $number = 1;
    while(file_exists('photo' . $number . '.png') and $fileName = ''){
        $number++;
    }
    $fileName = 'photo' . $number . '.png';
    file_put_contents($fileName, $fileData);
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
    $fields['adress'] = array_key_exists('adress', $_POST) ? $_POST['adress'] : '';
    $fields['tags'] = array_key_exists('tags', $_POST) ? $_POST['tags'] : '';

    //$target_dir = "videos/";
    //$target_file = $target_dir . basename($_FILES["video"]["name"]);

    $tagsFormated = array();
    $tag = '';
    if(!empty($tags)){

        $tags = str_replace(' ', '', $tags);        
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

    $errors['title'] = 'none';
    $errors['choice'] = 'none';
    $choiceMsg = 'Wybierz opcję przesyłu';

    if (count($_POST) > 0) {

        $errors['title'] = empty($fields['title']) ? '' : 'none';
        $errors['choice'] = empty($fields['type']) ? '' : 'none';
        if ($fields['type'] == "file") {
            $errors['choice'] = !is_uploaded_file($_FILES['video']['tmp_name']) ? '' : 'none';
            $choiceMsg = 'Należy wybrać plik';
        }
        elseif($fields['type'] == "url"){
            $errors['choice'] = empty($fields['adress']) ? '' : 'none';
            $choiceMsg = 'Należy podać adres';
        }

        if ($errors['title'] == 'none' and $errors['choice'] == 'none') {



            $url = '';
            $extension = '';
            if($fields['type'] == "url"){
                $url = "https://www.youtube.com/watch?v=" . $fields['adress'];
                $extension = "url";
            }
            else{
                $url = "www.placeholdertst.net";
                $extension = substr($_FILES['video']['type'], 6);
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



            if(file_exists("actions/photo.png")) {
                $thbDir = 'videos/thumbnails/' . $video->getIDvideo() . '.png';

                $fName = 'actions/' . $fileName;
                rename($fName, $thbDir);
            }
            echo "<script> window.alert('Wideo przesłane!');</script>";

        }
    }

?>