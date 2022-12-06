<?php

include_once 'conf/connDB.php';
include_once 'class/Users.php';



$database = new Database();
$db = $database->getConnection();
$user = new User($db);

try {
   
       

        if(!empty($_POST["login"]) && $_POST["passwd"]!='') 
        {	
            $user = new User($db);
            $user->login = $_POST["login"];
            $user->passwd= $_POST["passwd"];
            if($user->login()) 
            {

                if($user->IDpriv == 1)
                {
                    $_SESSION["session_name"] = 'admin';
                    header("location: adminDashboard.php");
                }

                else if ($user->IDpriv == 2)

                {
                    $_SESSION["session_name"] = 'user';
                    header("location: userDashboard.php");
                }

               
            } else {
                $loginMessage = 'Invalid login! Please try again.';
            }
        }
       

    } catch (mysqli_sql_exception $e) 
    {
        die("Connection failed: " . $db->connect_error);
        echo"blad";
    }



?>