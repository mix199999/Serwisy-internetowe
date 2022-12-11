<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';

if(isset($_SESSION['abc'])) {
    echo $_SESSION['abc'][0];
    echo $_SESSION['abc'][1];
    echo $_SESSION['abc'][2];
}
else{
    $_SESSION['abc'] = 'abc';
    echo $_SESSION['abc'];
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
        trim($tags);
        for($i = 0; $i < strlen($tags); $i++){
            //zmienić żeby przy ostatnim znaku jeszcze spushował
            if($tags[$i] == ',' or $i == strlen($tags) - 1){
                if(!empty($tag)){
                    array_push($tagsFormated, $tag);
                    $tag = null;
                }
                else{
                    continue;
                }
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

            $database = new Database();
            $conn = $database->getConnection();

            //zrobić rozszerzenie i jjjakimś cudem muszę mieć idurzytkownika
            $video = new Video($conn, null, $fields['title'], null, null, $tagsFormated);
            $_SESSION['abc'] = $video->getTags();

        }
    }

?>