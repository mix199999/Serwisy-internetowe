<?php

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

    $errors = array();

    $fields['title'] = array_key_exists('title', $_POST) ? $_POST['title'] : '';
    $fields['type'] = array_key_exists('type', $_POST) ? $_POST['type'] : '';
    $fields['address'] = array_key_exists('address', $_POST) ? $_POST['address'] : '';

    //$target_dir = "videos/";
    //$target_file = $target_dir . basename($_FILES["video"]["name"]);

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

        }
    }

?>