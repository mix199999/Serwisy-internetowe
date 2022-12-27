<?php
include_once 'conf/connDB.php';
include_once 'class/Video.php';


if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
else {
    $search = '';
}

$tagWeight = 1;
$titleWeight = 2;
$wholeTitleWeight = 3;
$userWeight = 5;

$results = array();

$database = new Database();
$conn = $database->getConnection();

$test = video::getVideosByTitle($conn, 'tes');
$items = array(1,2,3);
addToResults($items,1);
$items = array(1,2,3);
addToResults($items,1);
$items = array(4,5,3);
addToResults($items,1);


function addToResults($items, $weight){
    global $results;
    foreach ($items as $item){
       if($key = array_search($item, $results)){
           echo $key;
           echo "\n";
       }
       else{
           $results[] = $item;
           echo "dodano\n";
       }
    }
}

?>