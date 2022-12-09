<?php

include_once 'conf/connDB.php';
include_once 'class/Users.php';



$database = new Database();
$db = $database->getConnection();
$user = new User($db);



try {
   
       

        if(isset($_POST["login"])  && isset($_POST["passwd"]))
        {	
            $user = new User($db);
            $user->login = $_POST["login"];
            $user->passwd= $_POST["passwd"];
            if($user->login()) 
            {

                if($_SESSION["user_type"] == 1)
                {

                    header('Location: index.php?action=StartPage');
                }

                else if ($_SESSION["user_type"] == 2)

                {

                    header('Location: index.php?action=StartPage');
                }

                else if ($_SESSION["user_type"] == 3)

                {

                    header('Location: index.php?action=StartPage');
                }
               //todo jesli inne role



            } else {
                $loginMessage = 'Invalid login! Please try again.';
            }
        }
       

    } catch (PDOException $e)
    {
        die("Connection failed: " . $e->getMessage());
        echo"blad";
    }



?>