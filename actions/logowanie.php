<?php

include_once 'conf/connDB.php';
include_once 'class/Users.php';



$database = new Database();
$db = $database->getConnection();
$user = new User($db);



try {

        if(isset($_POST["login"])  && isset($_POST["passwd"]) && ($_POST["email"])== '')
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
                else if( $_SESSION["session_name"] == 4)
                {
                    include("./strony/newUser.html");
                }
               //todo jesli inne role



            } else {
                $loginMessage = 'Invalid login! Please try again.';
            }
        }


        else if(isset($_POST["login"])  && isset($_POST["passwd"])&& $_POST["email"] != '')
        {
            $user = new User($db);
            $user->login = $_POST["login"];
            $user->id_priv= $_POST["id_priv"];
            $user->passwd= $_POST["passwd"];
            $user->email= $_POST["email"];

            $user -> addUser();
                $_SESSION["action"] = "newUser";
                echo $_SESSION["user_type"];
                $_SESSION["user_type"] = 4;
                header('Location: index.php?action=newUser.html');
            
            
               
                
                
            
                

            

        }
        
       

    } catch (PDOException $e)
    {
        die("Connection failed: " . $e->getMessage());
        echo"blad";
    }



?>