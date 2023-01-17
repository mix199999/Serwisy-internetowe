<?php

require_once USER_CLASS_PATH;

require_once CONN_PATH;






if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
else {
    $search = '';
}
header('Location: index.php?action=newUser.html');



?>