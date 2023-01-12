<?php
if(isset($_POST['search'])) {
    $search = $_POST['search'];
}
else {
    $search = '';
}
header('Location: index.php?action=newUser.html');



?>