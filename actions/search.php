<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';


if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
else {
    $search = '';
}

$searchDevided = array();


$tagWeight = 1;
$titleWeight = 2;
$wholeTitleWeight = 3;
$userWeight = 5;

$results = array();
$resultsObjects = array();

$database = new Database();
$conn = $database->getConnection();


$searchItem = '';
for($i = 0; $i < strlen($search); $i++){
    if($search[$i] == ' '){
        if(!empty($searchItem)){
            $searchDevided[] = $searchItem;
            $searchItem = null;
        }
        else{
            continue;
        }
    }
    elseif ($i == strlen($search) - 1){
        $searchItem .= $search[$i];
        $searchDevided[] = $searchItem;
        $searchItem = null;
    }
    else{
        $searchItem .= $search[$i];
    }
}
$searchItem = null;

if(isset($_POST['title']) and count($searchDevided) > 1){
    if($data = video::getVideosByTitle($conn, $search)){
        addToResults($data, $wholeTitleWeight);
    }
}

foreach ($searchDevided as $searchItem){
    if(isset($_POST['title'])){
        if($data = video::getVideosByTitle($conn, $searchItem)){
            addToResults($data, $titleWeight);
        }
    }
    if(isset($_POST['tags'])){
        if($data = video::getVideosByTag($conn, $searchItem)){
            addToResults($data, $tagWeight);
        }
    }
    if(isset($_POST['user'])){
        if($data = video::getVideosByUser($conn, $searchItem)){
            addToResults($data, $userWeight);
        }
    }
}

function addToResults($records, $weight){
    global $results;
    global $resultsWeight;
    foreach ($records as $record){
       if($key = array_search($record['id_video'], $results)){ //jjja jebie to zwraca 0 trzeba to naprawić
            /*
           echo "Jest jusz: ";
           echo $results[$key];
           echo " pod -";
           echo $key;
           echo ";  ";
           */

           $resultsWeight[$key] += $weight;

       }
       else{
           /*
           $results[] = $record['id_video'];
           echo "dodano: ";
           echo $record['id_video'];
           echo ";  ";
           */

           $results[] = $record['id_video'];
           $resultsWeight[] = $weight;
           //usort
       }
    }
}

?>