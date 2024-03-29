<?php
require_once CONN_PATH;
require_once VIDEO_CLASS_PATH;


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

if(!empty($resultsObjects)){
    usort($resultsObjects, "compareVideoWeights");
}

function addToResults($records, $weight){
    global $conn;
    global $results;
    global $resultsObjects;
    foreach ($records as $record){
       if(!empty($results) and $results[0] == $record['id_video']){
           $resultsObjects[0]->addWeight($weight);
       }
       else if($key = array_search($record['id_video'], $results)){
            /*
           echo "Jest jusz: ";
           echo $results[$key];
           echo " pod -";
           echo $key;
           echo ";  ";
           */

           $resultsObjects[$key]->addWeight($weight);

       }
       else{
           /*
           $results[] = $record['id_video'];
           echo "dodano: ";
           echo $record['id_video'];
           echo ";  ";
           */

           $results[] = $record['id_video'];
           $resultsObjects[] = new Video($conn, $record['id_video']);
           $resultsObjects[sizeof($resultsObjects) - 1]->setWeight($weight);
           $resultsObjects[sizeof($resultsObjects) - 1]->completeFromDb();
           //usort
       }
    }
}

function compareVideoWeights($a, $b){
    if($a->getWeight() == $b->getWeight()){
        return 0;
    }
    return ($a->getWeight() < $b->getWeight()) ? 1 : -1;
}


?>