<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';


if(isset($_GET['v'])){

    $database = new Database();
    $conn = $database->getConnection();
    $video = new Video($conn, $_GET['v']);
    $type = null;


    if($video->completeFromDb() < 0){ //To nie zadziała do końca na razie, bo musi mi Michał zmienić trochę bazę. Jakbyś potrzebował jakichś danych których tam nie ma to mnie wołaj
        echo "Błędny kod filmu";
    }
    else{
        if($video->getExtension() == "url"){
            $type = "link";
            //kod od Michała Nowaka
        }
        else{
            $type = "server";
            //normalne wyświetlanie
        }
        //tutaj możesz robić to zgłaszanie, w $video będą w polach wszysstkie dane więc z nich korzystać możesz
    }


}
else{
    echo "Aby wyświetlić wideo należy podać kod";
}
?>